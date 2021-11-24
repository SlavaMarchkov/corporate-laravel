<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Config;

/**
 * Класс отвечает за получение данных из базы данных.
 */
abstract class Repository
{

    protected $model; // объект модели, использующийся для получения данных

    /**
     * Получаем все поля из БД для данной модели
     */
    public function get($select = '*', $take = FALSE, $pagination = FALSE, $where = FALSE)
    {
        $builder = $this->model->select($select);

        if ($take) {
            $builder->take($take);
        }

        if ($where) {
            $builder->where($where[0], $where[1]);
        }
        
        if ($pagination) {
            return $this->check($builder->paginate(Config::get('settings.pagination')));
        }

        return $this->check($builder->get());
    }

    public function one($alias, $attr = [])
    {
        return $this->model->where('alias', $alias)->first();
    }

    protected function check($result)
    {
        if ($result->isEmpty()) {
            return FALSE;
        }
        $result->transform(function ($item, $key) {
            if (is_string($item->img) && is_object(json_decode($item->img)) && (json_last_error() == JSON_ERROR_NONE)) {
                $item->img = json_decode($item->img);
            }
            return $item;
        });

        return $result;
    }

    public function transliterate($string)
    {
        $str = mb_strtolower($string, 'UTF-8');
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
    
            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        foreach ($converter as $cyr => $lat) {
            $cyr = explode(',', $cyr);
            $str = str_replace($cyr, $lat, $str);
        }
        $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $str);
        $str = trim($str, '-');

        return $str;
    }

}
