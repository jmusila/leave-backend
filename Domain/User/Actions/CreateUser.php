<?php

namespace Domain\User\Actions;

use App\Models\User;
use Domain\BaseAction;
use Illuminate\Support\Facades\Hash;

class CreateUser extends BaseAction
{
    public function execute(): User
    {
        $user = User::create([
            'first_name' => data_get($this->data, 'first_name'),
            'middle_name' => data_get($this->data, 'middle_name'),
            'last_name' => data_get($this->data, 'last_name'),
            'email' => data_get($this->data, 'email'),
            'phone_number' => data_get($this->data, 'phone_number'),
            'password' => Hash::make(data_get($this->data, 'password')),
        ]);

        return $user;
    }
}
