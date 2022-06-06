<?php

namespace App\Http\Controllers\Admin;

use App\Models\main_category;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get default lang From Config
            $default_lang=get_default_lang();
           $MainCategories=main_category::where('translation_lang',$default_lang)->selection()->get();

          return view('admin.mainCategories.index',compact('MainCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mainCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCategoryRequest $request)
    {

        try
        {
             //return $request;
             //convert array of object return from request to collection

            //use collect to make filter in request return from category and see who is the ar langauge
             $MainCategories=collect($request->category);

            /*
            Filter on Arabic langage,first save the default Language in app ,
            return depend on the language in in config>app->locale using method get_default_lang()
            */
                $filter=$MainCategories->filter(function($value,$key){
                    return $value['translation_lang']==get_default_lang();
            });

            //filter->all() convert object to array

                $default_category=array_values($filter->all())[0];

                //default value of file path
                $file_path="";

                if($request->has('photo'))
                {
                    //uploadImage method exist in helper folder inside app/Helpers/General.php
                    $file_path=uploadImage('maincategories',$request->photo);
                }

                DB::beginTransaction();
                //save the first Language arabic

                $default_category_id=main_category::insertGetId([
                    'translation_lang'=>$default_category['translation_lang'],
                    'translation_of'=>0,
                    'name'=>$default_category['name'],
                    'photo'=>$file_path,
                    'active'=>$default_category['active'],
                    'created_at' => date("Y-m-d H:i:s", strtotime('now')),
                    'updated_at'=>date("Y-m-d H:i:s", strtotime('now'))


                ]);


                //Repeat the same line above for arabic ,language but here return any other Language rather than default
                $categories_other_default_lang=$MainCategories->filter(function($value,$key){
                    return $value['translation_lang']!=get_default_lang();
                });

                //check if the save categories other Languages exist and have data
                if(isset($categories_other_default_lang)&&$categories_other_default_lang->count())
                {
                    //create empty array,we create array and make foreach just for performance
                    $categories_arr=[];

                    foreach($categories_other_default_lang as $category)
                    {
                        $categories_arr[]=[
                            'translation_lang'=>$category['translation_lang'],
                            'translation_of'=>$default_category_id,
                            'name'=>$category['name'],
                            'photo'=>$file_path,
                            'active'=>$category['active'],
                            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
                            'updated_at'=>date("Y-m-d H:i:s", strtotime('now'))
                        ];
                    }

                    //save the another Language
                    main_category::insert($categories_arr);
                }

                DB::commit();

                return redirect()->route('maincategories.index')->with('success','تم أضافة القسم بنجاح');
        }
        catch (Exception $ex)
        {
            //if any problem happen during insert ,it will remove any insert statement in database
            DB::rollBack();

            return redirect()->route('maincategories.index')->with('error','حدث خطأ ما برجاء المحاولة لاحقا');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\main_category  $main_category
     * @return \Illuminate\Http\Response
     */
    public function show(main_category $main_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\main_category  $main_category
     * @return \Illuminate\Http\Response
     */
    public function edit($mainCat_id)
    {
        //find the main category depend on id,
        //get the main_categories with the translation related to this category

            $mainCategory=main_category::with('categories')->selection()->find($mainCat_id);


        //check if main category not exist
        if(!$mainCategory)
        {
            return redirect()->route('maincategories.index')->with('error','هذا القسم غير موجود');

        }

        return view('admin.mainCategories.edit',compact('mainCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\main_category  $main_category
     * @return \Illuminate\Http\Response
     */
    public function update(MainCategoryRequest $request,$main_category_id)
    {

        try {
            //  return $request;

          $main_category=main_category::find($main_category_id);

          //check if main category not exist
          if(!$main_category)
          {
              return redirect()->route('maincategories.index')->with('error','هذا القسم غير موجود');

          }

          //update model
          $first_item_maincategory=array_values($request->category)[0];

           //default value of file path
           $file_path=$main_category->photo;

           if($request->has('photo'))
           {
               //uploadImage method exist in helper folder inside app/Helpers/General.php
               $file_path=uploadImage('maincategories',$request->photo);
           }

          main_category::where('id',$main_category_id)->update([
              'name'=>$first_item_maincategory['name'],
              'active'=>$first_item_maincategory['active'],
              'photo'=>$file_path
          ]);

          return redirect()->route('maincategories.index')->with('success','تم التحديث بنجاح');
        }
        catch (Exception $ex) {

            return redirect()->route('maincategories.index')->with('error','حدث خطا ما يرجى محاولة لاحقا');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\main_category  $main_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

              $MainCategory=main_category::find($id);



            if(!$MainCategory)
            {
                return redirect()->route('maincategories.index')->with('error','هذا القسم غير موجود');

            }

            //get the vendor related to this category

               //$vendors=$MainCategory->vendors;

            //check if main category is not related to any vendor before delete
            if(isset($vendors)&&$vendors>0)
                return redirect()->route('maincategories.index')->with('error','لا يمكن حذف هذا القسم لانه يحتوي على تجار');

                 $image=Str::after($MainCategory->photo,'localhost:8000/');

                 File::delete($image);//Delete photo from folder

            //else Delete MainCategory
            $MainCategory->delete();

            //Delete Translation related to
            $MainCategory->categories()->delete();

            return redirect()->route('maincategories.index')->with('success','حذف القسم بنجاح');


        } catch (Exception $ex)
        {
            DB::rollBack();
            return redirect()->route('maincategories.index')->with('error','حدث خطأ ما برجاء المحاولة لاحقا');
        }
    }

    public function ChangeStatus($id)
    {
        try
        {
            $MainCategory=main_category::find($id);

            if(!$MainCategory)
                return redirect()->route('maincategories.index')->with('error','هذا القسم غير موجود');

                //check if status is not active will become active else will become not active

                 $active=$MainCategory->active==2?1:2;

                 //update the active column in MainCategory Table
                 $MainCategory->update(['active'=>$active]);

                 return redirect()->route('maincategories.index')->with('success','تم تغيير حالة القسم بنجاح');

        }
        catch(Exception $ex)
        {
            return redirect()->route('maincategories.index')->with('error','حدث خطأ ما برجاء المحاولة لاحقا');
        }
    }

}
