<?php

namespace App\Repositories;

use App\Models\Menu;
use Illuminate\Support\Facades\Gate;

class MenuRepository extends Repository
{
    
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    public function addMenu($request)
    {
        if (Gate::denies('save', $this->model)) {
            abort(403);
        }
        
        $data = $request->only(['title', 'parent_id', 'type']);
        
        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        // dd($request->all());

        switch ($data['type']) {
            case 'custom_link' :
                $data['path'] = $request->input('custom_link');
                if (empty($data['path'])) {
                    $data['path'] = route('home');
                    // return ['error' => 'Введите ссылку'];
                }
                break;
            case 'blog_link' :
                if ($request->input('category_alias')) {
                    if ($request->input('category_alias') == 'parent') {
                        $data['path'] = route('articles.index');
                    } else {
                        $data['path'] = route('articlesCat', ['cat_alias' => $request->input('category_alias')]);
                    }
                } elseif ($request->input('article_alias')) {
                    $data['path'] = route('articles.show', ['alias' => $request->input('article_alias')]);
                }
                break;
            case 'portfolio_link' :
                if ($request->input('filter_alias')) {
                    if ($request->input('filter_alias') == 'parent') {
                        $data['path'] = route('portfolios.index');
                    } else {
                        // $data['path'] = route('filters.show', ['alias' => $request->input('filter_alias')]);
                        return ['error' => 'Механизм фильтрации в разработке. Выберите другой пункт меню.'];
                    }
                } elseif ($request->input('portfolio_alias')) {
                    $data['path'] = route('portfolios.show', ['alias' => $request->input('portfolio_alias')]);
                }
                break;
            default :
                return ['error' => 'Недостаточно данных для формирования ссылки!'];
        }

        unset($data['type']);

        // dd($data);

        if ($this->model->fill($data)->save()) {
            return ['status' => 'Пункт меню добавлен.'];
        }
    }

    public function updateMenu($request, $menu)
    {
        // TODO: заменить save на update, добавить в providers
        if (Gate::denies('save', $this->model)) {
            abort(403);
        }
        
        $data = $request->only(['title', 'parent_id', 'type']);
        
        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        // dd($request->all());

        switch ($data['type']) {
            case 'custom_link' :
                $data['path'] = $request->input('custom_link');
                if (empty($data['path'])) {
                    $data['path'] = route('home');
                    // return ['error' => 'Введите ссылку'];
                }
                break;
            case 'blog_link' :
                if ($request->input('category_alias')) {
                    if ($request->input('category_alias') == 'parent') {
                        $data['path'] = route('articles.index');
                    } else {
                        $data['path'] = route('articlesCat', ['cat_alias' => $request->input('category_alias')]);
                    }
                } elseif ($request->input('article_alias')) {
                    $data['path'] = route('articles.show', ['alias' => $request->input('article_alias')]);
                }
                break;
            case 'portfolio_link' :
                if ($request->input('filter_alias')) {
                    if ($request->input('filter_alias') == 'parent') {
                        $data['path'] = route('portfolios.index');
                    } else {
                        // $data['path'] = route('filters.show', ['alias' => $request->input('filter_alias')]);
                        return ['error' => 'Механизм фильтрации в разработке. Выберите другой пункт меню.'];
                    }
                } elseif ($request->input('portfolio_alias')) {
                    $data['path'] = route('portfolios.show', ['alias' => $request->input('portfolio_alias')]);
                }
                break;
            default :
                return ['error' => 'Недостаточно данных для формирования ссылки!'];
        }

        unset($data['type']);

        // dd($data);

        if ($menu->fill($data)->update()) {
            return ['status' => 'Пункт меню успешно обновлён.'];
        }
    }

    public function deleteMenu($menu)
    {
        // TODO: заменить save на delete, добавить в providers
        if (Gate::denies('save', $this->model)) {
            abort(403);
        }

        if ($menu->delete()) {
            return ['status' => 'Пункт меню успешно удалён.'];
        }
    }
}