<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Repositories\RolesRepository;

class PermissionsRepository extends Repository 
{

    protected $roles_repository;

    public function __construct(
        Permission $permission,
        RolesRepository $roles_repository
    )
    {
        $this->model = $permission;
        $this->roles_repository = $roles_repository;
    }

    public function changePermissions($request)
    {
        if (Gate::denies('change', $this->model)) {
            abort(403);
        }

        $data = $request->except('_token');
        $roles = $this->roles_repository->get(['id', 'name']);
        foreach ($roles as $role) {
            if (isset($data[$role->id])) {
                $role->savePermissions($data[$role->id]);
            } else {
                $role->savePermissions([]);
            }
        }

        return ['status' => 'Привилегии пользователей обновлены.'];
    }
}