<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PermissionsRepository;
use App\Repositories\RolesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionAdminController extends AdminController
{

    protected $permissions_repository;
    protected $roles_repository;

    public function __construct(
        PermissionsRepository $permissions_repository,
        RolesRepository $roles_repository
    )
    {
        parent::__construct();
        $this->permissions_repository = $permissions_repository;
        $this->roles_repository = $roles_repository;
        $this->template = config('settings.theme') . '.admin.permissions';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('EDIT_PERMISSIONS')) {
            abort(403, 'Нет прав для просмотра привилегий');
        }

        $this->title = 'Управление правами пользователей';
        $roles = $this->getRoles();
        $permissions = $this->getPermissions();
        
        $this->content = view(config('settings.theme') . '.admin.permissions_content')
            ->with([
                'roles' => $roles,
                'permissions' => $permissions,
            ])
            ->render();

        return $this->renderOutput();
    }

    protected function getRoles()
    {
        return $this->roles_repository->get([
            'id',
            'name',
        ]);
    }
    
    protected function getPermissions()
    {
        return $this->permissions_repository->get([
            'id',
            'name',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->permissions_repository->changePermissions($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return back()->with($result);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
