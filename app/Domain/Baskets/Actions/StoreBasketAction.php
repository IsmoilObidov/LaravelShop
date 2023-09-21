<?php

namespace App\Domain\Baskets\Actions;

use App\Domain\Baskets\DTO\StoreBasketDTO;
use App\Domain\Baskets\Models\Basket;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreBasketAction
{
    /**
     * @param StoreBasketDTO $dto
     * @return Basket
     * @throws Exception
     */
    public function execute(StoreBasketDTO $dto): Basket
    {
        DB::beginTransaction();
        try {
            $basket = new Basket();
            $basket->user_id = $dto->getUserId();
            $basket->product_id = $dto->getProductId();
            $basket->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $basket;
    }
}
