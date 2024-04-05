<?php

namespace App\Listeners;

use App\Events\ProductsFetched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Redis;

class CacheProducts
{
    public function handle(ProductsFetched $event)
    {
        $products = $event->products;
        $expirationTimestamp = now()->addMinutes(10)->timestamp;
        
        Redis::set('all_products', serialize($products), 'EX', $expirationTimestamp);
    }
}
