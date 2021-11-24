<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class ArticlesRepository extends Repository
{
    
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function one($alias, $attr = [])
    {
        $article = parent::one($alias, $attr);
        
        if ($article && !empty($attr)) {
            $article->load('comments');
            $article->comments->load('user');
        }

        return $article;
    }

    public function addArticle($request)
    {
        if (Gate::denies('save', $this->model)) {
            abort(403);
        }

        $data = $request->except('_token', 'image');
        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        // если не задан псевдоним, то генерируем его через функцию транслитерации названия записи
        if (empty($data['alias'])) {
            $data['alias'] = $this->transliterate($data['title']);
        }

        // если такой псевдоним уже есть в базе данных
        if ($this->one($data['alias'], FALSE)) {
            $request->merge(['alias' => $data['alias']]);
            $request->flash();

            return ['error' => 'Данный псевдоним уже используется.'];
        }

        // если было загружено изображение
        // TODO: вынести этот метод в общий репозиторий
        if ($request->hasFIle('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                // новое имя файла сгенерированное случайным образом
                $str = uniqid();
                // объект для хранения строки в формате JSON
                $obj = new \stdClass;
                $obj->mini = $str . '_mini.jpg';
                $obj->max = $str . '_max.jpg';
                $obj->full = $str . '.jpg';

                $img = Image::make($image);

                $img->fit(Config::get('settings.image.width'), Config::get('settings.image.height'))
                    ->save(public_path() . '/' . config('settings.theme') . '/images/articles/' . $obj->full);
                $img->fit(Config::get('settings.article_images.max.width'), Config::get('settings.article_images.max.height'))
                    ->save(public_path() . '/' . config('settings.theme') . '/images/articles/' . $obj->max);
                $img->fit(Config::get('settings.article_images.mini.width'), Config::get('settings.article_images.mini.height'))
                    ->save(public_path() . '/' . config('settings.theme') . '/images/articles/' . $obj->mini);

                // формируем JSON-массив для изображений    
                $data['img'] = json_encode($obj);

                // заполняем модель собранными данными
                $this->model->fill($data);

                // сохраняем модель для текущего пользователя в таблицу articles
                if ($request->user()->articles()->save($this->model)) {
                    return ['status' => 'Новая запись успешно добавлена.'];
                }
            }
        } else {
            return ['error' => 'Загрузите изображение для создаваемой записи.'];
        }
    }
    
    public function updateArticle($request, $article)
    {
        if (Gate::denies('edit', $this->model)) {
            abort(403);
        }

        $data = $request->except('_token', '_method', 'image');
        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        // если не задан псевдоним, то генерируем его через функцию транслитерации названия записи
        if (empty($data['alias'])) {
            $data['alias'] = $this->transliterate($data['title']);
        }

        // если такой псевдоним уже есть в базе данных для другой записи
        $result = $this->one($data['alias'], FALSE); // выбираем запись из БД по её alias
        // если ID редактируемой записи не равен найденному ID, 
        // значит alias уже используется для другой записи в БД
        if (isset($result->id) && ($result->id != $article->id)) {
            $request->merge(['alias' => $data['alias']]);
            $request->flash();

            return ['error' => 'Данный псевдоним уже используется.'];
        }

        // если было загружено изображение
        if ($request->hasFIle('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                // новое имя файла сгенерированное случайным образом
                $str = uniqid();
                // объект для хранения строки в формате JSON
                $obj = new \stdClass;
                $obj->mini = $str . '_mini.jpg';
                $obj->max = $str . '_max.jpg';
                $obj->full = $str . '.jpg';

                $img = Image::make($image);

                $img->fit(Config::get('settings.image.width'), Config::get('settings.image.height'))
                    ->save(public_path() . '/' . config('settings.theme') . '/images/articles/' . $obj->full);
                $img->fit(Config::get('settings.article_images.max.width'), Config::get('settings.article_images.max.height'))
                    ->save(public_path() . '/' . config('settings.theme') . '/images/articles/' . $obj->max);
                $img->fit(Config::get('settings.article_images.mini.width'), Config::get('settings.article_images.mini.height'))
                    ->save(public_path() . '/' . config('settings.theme') . '/images/articles/' . $obj->mini);

                // формируем JSON-массив для изображений    
                $data['img'] = json_encode($obj);
            }
        }

        // заполняем запись собранными данными
        $article->fill($data);

        // сохраняем модель для текущего пользователя в таблицу articles
        if ($article->update()) {
            return ['status' => 'Запись успешно обновлена.'];
        }
    }

    public function deleteArticle($article)
    {
        if (Gate::denies('destroy', $article)) {
            abort(403);
        }

        // сначала удаляем комментарии, оставленные к удаляемой записи
        $article->comments()->delete();

        // затем удаляем саму запись
        if ($article->delete()) {
            return ['status' => 'Запись успешно удалена.'];
        }
    }

}