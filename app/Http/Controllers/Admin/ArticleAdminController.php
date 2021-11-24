<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use App\Models\Category;
use App\Repositories\ArticlesRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleAdminController extends AdminController
{

    public function __construct(ArticlesRepository $articles_repository)
    {
        parent::__construct();
        $this->articles_repository = $articles_repository;
        $this->template = config('settings.theme') . '.admin.articles';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('VIEW_ADMIN_ARTICLES')) {
            abort(403, 'Нет прав для доступа');
        }
        
        $this->title = 'Управление записями блога :: Панель администратора';
        $articles = $this->getArticles();
        $this->content = view(config('settings.theme') . '.admin.articles_content')
            ->with('articles', $articles)
            ->render();
        
        return $this->renderOutput();
    }

    protected function getArticles()
    {
        return $this->articles_repository->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('save', new \App\Models\Article)) {
            abort(403, 'Нет прав на создание новой записи');
        }
        
        $this->title = 'Добавление новой записи :: Панель администратора';
        
        // TODO: желательно создать репозиторий под категории согласно структуре всего проекта
        $categories = Category::select([
            'id',
            'title',
            'alias',
            'parent_id',
        ])->get();
        $list = [];
        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $list[$category->title] = [];
            } else {
                $list[$categories->where('id', $category->parent_id)->first()->title][$category->id] = $category->title;
            }
        }
        $this->content = view(config('settings.theme') . '.admin.article_create_content')
            ->with('categories', $list)
            ->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $result = $this->articles_repository->addArticle($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.articles.index')->with($result);
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
    public function edit(Article $article)
    {
        // $article = Article::where('alias', $alias);

        if (Gate::denies('edit', new Article)) {
            abort(403, 'Нет прав на редактирование записи');
        }

        $article->img = json_decode($article->img);

        $this->title = 'Редактирование записи ' . $article->title . ' :: Панель администратора';
        
        // TODO: желательно создать репозиторий под категории согласно структуре всего проекта
        $categories = Category::select([
            'id',
            'title',
            'alias',
            'parent_id',
        ])->get();
        $list = [];
        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $list[$category->title] = [];
            } else {
                $list[$categories->where('id', $category->parent_id)->first()->title][$category->id] = $category->title;
            }
        }
        $this->content = view(config('settings.theme') . '.admin.article_create_content')
            ->with([
                'article' => $article,
                'categories' => $list,
            ])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $result = $this->articles_repository->updateArticle($request, $article);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.articles.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $result = $this->articles_repository->deleteArticle($article);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.articles.index')->with($result);
    }
}
