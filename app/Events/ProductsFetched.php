<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductsFetched
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }
}
