<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountRule extends Model
{
    protected $fillable = ['name', 'discount_type', 'discount_value', 'status'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'discount_rule_product')
                    ->withPivot('variant_id');
    }
}
