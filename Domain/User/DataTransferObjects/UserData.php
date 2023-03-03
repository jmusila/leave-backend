<?php

namespace Domain\User\DataTransferObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Hash;

class UserData implements Arrayable
{
    public function __construct(
        public string $first_name,
        public string $middle_name,
        public string $last_name,
        public string $email,
        public string $password,
        public string $phone_number
    ) {
    }
 
    public static function fromArray(array $data): self
    {
        return new self(
            first_name: data_get($data, 'first_name'),
            middle_name: data_get($data, 'middle_name'),
            last_name: data_get($data, 'last_name'),
            email: data_get($data, 'email'),
            phone_number: data_get($data, 'phone_number'),
            password: Hash::make(data_get($data, 'password')),
        );
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}
