<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'type', // e.g., 'shopify', 'woocommerce', etc.
        'access_token',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    /**
     * Mutator to set the `shop_domain` inside the `content` JSON field.
     *
     * @param string $value
     */
    public function setShopDomainAttribute(string $value)
    {
        $content = $this->content ?? [];
        $content['shop_domain'] = $value;
        $this->content = $content;
    }

    /**
     * Accessor to get the `shop_domain` from the `content` JSON field.
     *
     * @return string|null
     */
    public function getShopDomainAttribute(): ?string
    {
        return $this->content['shop_domain'] ?? null;
    }

    /**
     * Get the orders associated with the integration.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
