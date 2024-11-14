<?php

namespace App\Http\Requests\Trade;

use Illuminate\Foundation\Http\FormRequest;

class TradeSettingRequest extends FormRequest
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
            'tradeId' => 'required|integer',
            'name' => 'required|string|max:25',
            'riskReward' => 'nullable|integer',
            'retryAttempt' => 'required|integer',
            'skipAttempt' => 'required|integer|min:0',
            'candleCloseTrigger' => 'required|boolean',
            'riskedAmount' => 'required|numeric|min:0',
            'stopLossWickClose' => 'required|boolean',
            'stopLossWickCloseValue' => 'required|integer',
            'secureTradeOnProfit' => 'required|boolean',
            'secureTradeValue' => 'required|integer',

        ];
    }
}
