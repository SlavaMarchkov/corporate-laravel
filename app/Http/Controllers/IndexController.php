<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MenuRepository;
use App\Models\Menu;
use App\Repositories\ArticlesRepository;
use App\Repositories\PortfoliosRepository;
use App\Repositories\SlidersRepository;
use Illuminate\Support\Facades\Config;

class IndexController extends SiteController
{

    public function __construct(
        SlidersRepository $sliders_repository,
        PortfoliosRepository $portfolios_repository,
        ArticlesRepository $articles_repository
    ) {
        parent::__construct(new MenuRepository(new Menu()));

        $this->portfolios_repository = $portfolios_repository;
        $this->articles_repository = $articles_repository;
        $this->sliders_repository = $sliders_repository; // получаем объект слайдера из репозитория
        $this->template = config('settings.theme') . '.index'; // имя шаблона для главной страницы сайта
        $this->sidebar = 'right'; // строка для класса sidebar-right
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // портфолио
        $portfolios = $this->getPortfolios();
        $content = view(config('settings.theme') . '.content')
            ->with('portfolios', $portfolios)
            ->render();
        $this->vars['content'] = $content;

        // слайды для слайдера
        $sliderItems = $this->getSliders();
        $sliders = view(config('settings.theme') . '.slider')
            ->with('sliders', $sliderItems)
            ->render();
        $this->vars['sliders'] = $sliders;

        // правый сайдбар
        $articles = $this->getArticles();
        $this->right_sidebar = view(config('settings.theme') . '.index_bar')
            ->with('articles', $articles)
            ->render();


        // мета-данные
        $this->keywords = 'Главная страница';
        $this->meta_description = 'Главная страница';
        $this->title = 'Главная страница';

        return $this->renderOutput();
    }

    protected function getArticles()
    {
        $articles = $this->articles_repository->get([
            'title',
            'alias',
            'img',
            'created_at',
        ], Config::get('settings.count_articles_home_page'));

        return $articles;
    }

    protected function getPortfolios()
    {
        $portfolios = $this->portfolios_repository->get(
            '*',
            Config::get('settings.count_portfolio_home_page')
        );

        return $portfolios;
    }

    protected function getSliders()
    {
        $sliders = $this->sliders_repository->get();

        if ($sliders->isEmpty()) {
            return false;
        }

        $sliders->transform(function ($item, $key) {
            $item->img = Config::get('settings.slider_path') . '/' . $item->img;
            return $item;
        });

        return $sliders;
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
        //
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
