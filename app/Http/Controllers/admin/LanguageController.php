<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::selection()->paginate(PAGINATION_COUNT);
        return view('admin.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(LanguageRequest $request)
    {
        try {
            if(!$request->has('active'))
                $request->request->add(['active' => 0]);
            Language::create($request->except(['_token']));
            return redirect()->route('admin.languages')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (Exception $e) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);
        }
    }


    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('admin.languages.edit' , compact('language'));
    }

    public function update($id , LanguageRequest $request)
    {
        $language = Language::findOrFail($id);
        if(!$request->has('active'))
            $request->request->add(['active' => 0]);
        $language->update($request->except(['_token']));
        return redirect()->route('admin.languages')->with(['success' => 'تم التعديل بنجاح']);
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        $language->delete();
        return redirect()->route('admin.languages')->with(['success' => 'تم الحذف بنجاح']);
    }
    
}
