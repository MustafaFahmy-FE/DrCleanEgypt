<?php

namespace App\Http\Requests;

use App\Models\Item;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemRequest extends FormRequest
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
     * on creation set validation rules 
     *
     * @return array
     */
    protected function onCreate() {
        return [
            'category_id' => ['not_in:0'],
            'name' => ['required', 'string', 'max:255'],
            'laundry_price' => ['required'],
            'ironing_price' => ['required']
        ];
    }

    /**
     * on update set validation rules 
     *
     * @return array
     */
    protected function onUpdate() {
        return [
            'category_id' => ['not_in:0'],
            'name' => ['required', 'string', 'max:255'],
            'laundry_price' => ['required'],
            'ironing_price' => ['required']
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->isMethod('put') ? $this->onUpdate() : $this->onCreate();
    }

    public function attributes()
    {
        return [
            'image' => 'صورة الصنف',
            'category_id' => 'القسم',
            'name' => 'إسم الصنف',
            'ironing_price' => 'سعر كي الصنف',
            'laundry_price' => 'سعر غسل الصنف'
        ];   
    }

    public function store()
    {
        Item::create([
            'name' => $this->name,
            'laundry_price' => $this->laundry_price,
            'ironing_price' => $this->ironing_price,
            'category_id' => $this->category_id
        ]);
    }

    public function update($id)
    {
        $item = Item::findOrFail($id);

        $item->update($this->all());
    }
}
