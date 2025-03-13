<?php

namespace App\Http\Requests\Trade;

use Closure;
use App\Enums\Side;
use App\Models\Symbol;
use App\Enums\Derivate;
use App\Enums\Exchange;
use App\Enums\OrderType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\TradeService;
use Illuminate\Support\Fluent;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TradeRequest extends FormRequest
{
    protected $symbolData = null;
    protected $tradeSettingData = null;
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
            'symbol' => function (string $attribute, mixed $value, Closure $fail)
            {
                $symbol = DB::select('select * from symbol where name = ? and exchange_id = ?', [$value, $this->exchange_id]);
                if (count($symbol) == 0)
                {
                    $fail("The {$attribute} is invalid.");
                }
                else
                {
                    $this->symbolData = $symbol[0];
                }
            },
            'exchange_id' => 'required',
            'side' => Rule::in('Buy', 'Sell'),
            'derivate' => Rule::in('Spot', 'Futures', 'Coin'),
            'trade_setting_id' => 'nullable',
            'orders.*.type' => 'required',
            'orders.*.is_open' => 'nullable',

        ];
    }

    // public function after(): array
    // {
    //     return [
    //         function (Validator $validator)
    //         {
    //             $orders = $this->orders;
    //             if (isset($value['amount']))
    //             {
    //  `               $value['quantity'] = $value['amount'] / $value['limit_price'];
    //             }
    //         }
    //     ];
    // }

    // protected function validateSymbol(string $symbol)
    // {
    //     $symbolData = DB::select('select * from symbol where symbol = ?', [$symbol]);
    //     if (!isset($symbolData))
    //     {
    //     }
    // }

    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //         'side' => strtolower($this->side),
    //     ]);
    // }

    /**
     * The URI that users should be redirected to if validation fails.
     *
     * @var string
     */
    protected $redirect = '/trade/create';

    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json($validator->errors(), 422));
    // }

    public function attributes(): array
    {
        return [
            'exchange_id' => 'exchange',
        ];
    }

    protected function passedValidation(): void
    {
        $orders = $this->orders;
        $closeSide = $this->side === 'Buy' ? 'Sell' : 'Buy';
        foreach ($orders as $key => $order)
        {
            if (isset($order['quantity']))
            {
                $orders[$key]['quantity'] = number_format($order['quantity'], $this->symbolData->quantity_precision);
            }
            if (isset($order['amount']))
            {
                $quantity = number_format($order['amount'] / $order['limit_price'], $this->symbolData->quantity_precision);
                $orders[$key]['quantity'] = $quantity;
                $orders[$key]['amount'] = number_format($quantity * $order['limit_price'], 2);
            }
            if (isset($order['limit_price']))
            {
                $orders[$key]['limit_price'] = number_format($order['limit_price'], $this->symbolData->price_precision);
            }
            if (isset($order['stop_price']))
            {
                $orders[$key]['stop_price'] = number_format($order['stop_price'], $this->symbolData->price_precision);
            }
            $orders[$key]['reference'] = Str::uuid();

            $orders[$key]['side'] = $this->side;
            if (!isset($order['is_open']))
            {
                $orders[$key]['side'] = $closeSide;
            }
        }
        $this->replace(['orders' => $orders]);
    }

    // public function messages(): array
    // {
    //     return [
    //         'exchange_id.required' => 'The exchange field is required.'
    //     ];
    // }
}
