<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = "vendors";
    
    protected $fillible = ['name' , 'email' , 'mobile' , 'logo' , 'address' , 'category_id' , 'active' ,'created_at' , 'updated_at'];

    protected $hidden = ['category_id'] ;
    
    public function scopeActive($que)
    {
        return $que->where('status' , 1 );
    }
}
