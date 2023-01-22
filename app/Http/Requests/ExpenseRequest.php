<?php

namespace App\Http\Requests;

use App\Models\Expense;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ExpenseRequest extends FormRequest
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
            'name' => ['required' , 'string' , 'max:255'],
            'type' => ['not_in:0'],
            'price' => ['required' , 'numeric']
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'إسم المصروف',
            'price' => 'قيمة المصروف',
            'type' => 'نوع المصروف'
        ];
    }

    public function store()
    {
        Expense::create($this->all());
    }

    public function update($id)
    {
        Expense::findOrFail($id)->update($this->all());
    }
}
