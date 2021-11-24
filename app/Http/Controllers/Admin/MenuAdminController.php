<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Filter;
use App\Repositories\ArticlesRepository;
use App\Repositories\MenuRepository;
use App\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Lavary\Menu\Menu;
use App\Http\Requests\MenuRequest;
use App\Models\Menu as MenuModel;

class MenuAdminController extends AdminController
{

    protected $menu_repository;

    public function __construct(
        MenuRepository $menu_repository,
        ArticlesRepository $articles_repository,
        PortfoliosRepository $portfolios_repository
    )
    {
        parent::__construct();
        $this->menu_repository = $menu_repository;
        $this->articles_repository = $articles_repository;
        $this->portfolios_repository = $portfolios_repository;
        $this->template = config('settings.theme') . '.admin.menus';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('VIEW_ADMIN_MENU')) {
            abort(403);
        }
        $this->title = 'Управление фронт-энд меню :: Панель администратора';
        $menu = $this->getFrontMenu();
        $this->content = view(config('settings.theme') . '.admin.menus_content')
            ->with('menu', $menu)
            ->render();

        return $this->renderOutput();
    }

    protected function getFrontMenu()
    {
        $menu = $this->menu_repository->get([
            'id',
            'title',
            'path',
            'parent_id',
        ]);
        if ($menu->isEmpty()) {
            return FALSE;
        }

        return (new Menu)->make('forAdminMenu', function ($m) use ($menu) {
            foreach ($menu as $menu_item) {
                if ($menu_item->parent_id == 0) {
                    $m->add($menu_item->title, $menu_item->path)->id($menu_item->id);
                } else {
                    if ($m->find($menu_item->parent_id)) {
                        $m->find($menu_item->parent_id)->add($menu_item->title, $menu_item->path)->id($menu_item->id);
                    }
                }
            }
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Добавление нового пункта меню :: Панель администратора';

        // оставляем только родительские пункты меню
        $tmp = $this->getFrontMenu()->roots();
        // dump($tmp);

        // формируем массив из родительских пунктов меню из объекта $tmp
        $null_item = ['0' => 'Родительский пункт меню'];
        $menus = $tmp->reduce(function ($returnItems, $menu_item) {
            $returnItems[$menu_item->id] = $menu_item->title;
            return $returnItems;
        }, $null_item);
        // dump($menus);

        // категории
        $categories = Category::select(['id', 'title', 'alias', 'parent_id'])->get();
        // dump($categories);

        $list = [];
        $list['0'] = 'Не используется';
        $list['parent'] = 'Раздел Блог';
        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $list[$category->title] = [];
            } else {
                $list[$categories->where('id', $category->parent_id)->first()->title][$category->alias] = $category->title;
            }
        }
        // dump($list);

        // записи блога
        $articles = $this->articles_repository->get(['id', 'title', 'alias']);
        $articles = $articles->reduce(function ($returnArticles, $article) {
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        }, []);
        // dump($articles);
        
        // фильтры
        $filters = Filter::select(['id', 'title', 'alias'])->get()->reduce(function ($returnFilters, $filter) {
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
        }, ['parent' => 'Все разделы портфолио']);
        // dump($filters);

        // конкретная работа портфолио
        $portfolios = $this->portfolios_repository->get(['id', 'title', 'alias'])->reduce(function ($returnPortfolios, $portfolio) {
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
        }, []);
        // dump($portfolios);

        $this->content = view(config('settings.theme') . '.admin.menu_create_content')
            ->with([
                'menus' => $menus,
                'categories' => $list,
                'articles' => $articles,
                'filters' => $filters,
                'portfolios' => $portfolios,
            ])
            ->render();

        return $this->renderOutput();    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $result = $this->menu_repository->addMenu($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.menus.index')->with($result);
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
    public function edit(MenuModel $menu)
    {
        $this->title = 'Редактирование пункта меню ' . $menu->title . ' :: Панель администратора';

        $type = FALSE;
        $option = FALSE;

        // получаем данные маршрута из $menu->path
        // dd(app('router'));
        // dd(app('request'));
        $route = app('router')
                ->getRoutes()
                ->match(app('request')->create($menu->path));

        // маршрут для ссылки пункта меню, напр. "articlesCat"
        $alias_route = $route->getName();
        // массив параметров маршрута данной ссылке пункта меню
        /**
         * array:1 [▼
                "cat_alias" => "computers"
            ]
         */
        $parameters = $route->parameters();

        // dd($alias_route);

        if ($alias_route == 'articles.index' || $alias_route == 'articlesCat') {
            $type = 'blog_link';
            $option = (isset($parameters['cat_alias']) ? $parameters['cat_alias'] : 'parent');
        } elseif ($alias_route == 'articles.show') {
            $type = 'blog_link';
            $option = (isset($parameters['alias']) ? $parameters['alias'] : '');
        } elseif ($alias_route == 'portfolios.index') {
            $type = 'portfolio_link';
            $option = 'parent';
        } elseif ($alias_route == 'portfolios.show') {
            $type = 'portfolio_link';
            $option = (isset($parameters['alias']) ? $parameters['alias'] : '');
        } else {
            $type = 'custom_link';
        }

        $tmp = $this->getFrontMenu()->roots();

        $null_item = ['0' => 'Родительский пункт меню'];
        $menus = $tmp->reduce(function ($returnItems, $menu_item) {
            $returnItems[$menu_item->id] = $menu_item->title;
            return $returnItems;
        }, $null_item);

        $categories = Category::select(['id', 'title', 'alias', 'parent_id'])->get();

        $list = [];
        $list['0'] = 'Не используется';
        $list['parent'] = 'Раздел Блог';
        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $list[$category->title] = [];
            } else {
                $list[$categories->where('id', $category->parent_id)->first()->title][$category->alias] = $category->title;
            }
        }

        $articles = $this->articles_repository->get(['id', 'title', 'alias']);
        $articles = $articles->reduce(function ($returnArticles, $article) {
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        }, []);
        
        $filters = Filter::select(['id', 'title', 'alias'])->get()->reduce(function ($returnFilters, $filter) {
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
        }, ['parent' => 'Все разделы портфолио']);

        $portfolios = $this->portfolios_repository->get(['id', 'title', 'alias'])->reduce(function ($returnPortfolios, $portfolio) {
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
        }, []);

        $this->content = view(config('settings.theme') . '.admin.menu_create_content')
            ->with([
                'menu' => $menu,
                'type' => $type,
                'option' => $option,
                'menus' => $menus,
                'categories' => $list,
                'articles' => $articles,
                'filters' => $filters,
                'portfolios' => $portfolios,
            ])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuModel $menu)
    {
        $result = $this->menu_repository->updateMenu($request, $menu);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.menus.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuModel $menu)
    {
        $result = $this->menu_repository->deleteMenu($menu);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.menus.index')->with($result);
    }
}
