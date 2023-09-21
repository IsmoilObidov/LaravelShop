<?php
// app/DTOs/UserData.php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginDTO extends DataTransferObject
{
    public string $name;
    public ?string $parent_id;

    public function validate(): void
    {
        $validator = Validator::make($this->all(), [
            'name' => 'required',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'password' => $this->password,
        ];
    }
}
