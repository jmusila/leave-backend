<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use Domain\User\Actions\CreateUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(CreateUserRequest $request)
    {
        $user = (new CreateUser())->fromData($request->validated())->execute();

        return new UserResource($user);
    }
}
