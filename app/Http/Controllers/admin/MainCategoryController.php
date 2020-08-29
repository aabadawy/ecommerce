<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainCategory;
use App\Http\Requests\MainCategoryRequest;
use DB;

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
        // return response($request);

        try {

            DB::beginTransaction();

            ## collect the coming categories from the request in arr
            $main_categories = collect($request->category);
            

            ## get the main_category with the default system Language
            ## to save it in the at the first
            $filtered = $main_categories->filter(function($value, $key){
                return $value['abbr'] == get_default_language();
            });

            $default_category = array_values($filtered->all()) [0];

            
            $file_path = "";
            ## check the user uploaded a photo
            if($request->has('photo')){
                $file_path = uploadImage('maincategories' , $request->photo);
            }


            ## Check for the active input 
            array_key_exists("active" , $default_category) ? $active_val = 1 : $active_val = 0 ;
            ## End Checking

            $default_category_id = MainCategory::insertGetId([
                'translation_lang' => $default_category['abbr'],
                'translation_of' => 0,
                'active' => $active_val,
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $file_path,
            ]);

            ## get all categories where the lang doesn't equal the default language
            $categories = $main_categories->filter(function($value, $key){
                return $value['abbr'] != get_default_language();
            });

            ## check is there $categories
            if(isset($categories) && $categories->count())
            {
                $categories_arr = [] ;
                
                foreach ($categories as $category) {
                    
                    ## Check for the active input 
                    array_key_exists("active" , $category) ? $active_val = 1 : $active_val = 0 ;
                    ## End Checking

                    $categories_arr[] = [
                        'translation_lang' => $category['abbr'],
                        'translation_of' => $default_category_id,
                        'active' => $active_val,
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $file_path,
                    ];
                }
                MainCategory::insert($categories_arr);
            }

            DB::commit();
            return redirect()->route('admin.maincategories')->with('success' , '.تم الحفظ بنجاح');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.maincategories')->with('error' , 'حدث خطأ أثناء الحفظ، الرجاء المحاولة في وقت لاحق.');
        }
    }

    public function edit($id)
    {
       $mainCategory =  MainCategory::with('categories')->selection()->find($id);
       if(!$mainCategory)
            return redirect()->route('admin.maincategories')->with('error' , 'هذا القسم غير موجود، الرجاء المحاولة مرى أخرى.');
        else
            return view('admin.maincategories.edit' , compact('mainCategory'));
    }
    
    public function update($id, MainCategoryRequest $request)
    {

        try
        {
            $main_category = MainCategory::find($id);

            if(!$main_category)
                return redirect()->route('admin.maincategories')->with('error' , 'هذا القسم غير موجود، الرجاء المحاولة مرى أخرى.');


            $category = array_values($request->category) [0];

            ## Check for the active input 
            array_key_exists("active" , $category) ? $active_val = 1 : $active_val = 0 ;
            ## End Checking

            $main_category = MainCategory::where('id' , $id);
            if($request->has('photo'))
            {
                $file_path = uploadImage('maincategories' , $request->photo);
                $main_category->update([
                    'name' => $category['name'],
                    'active' => $active_val,
                    'photo' => $file_path,
                ]);
            }
            else 
            {
                $main_category->update([
                    'name' => $category['name'],
                    'active' => $active_val,
                ]);
            }

            return redirect()->route('admin.maincategories')->with('success' , '.تم التعديل بنجاح');
        } catch(\Exception $ex){
            DB::rollback();
            return redirect()->route('admin.maincategories')->with('error' , 'حدث خطأ أثناء التعديل، الرجاء المحاولة في وقت لاحق.');        }
    }

    public function destroy($id)
    {
        $mainCategory = MainCategory::findOrFail($id);
        $mainCategory->delete();
        return redirect()->route('admin.maincategories')->with(['success' => 'تم الحذف بنجاح']);
    }
}
