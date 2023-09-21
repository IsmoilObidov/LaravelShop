<?php

namespace App\Domain\Products\Repositories;

use App\Domain\Products\Models\Product;

class ProductRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Product::all();
    }
}
