<?php

namespace App\Services;
use App\Models\Order;

abstract class OrderImportService
{
    /**
     * Import orders from the source platform.
     *
     * @return void
     */
    abstract public function import(): void;

    /**
     * Store an order in the database.
     *
     * @param array $orderData
     * @return Order
     */
    protected function storeOrder(array $orderData): Order
    {
        return Order::updateOrCreate(
            ['external_order_id' => $orderData['id']],
            $orderData
        );
    }
}
