<?php

namespace App\Http\Requests\Trade;

class OrderRequest
{
    public float $limit_price;
    public ?float $quantity; // Nullable
    public ?float $amount; // Nullable
    public string $order_type;

    // Constructor to initialize properties
    public function __construct(array $data)
    {
        $this->limit_price = $data['limit_price'];
        $this->quantity = $data['quantity'] ?? null;
        $this->amount = $data['amount'] ?? null;
        $this->order_type = $data['order_type'];
    }
}
