<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'login',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', $value)->firstOrFail();
    }

    /**
     * $abilities может быть как строкой, так и массивом прав
     * Если isAllPermissions = TRUE, то должны быть ВСЕ права
     * Если isAllPermissions = FALSE, то хотя бы одно право
     */
    public function canDo($abilities, $isAllPermissions = FALSE)
    {
        if (is_array($abilities)) { // если это массив с правами
            foreach ($abilities as $ability) {
                $hasAbility = $this->canDo($ability);
                if ($hasAbility && !$isAllPermissions) { // если найдено хотя бы одно право, то canDo дает TRUE
                    return TRUE;
                } elseif (!$hasAbility && $isAllPermissions) {
                    return FALSE;
                }
            }

            return $isAllPermissions;
        } else { // если это одна строка
            foreach ($this->roles as $role) {
                foreach ($role->permissions as $permission) {
                    if (str_contains($permission->name, $abilities)) {
                        return TRUE;
                    }
                }
            }
        }

        return FALSE;
    }

    /**
     * Проверка на наличие роли (массива ролей) у пользователя
     */
    public function hasRole($roleNames, $isRoleRequired = FALSE)
    {
        if (is_array($roleNames)) {
            foreach ($roleNames as $roleName) {
                $hasRole = $this->hasRole($roleName);
                if ($hasRole && !$isRoleRequired) {
                    return TRUE;
                } elseif (!$hasRole && $isRoleRequired) {
                    return FALSE;
                }
            }

            return $isRoleRequired;
        } else {
            foreach ($this->roles as $role) {
                if ($role->name == $roleNames) {
                    return TRUE;
                }
            }
        }

        return FALSE;
    }
}
