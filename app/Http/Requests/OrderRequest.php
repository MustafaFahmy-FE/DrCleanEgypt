<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()->first(), 400));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client' => ['required' , 'not_in:0'],
            'item_ids' => ['required' ],
            'quantities' => ['required' ],
            'working_day' => ['required' , 'numeric']
        ];
    }

    public function attributes()
    {
        return [
            'client' => 'العميل',
            'item_ids' => 'الأصناف',
            'quantities' => 'الكميه',
            'working_day' => 'عدد أيام العمل'
        ];
    }

    public function store()
    {
        $order = new Order();

        $order->client_id = $this->client;
        $order->discount = $this->discount ? $this->discount : 0;
        $order->working_day = $this->working_day;
        $order->notes = $this->notes;
        $order->total = 0;
        $order->delivery = $this->delivery;
        $order->service = $this->service;

        $order->save();

        $items = explode("," , $this->item_ids);
        $statuses = explode("," , $this->statuses);
        $prices = explode("," , $this->prices);
        $quantities = explode("," , $this->quantities);
        $discounts = explode("," , $this->discounts);

        for ($i=0; $i < count($items); $i++) { 
            $order->details()->create([
                'item_id' => $items[$i],
                'status' => $statuses[$i],
                'price' => $prices[$i] * $quantities[$i],
                'quantity' => $quantities[$i],
                'discount' => $discounts[$i] ? $discounts[$i] : 0
            ]);
        }
        
        $total = 0;
        
        foreach($order->details()->get() as $detail)
        {
            $price = $detail->price - $detail->discount;
            $total = $total + $price;
        }
        
        $order->total = $total + $order->service + $order->delivery;

        $order->save();
    }

    public function update($id)
    {
        $order = Order::findOrFail($id);

        $order->client_id = $this->client;
        $order->discount = $this->discount ? $this->discount : 0;
        $order->working_day = $this->working_day;
        $order->notes = $this->notes;

        $order->save();

        $order->details()->delete();

        $items = explode("," , $this->item_ids);
        $statuses = explode("," , $this->statuses);
        $prices = explode("," , $this->prices);
        $quantities = explode("," , $this->quantities);
        $discounts = explode("," , $this->discounts);

        for ($i=0; $i < count($items); $i++) { 
            $order->details()->create([
                'item_id' => $items[$i],
                'status' => $statuses[$i],
                'price' => ($prices[$i] - $discounts[$i]) * $quantities[$i],
                'quantity' => $quantities[$i],
                'discount' => $discounts[$i]
            ]);
        }

        $order->total = $order->details()->sum('price') - $order->discount;

        $order->save();
    }
}
