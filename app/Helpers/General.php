<?php
use Illuminate\Support\Facades\Config;

function get_languages()
{
    return  App\Models\Language::active()->selection()->get();
}

function get_default_language()
{
    return Config::get('app.locale');
}

function uploadImage($folder , $image)
{
    $image->store('/', $folder);
    $filename = $image->hasName();
    $path = 'images/' . $folder . '/' . $filename ;
    return $path;
}
