<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($this->isHttpException($e)) {
                $statusCode = $e->getStatusCode();
    
                switch ($statusCode) {
                    case '404' :
                        $obj = new \App\Http\Controllers\SiteController(new \App\Repositories\MenuRepository(new \App\Models\Menu()));
                        $navigation = view(config('settings.theme') . '.navigation')
                            ->with('menu', $obj->getMenu())
                            ->render();
                        Log::alert('Страница не найдена: ' . $request->url());
                    return response()
                        ->view(config('settings.theme') . '.404', [
                            'bar' => 'no',
                            'title' => 'Страница не найдена',
                            'navigation' => $navigation,
                        ]);
                }
            }
        });
    }
}
