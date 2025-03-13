<?php

namespace App\Http\Requests\Trade;

use App\Enums\TradeSettingMode;
use App\Models\TradeSetting;
use Illuminate\Validation\Rule;
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
            'name' => 'required|string|max:100',
            'retry_attempt' => 'nullable',
            'skip_attempt' => 'nullable',
            'risk_percentage' => 'required',
            'open_on_candle_close' => 'nullable',
            'inactive_order_cancel_minutes' => 'required',
            'order_trade_settings' => 'nullable|string|max:2000',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            // 'retry_attempt' => intval($this->retry_attempt),
            // 'skip_attempt' => intval($this->skip_attempt),
            // 'risk_percentage' => intval($this->risk_percentage),
            // 'open_on_candle_close' => boolval($this->open_on_candle_close),
            // 'inactive_order_cancel_minutes' => intval($this->inactive_order_cancel_minutes),
            // 'order_trade_settings' => strval($this->order_trade_settings),
        ]);
    }

    protected $redirect = '/trade-setting/create';
}
