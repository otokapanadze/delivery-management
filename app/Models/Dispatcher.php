<?php
// app/Models/Dispatcher.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatcher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone'];

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
}
