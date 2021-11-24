<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Repositories\MenuRepository;
use App\Repositories\PortfoliosRepository;

class PortfolioController extends SiteController
{

    public function __construct(
        PortfoliosRepository $portfolios_repository
    )
    {
        parent::__construct(new MenuRepository(new Menu()));
        $this->portfolios_repository = $portfolios_repository;
        $this->template = config('settings.theme') . '.portfolios';
    }

    public function index()
    {
        // мета-данные
        $this->title = 'Портфолио';
        $this->keywords = 'Портфолио';
        $this->description = 'Портфолио';

        $portfolios = $this->getPortfolios();

        $content = view(config('settings.theme') . '.portfolios_content')
            ->with('portfolios', $portfolios)
            ->render();
        $this->vars['content'] = $content;

        return $this->renderOutput();
    }

    public function show($alias)
    {
        $portfolio = $this->portfolios_repository->one($alias);
        
        // мета-данные
        $this->title = $portfolio->title;
        $this->keywords = $portfolio->keywords;
        $this->description = $portfolio->description;
        
        $portfolios = $this->getPortfolios(config('settings.count_portfolio_show_page'), FALSE);

        $content = view(config('settings.theme') . '.portfolio_content')
            ->with([
                'portfolio' => $portfolio, 
                'portfolios' => $portfolios
            ])
            ->render();
        $this->vars['content'] = $content;

        return $this->renderOutput();
    }

    protected function getPortfolios($take = FALSE, $paginate = TRUE)
    {
        $portfolios = $this->portfolios_repository->get('*', $take, $paginate);
        if ($portfolios) {
            $portfolios->load('filter');
        }

        return $portfolios;
    }
}
