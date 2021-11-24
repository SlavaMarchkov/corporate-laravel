<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserAdminController extends AdminController
{

    protected $roles_repository;
    protected $users_repository;

    public function __construct(
        RolesRepository $roles_repository,
        UsersRepository $users_repository
    )
    {
        parent::__construct();
        $this->roles_repository = $roles_repository;
        $this->users_repository = $users_repository;
        $this->template = config('settings.theme') . '.admin.users';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('VIEW_ADMIN_USERS')) {
            abort(403, 'Нет прав для доступа');
        }

        $this->title = 'Управление пользователями :: Панель администратора';
        $users = $this->users_repository->get();
        $this->content = view(config('settings.theme') . '.admin.users_content')
            ->with('users', $users)
            ->render();
        
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Добавление нового пользователя :: Панель администратора';
        $roles = $this->getRoles()->reduce(function ($returnRoles, $role) {
            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
        }, []);
        $this->content = view(config('settings.theme') . '.admin.user_create_content')
            ->with('roles', $roles)
            ->render();
        
        return $this->renderOutput();
    }

    protected function getRoles()
    {
        return $this->roles_repository->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $result = $this->users_repository->addUser($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.users.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->title = 'Редактирование пользователя: ' . $user->name . ' :: Панель администратора';
        $roles = $this->getRoles()->reduce(function ($returnRoles, $role) {
            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
        }, []);
        $this->content = view(config('settings.theme') . '.admin.user_create_content')
            ->with([
                'roles' => $roles,
                'user' => $user,
            ])
            ->render();
        
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $result = $this->users_repository->updateUser($request, $user);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.users.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $result = $this->users_repository->deleteUser($user);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.users.index')->with($result);
    }
}
