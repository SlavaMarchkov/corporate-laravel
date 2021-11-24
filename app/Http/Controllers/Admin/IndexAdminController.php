<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Gate;

class IndexAdminController extends AdminController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->template = config('settings.theme') . '.admin.index'; // переопределяем шаблон для главной страницы
    }

    public function index()
    {
        $this->title = 'Панель администратора';

        if (Gate::denies('VIEW_ADMIN')) {
            abort(403, 'Нет прав для доступа');
        }
        
        return $this->renderOutput();
    }
}
