<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends SiteController
{
    
    public function __construct()
    {
        parent::__construct(new MenuRepository(new Menu()));
        $this->sidebar = 'left';
        $this->template = config('settings.theme') . '.contacts';
    }

    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $messages = [
                'required' => 'Поле :attribute обязательно к заполнению',
                'email' => 'Поле :attribute должно содержать корректный email-адрес',
            ];
            $this->validate($request, [
                'name' => 'required|max:100',
                'email' => 'required|email',
                'message' => 'required',
            ], $messages);

            $data = $request->all();            

            Mail::send(config('settings.theme') . '.email', ['data' => $data], function ($message) use ($data) {
                $mail_admin = env('MAIL_ADMIN');
                $message->from($data['email'], $data['name']);                
                $message->to($mail_admin, 'Mr. Admin');                
                $message->subject('Запрос из формы обратной связи');                
            });
    
            return redirect()->route('contacts')->with('status', 'Email was sent successfully');        
        }

        $this->title = 'Контакты';

        $content = view(config('settings.theme') . '.contact_content')->render();
        $this->vars['content'] = $content;

        $this->left_sidebar = view(config('settings.theme') . '.contact_bar')->render();

        return $this->renderOutput();
    }

}
