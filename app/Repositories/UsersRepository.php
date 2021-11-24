<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UsersRepository extends Repository 
{

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function addUser($request)
    {
        if (Gate::denies('save', $this->model)) {
            abort(403);
        }

        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'login' => $data['login'],
            'password' => bcrypt($data['password']),
        ]);

        // привязываем роли к созданному пользователю
        if ($user) {
            $user->roles()->attach($data['role_id']);
        }

        return ['status' => 'Пользователь удачно добавлен.'];
    }
    
    public function updateUser($request, $user)
    {
        if (Gate::denies('edit', $this->model)) {
            abort(403);
        }

        $data = $request->all();
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        
        $user->fill($data)->update();
        $user->roles()->sync([$data['role_id']]);

        return ['status' => 'Пользователь удачно изменён.'];
    }

    public function deleteUser($user)
    {
        if (Gate::denies('delete', $this->model)) {
            abort(403);
        }
        
        $user->roles()->detach();

        if ($user->delete()) {
            return ['status' => 'Пользователь удалён.'];
        }
    }

}