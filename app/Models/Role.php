<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'role_user');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'permission_role');
    }

    public function hasPermission($permissionNames, $isPermissionRequired = FALSE)
    {
        if (is_array($permissionNames)) {
            foreach ($permissionNames as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);
                if ($hasPermission && !$isPermissionRequired) {
                    return TRUE;
                } elseif (!$hasPermission && $isPermissionRequired) {
                    return FALSE;
                }
            }

            return $isPermissionRequired;
        } else {
            foreach ($this->permissions as $permission) {
                if ($permission->name == $permissionNames) {
                    return TRUE;
                }
            }
        }

        return FALSE;
    }

    public function savePermissions($permissions)
    {
        if (!empty($permissions)) {
            $this->permissions()->sync($permissions);
        } else {
            $this->permissions()->detach();
        }

        return TRUE;
    }
}
