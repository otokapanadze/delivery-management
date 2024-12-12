<?php
// app/Models/Delivery.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = ['dispatcher_id', 'driver_id', 'route_data', 'status', 'proof_of_delivery'];

    protected $casts = [
        'route_data' => 'array',
        'proof_of_delivery' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($delivery) {
            if ($delivery->isDirty('status')) {
                // Log the status update
                DeliveryUpdate::create([
                    'delivery_id' => $delivery->id,
                    'status' => $delivery->status, // New status
                    'description' => "Status changed to '{$delivery->status}'.",
                ]);
            }
        });
    }

    public function dispatcher()
    {
        return $this->belongsTo(Dispatcher::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function statuses()
    {
        return $this->hasMany(DeliveryUpdate::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
