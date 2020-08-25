<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = "languages";
    protected $guarded = ['id'];
    // protected $fillible = ['abbr','name' , 'direction' , 'active'];

    public function getActiveAttribute($val)
    {
        return $val == 1 ? "مُفعل" : "غير مُفعل";
    }

    public function scopeActive($query)
    {
        return $query->where('active' , 1);
    }

    public function scopeSelection($query)
    {
        return $query->select(['id' ,'abbr' , 'name' , 'direction' , 'active']);
    }
}
