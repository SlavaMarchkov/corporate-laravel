<?php

namespace App\Http\Controllers;

use App\Repositories\MenuRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Lavary\Menu\Menu;

class SiteController extends Controller
{

    protected $portfolios_repository; // в этом свойстве хранится объект класса Portfolio и вся логика по работе с портфолио
    protected $sliders_repository; // в этом свойстве хранится объект класса Slider и вся логика по работе со слайдером
    protected $articles_repository; // в этом свойстве хранится объект класса Article и вся логика по работе со статьями
    protected $menu_repository;

    protected $keywords;
    protected $description;
    protected $title;

    protected $template; // шаблон
    protected $vars = []; // массив элементов, передаваемых в шаблон

    protected $sidebar = 'no'; // есть ли на странице сайдбар, по умолчанию сайдбара нет
    protected $right_sidebar = false; // есть ли на странице правый сайдбар
    protected $left_sidebar = false; // есть ли на странице левый сайдбар

    public function __construct(MenuRepository $menu_repository)
    {
        $this->menu_repository = $menu_repository;
    }

    protected function renderOutput()
    {
        // навигационное меню для всех разделов сайта
        // проверяем, есть ли меню в кэше
        // если есть, то берем его оттуда
        // если нет, то записываем в ячейку кэша сгенерированное меню
        // Cache::flush(); // удаляет весь кэш
        // Cache::forget('menu'); // удаляет одну ячейку кэша
        /* if (Cache::has('menu')) {
            $navigation = Cache::get('menu', 'Menu is empty');
            // $navigation = Cache::pull('menu', 'Menu is empty'); // получает данные из кэша и сразу же удаляет эту ячейку
        } else {
            $menu = $this->getMenu();
            $navigation = view(config('settings.theme') . '.navigation')
                ->with('menu', $menu)
                ->render();
            
            $time = Carbon::now()->addMinutes(10);
            Cache::put('menu', $navigation, $time);
            // Cache::forever('menu', $navigation); // навсегда
        } */

        // альтернативный вариант #1
        /* $navigation = Cache::get('menu', function () {
            $menu = $this->getMenu();
            $tmp = view(config('settings.theme') . '.navigation')
                ->with('menu', $menu)
                ->render();
            Cache::forever('menu', $tmp);

            return $tmp;
        }); */
        
        // альтернативный вариант #2
        $navigation = Cache::remember('menu', now()->addMinutes(10), function () {
            $menu = $this->getMenu();
            return view(config('settings.theme') . '.navigation')
                ->with('menu', $menu)
                ->render();
        });
        
        $this->vars['navigation'] = $navigation;

        // правый сайдбар
        if ($this->right_sidebar) {
            $right_bar = view(config('settings.theme') . '.right_bar')
                ->with('content_right_bar', $this->right_sidebar)
                ->render();
            $this->vars['right_bar'] = $right_bar;
        }
        
        // левый сайдбар
        if ($this->left_sidebar) {
            $left_bar = view(config('settings.theme') . '.left_bar')
                ->with('content_left_bar', $this->left_sidebar)
                ->render();
            $this->vars['left_bar'] = $left_bar;
        }
        
        // сайдбар в целом
        $this->vars['sidebar'] = $this->sidebar;

        // мета-данные
        $this->vars['keywords'] = $this->keywords;
        $this->vars['description'] = $this->description;
        $this->vars['title'] = $this->title;

        // футер
        $footer = view(config('settings.theme') . '.footer')->render();
        $this->vars['footer'] = $footer;

        return view($this->template)->with($this->vars);
    }

    /**
     * Формирование меню на основе Lavary
     */
    public function getMenu()
    {
        $menu = $this->menu_repository->get();
        $menu_builder = (new Menu)->make('PrimaryNavigation', function ($m) use ($menu) {
            foreach( $menu as $item ) {
                if ( $item->parent_id == 0 ) { // если уровень меню родительский
                    $m->add($item->title, $item->path)->id($item->id);
                } else { // если уровень меню дочерний
                    if ( $m->find($item->parent_id) ) {
                        $m->find($item->parent_id)
                            ->add($item->title, $item->path)
                            ->id($item->id);
                    }
                }
            }
        });
        
        return $menu_builder;
    }

}
