<?php

namespace App\Domain\Baskets\Repositories;

use App\Domain\Baskets\Models\Basket;
use Illuminate\Support\Facades\Auth;

class BasketRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Basket::where('user_id', Auth::id())->get();
    }
}
