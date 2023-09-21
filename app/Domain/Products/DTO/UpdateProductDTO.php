<?php

namespace App\Domain\Products\DTO;

use App\Domain\Products\Models\Product;
use Illuminate\Http\UploadedFile;

class UpdateProductDTO
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var int
     */
    private int $price;


    private $photo;

    private $description;

    /**
     * @var int
     */
    private int $payment_type;



    /**
     * @var Product
     */
    private Product $product;


    /**
     * @param array $data
     * @return UpdateProductDTO
     */
    public static function fromArray(array $data): UpdateProductDTO
    {
        $dto = new self();
        $dto->setName($data['name']);
        $dto->setPrice($data['price']);
        $dto->setPhoto($data['photo']);
        $dto->setDescription($data['description']);
        $dto->setPaymentType($data['payment_type']);
        $dto->setProduct($data['product']);
        return $dto;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function setPhoto(?UploadedFile $photo): void
    {
        $this->photo = $photo;
    }

    public function getPhoto(): ?UploadedFile
    {
        return $this->photo;
    }


    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }


    /**
     * @return int
     */
    public function getPaymentType(): int
    {
        return $this->payment_type;
    }

    /**
     * @param int $payment_type
     */
    public function setPaymentType(int $payment_type): void
    {
        $this->payment_type = $payment_type;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }
}
