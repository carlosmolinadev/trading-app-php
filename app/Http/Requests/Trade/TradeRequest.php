<?php

namespace App\Http\Requests\Trade;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'symbol' => 'required',
            'exchange_id' => 'required',
            'side' => ['required', Rule::in(['BUY', 'SELL'])],
            'derivate' => 'required',
            'trade_setting_id' => 'nullable',
            // 'orders.*.limit_price' => 'required',
            // 'orders.*.quantity' => 'required_if:amount,null',
            // 'orders.*.amount' => 'required_if:quantity,null',
            // 'orders.*.type' => 'required',
            // 'orders.*.parent' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    // public function attributes(): array
    // {
    //     return [
    //         'quantity' => 'Quantity',
    //         'orders' => 'orders',
    //     ];
    // }

    // public function messages(): array
    // {
    //     return [
    //         'quantity.required' => 'The :attribute field is required.',
    //         'orders.required' => 'The :attribute field is required.',
    //     ];
    // }
}
