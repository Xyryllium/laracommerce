<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use Illuminate\Support\Facades\Redis;

class CacheNewProduct
{
    public function handle(ProductCreated $event): void
    {
        Redis::del('all_products');
    }
}
