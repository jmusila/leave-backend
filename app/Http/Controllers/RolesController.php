<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Resources\RolesResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RolesController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return RolesResource::collection(Role::all());
    }

    public function store(CreateRoleRequest $request): RolesResource
    {
        $role = Role::create(array_merge($request->only('name', ['guard_name' => 'api'])));
        $role->syncPermissions($request->permission_ids);

        return new RolesResource($role);
    }
}
