<?php
// app/DTOs/UserData.php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BasketDTO extends DataTransferObject
{
    public int $product_id;

    public function validate(): void
    {
        $validator = Validator::make($this->all(), [
            'product_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function toArray(): array
    {
        return [
            'product_id' => $this->product_id
        ];
    }
}
