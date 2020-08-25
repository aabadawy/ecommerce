<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainCategory;
use App\Http\Requests\MainCategoryRequest;

class MainCategoryController extends Controller
{
    public function index()
    {
        $default_lang = get_default_language();
        $maincategories = MainCategory::where('translation_lang' , $default_lang)->selection()->get();
        return view('admin.maincategories.index' , compact('maincategories'));
    }

    public function create()
    {
        return view('admin.maincategories.create');
    }

    public function store(MainCategoryRequest $request)
    {
        return response($request);
    }
}
