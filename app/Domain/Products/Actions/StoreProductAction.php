<?php

namespace App\Domain\Products\Actions;

use App\Domain\Products\DTO\StoreProductDTO;
use App\Domain\Products\Models\Product;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreProductAction
{
    /**
     * @param StoreProductDTO $dto
     * @return Product
     * @throws Exception
     */
    public function execute(StoreProductDTO $dto): Product
    {

        DB::beginTransaction();
        try {
            if (Auth::user()->name == 'admin') {
                $product = new Product();
                $product->name = $dto->getName();
                $product->price = $dto->getPrice();

                // Handle photo storage
                if ($dto->getPhoto()) {
                    $photoPath = $dto->getPhoto()->store('products/photos', 'public');
                    $product->photo = $photoPath;
                }

                $product->description = $dto->getDescription();
                $product->payment_type = $dto->getPaymentType();
                $product->save();
            } else {
                throw new Exception("Access only for admin", 1);
            }
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $product;
    }
}
