<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Repositories\ArticlesRepository;
use App\Repositories\CommentsRepository;
use App\Repositories\MenuRepository;
use App\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;

class ArticleController extends SiteController
{

    public function __construct(
        PortfoliosRepository $portfolios_repository,
        ArticlesRepository $articles_repository,
        CommentsRepository $comments_repository
    ) {
        parent::__construct(new MenuRepository(new Menu()));
        $this->portfolios_repository = $portfolios_repository;
        $this->articles_repository = $articles_repository;
        $this->comments_repository = $comments_repository;
        $this->sidebar = 'right';
        $this->template = config('settings.theme') . '.articles';
    }

    public function index($cat_alias = FALSE)
    {
        $articles = $this->getArticles($cat_alias);

        // мета-данные
        // TODO: переопределить и прописать эти данные для каждой категории
        $this->title = 'Блог';
        $this->keywords = 'Ключевые слова';
        $this->description = 'Мета Описание';

        $content = view(config('settings.theme') . '.articles_content')
            ->with('articles', $articles)
            ->render();
        $this->vars['content'] = $content;

        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $comments = $this->getComments(config('settings.recent_comments'));
        $this->right_sidebar = view(config('settings.theme') . '.articles_bar')
            ->with([
                'portfolios' => $portfolios,
                'comments' => $comments,
            ])->render();

        return $this->renderOutput();
    }

    public function show($alias)
    {
        $article = $this->articles_repository->one($alias, ['comments' => TRUE]);
        if ($article) {
            $article->img = json_decode($article->img);
        }
        
        // dd($article->comments->groupBy('parent_id'));

        // мета-данные
        if (isset($article->id)) {
            $this->title = $article->title;
            $this->keywords = $article->keywords;
            $this->description = $article->description;
        }

        $content = view(config('settings.theme') . '.article_content')
            ->with('article', $article)
            ->render();
        $this->vars['content'] = $content;

        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $comments = $this->getComments(config('settings.recent_comments'));
        $this->right_sidebar = view(config('settings.theme') . '.articles_bar')
            ->with([
                'portfolios' => $portfolios,
                'comments' => $comments,
            ])->render();

        return $this->renderOutput();
    }

    protected function getArticles($alias = FALSE)
    {
        $where = FALSE;
        if ($alias) {
            $id = Category::select('id')->where('alias', $alias)->first()->id;
            $where = ['category_id', $id];
        }
        $articles = $this->articles_repository->get([
            'id',
            'title',
            'alias',
            'keywords',
            'description',
            'img',
            'created_at',
            'excerpt',
            'user_id',
            'category_id',
        ], FALSE, TRUE, $where);

        // https://laravel.com/docs/8.x/eloquent-relationships#lazy-eager-loading
        // жадная загрузка - то есть загружаются сразу все связанные модели
        if ($articles) {
            $articles->load('user', 'category', 'comments');
        }

        return $articles;
    }

    protected function getComments($take)
    {
        $comments = $this->comments_repository->get([
            'id',
            'name',
            'email',
            'text',
            'website',
            'article_id',
            'user_id',
        ], $take);

        // жадная загрузка - то есть загружаются сразу все связанные модели
        if ($comments) {
            $comments->load('article', 'user');
        }

        return $comments;
    }
    
    protected function getPortfolios($take)
    {
        $portfolios = $this->portfolios_repository->get([
            'title',
            'alias',
            'text',
            'customer',
            'img',
            'filter_alias',
        ], $take);

        return $portfolios;
    }
}
