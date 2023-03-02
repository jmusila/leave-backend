<?php

namespace Domain\User\Actions;

use App\Models\User;
use Domain\BaseAction;
use Domain\User\DataTransferObjects\UserData;
use Illuminate\Support\Facades\Hash;

class CreateUser extends BaseAction
{
    public function execute(): User
    {
        $user = User::create(UserData::fromArray($this->data)->toArray());

        return $user;
    }
}
