<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_order_id',
//        'integration_id',
        'customer_name',
        'customer_email',
        'total_amount',
        'status',
        'placed_at',
    ];

    protected $casts = [
        'placed_at' => 'datetime',
    ];

    /**
     * Get the integration associated with the order.
     */
//    public function integration()
//    {
//        return $this->belongsTo(Integration::class);
//    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
}
