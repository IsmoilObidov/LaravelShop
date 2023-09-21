<?php
// app/DTOs/UserData.php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginDTO extends DataTransferObject
{
    public string $name;
    public string $password;

    public function validate(): void
    {
        $validator = Validator::make($this->all(), [
            'name' => 'required',
            'password' => 'required',
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
