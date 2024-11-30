<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_id',
        'status',
        'description',
    ];

    /**
     * Relationship with Delivery.
     */
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
