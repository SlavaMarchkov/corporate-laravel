<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'path',
        'parent_id',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('id', $value)->firstOrFail();
    }

    public function delete(array $options = [])
    {
        self::where('parent_id', $this->id)->delete();

        return parent::delete($options);
    }
}
