<?php

namespace App\Domain\Baskets\DTO;

use Illuminate\Support\Facades\Auth;

class StoreBasketDTO
{
    /**
     * @var int
     */
    private int $user_id;

    /**
     * @var int
     */
    private int $product_id;


    /**
     * @param array $data
     * @return StoreBasketDTO
     */
    public static function fromArray(array $data): StoreBasketDTO
    {
        $dto = new self();
        $dto->setUserId(Auth::id());
        $dto->setProductId($data['product_id']);
        return $dto;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @param int $product_id
     */
    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }
}
