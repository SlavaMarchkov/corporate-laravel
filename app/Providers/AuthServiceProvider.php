<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Models\Article;
use App\Models\Menu;
use App\Models\Permission;
use App\Policies\ArticlePolicy;
use App\Policies\MenuPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Permission::class => PermissionPolicy::class,
        Menu::class => MenuPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('VIEW_ADMIN', function (User $user) {
            return $user->canDo('VIEW_ADMIN', FALSE);
        });
        
        Gate::define('VIEW_ADMIN_ARTICLES', function (User $user) {
            return $user->canDo('VIEW_ADMIN_ARTICLES', FALSE);
        });
        
        Gate::define('EDIT_PERMISSIONS', function (User $user) {
            return $user->canDo('EDIT_PERMISSIONS', FALSE);
        });
        
        Gate::define('VIEW_ADMIN_MENU', function (User $user) {
            return $user->canDo('VIEW_ADMIN_MENU', FALSE);
        });
        
        Gate::define('VIEW_ADMIN_USERS', function (User $user) {
            return $user->canDo('VIEW_ADMIN_USERS', FALSE);
        });
        
        Gate::define('VIEW_ADMIN_PORTFOLIOS', function (User $user) {
            return $user->canDo('VIEW_ADMIN_PORTFOLIOS', FALSE);
        });

        Gate::define('UPDATE_USER', function (User $user) {
            return $user->canDo('UPDATE_USER', FALSE);
        });
    }
}
