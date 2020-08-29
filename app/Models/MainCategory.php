<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = "main_categories";
    
    protected $fillible = ['translation_lang' , 'translation_of' , 'name' , 'slug' , 'photo' , 'active' ,'created_at' , 'updated_at'];


    public function getActiveAttribute($val)
    {
        return $val == 1 ? "مُفعل" : "غير مُفعل";
    }
    
    public function getPhotoAttribute($val)
    {
        return ($val != null) ? asset($val) : "";
    }
    
    public function scopeActive($val)
    {
        return $val->where('active', 1);
    }

    public function scopeSelection($query)
    {
        $query->select('id', 'translation_lang' , 'translation_of' ,'name', 'slug' , 'photo' , 'active');
    }


    // Relations

    public function categories()
    {
        return $this->hasMany(self::class, 'translation_of');
    }
}
