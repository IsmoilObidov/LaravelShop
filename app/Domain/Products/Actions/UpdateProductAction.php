<?php

namespace App\Domain\Products\Actions;

use App\Domain\Products\DTO\UpdateProductDTO;
use App\Domain\Products\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateProductAction
{
    /**
     * @param UpdateProductDTO $dto
     * @return Product
     * @throws Exception
     */
    public function execute(UpdateProductDTO $dto): Product
    {
        DB::beginTransaction();
        try {
            $product = $dto->getProduct();

            $product->name = $dto->getName();

            $product->price = $dto->getPrice();

            // Handle photo storage
            if ($dto->getPhoto()) {
                $photoPath = $dto->getPhoto()->store('products/photos', 'public');
                $product->photo = $photoPath;
            }

            $product->description = $dto->getDescription();
            $product->payment_type = $dto->getPaymentType();

            $product->update();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $product;
    }
}
