<?php

namespace App\Http\Requests\Trade;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => 'required',
            'amount' => 'required_if:quantity,null',
            'type' => ['required', Rule::in(['LIMIT', 'MARKET', 'STOP', 'TAKE_PROFIT', 'STOP_MARKET'])],
            'limit_price' => 'nullable',
            'stop_price' => 'nullable',
            'conditional_type' => 'required|in:some_conditional_type', // Adjust as necessary
        ];
    }

    // You may want to add custom messages, failed validation actions, etc.
    public function messages(): array
    {
        return [
            'quantity.required' => 'The quantity field is required.',
            'amount.required_if' => 'The amount field is required if quantity is not specified.',
            'type.required' => 'The order type field is required.',
        ];
    }

    // Optionally customize attributes
    public function attributes(): array
    {
        return [
            'quantity' => 'Quantity',
            'amount' => 'Amount',
            'type' => 'Type',
            'limit_price' => 'Limit Price',
            'stop_price' => 'Stop Price',
            'conditional_type' => 'Conditional Type',
        ];
    }
}
