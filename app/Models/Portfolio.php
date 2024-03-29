<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    public function filter()
    {
        return $this->belongsTo('App\Models\Filter', 'filter_alias', 'alias');
    }
}
