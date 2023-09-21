<?php
// app/DTOs/UserData.php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductDTO extends DataTransferObject
{
    public string $name;
    public int $price;
    public ?UploadedFile $photo;
    public ?string $description;
    public int $payment_type;

    public function validate(): void
    {
        $validator = Validator::make($this->all(), [
            'name' => 'required|max:100',
            'price' => 'integer|min:0|max:99999999999',
            'photo' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|max:255',
            'payment_type' => 'integer|min:0|max:1'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'photo' => $this->photo ?? '',
            'description' => $this->description ?? '',
            'payment_type' => $this->payment_type,
        ];
    }
}
