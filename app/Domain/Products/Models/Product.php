<?php

namespace App\Domain\Products\Models;

use App\Domain\Baskets\Models\Basket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function basket()
    {
        return $this->hasMany(Basket::class, 'product_id', 'id');
    }
}
