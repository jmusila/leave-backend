<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Domain\User\Actions\CreateUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $users = User::with('roles')->paginate(10);

        return UserResource::collection($users);
    }

    public function register(CreateUserRequest $request): UserResource
    {
        $user = (new CreateUser())->fromData($request->validated())->execute();

        return new UserResource($user);
    }
}
