<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Lavary\Menu\Menu;

class AdminController extends \App\Http\Controllers\Controller
{
    
    protected $portfolios_repository; // свойство для хранения объектов портфолио
    protected $articles_repository; // свойство для хранения объектов статей
    protected $user; // свойство для хранения объекта аутентифицированного пользователя
    protected $template;
    protected $content = FALSE; // HTML-содержимое для каждой страницы панели управления
    protected $title; // заголовок страницы
    protected $vars; // массив переменных, которые будут передаваться в шаблон

    public function __construct()
    {
        $this->middleware('auth');
        
        // сохраняем объект аутентифицированного пользователя в свойство $user
        $this->user = Auth::user();
        
        if (!$this->user) {
            return redirect()->route('login');
        }
    }

    public function renderOutput()
    {
        $this->vars['title'] = $this->title; // заголовок, который будет переопределяться в дочерних классах
        $menu = $this->getMenu(); // меню
        
        // HTML-код навигационного меню
        $navigation = view(config('settings.theme') . '.admin.navigation')
            ->with('menu', $menu)
            ->render();
        $this->vars['navigation'] = $navigation;
        
        // контент какой-либо страницы панели управления
        if ($this->content) {
            $this->vars['content'] = $this->content;
        }

        // футер
        $footer = view(config('settings.theme') . '.admin.footer')
            ->render();
        $this->vars['footer'] = $footer;

        return view($this->template)
            ->with($this->vars);
    }

    public function getMenu()
    {
        return (new Menu)->make('adminMenu', function ($menu) {
            if (Gate::allows('VIEW_ADMIN_ARTICLES')) {
                $menu->add('Записи блога', ['route' => 'admin.articles.index']);
            }
            if (Gate::allows('VIEW_ADMIN_USERS')) {
                $menu->add('Пользователи', ['route' => 'admin.users.index']);
            }
            if (Gate::allows('VIEW_ADMIN_MENU')) {
                $menu->add('Меню', ['route' => 'admin.menus.index']);
            }
            if (Gate::allows('EDIT_PERMISSIONS')) {
                $menu->add('Привилегии', ['route' => 'admin.permissions.index']);
            }
            if (Gate::allows('VIEW_ADMIN_PORTFOLIOS')) {
                $menu->add('Портфолио', ['route' => 'admin.portfolios.index']);
            }
            $menu->add('Выход', 'logout');
        });
    }
}
