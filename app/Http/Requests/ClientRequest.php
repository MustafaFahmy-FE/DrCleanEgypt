<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientRequest extends FormRequest
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
            'name' => ['required' , 'string' , 'max:255'],
            'address' => ['required' , 'string' , 'max:255'],
            'phone' => ['required' , 'unique:clients,phone'],
            'building' => ['required' , 'numeric'],
            'floor' => ['required' , 'numeric'],
            'apartment' => ['required' , 'numeric']
        ];
    }

    /**
     * on update set validation rules 
     *
     * @return array
     */
    protected function onUpdate() {
        return [
            'name' => ['required' , 'string' , 'max:255'],
            'address' => ['required' , 'string' , 'max:255'],
            'phone' => ['required' , 'unique:clients,phone,'.$this->id],
            'building' => ['required' , 'numeric'],
            'floor' => ['required' , 'numeric'],
            'apartment' => ['required' , 'numeric']
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
            'name' => 'إسم العميل',
            'address' => 'العنوان',
            'phone' => 'رقم التليفون',
            'building' => 'رقم المبني',
            'floor' => 'الدور',
            'apartment' => 'رقم الشقه'
        ];
    }

    public function store()
    {
        Client::create($this->all());
    }

    public function update($id)
    {
        Client::findOrFail($id)->update($this->all());
    }
}
