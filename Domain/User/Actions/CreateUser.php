<?php

namespace Domain\User\Actions;

use App\Models\User;
use Domain\BaseAction;

class CreateUser extends BaseAction
{
    public function execute(): User
    {
        $user = new User($this->data);

        return $user;
    }
}
