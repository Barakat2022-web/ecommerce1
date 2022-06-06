<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Exception;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Languages=Language::select()->paginate(10);
        return view('admin.languages.index',compact('Languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {

        Language::create($request->except('_token'));

        return redirect()->route('language.index')->with('success','تم حفظ اللغة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $language=Language::select()->find($id);

            if(!$language)
            {
                return redirect()->route('language.index')->with('error','هذه اللغة غير موجودة');
            }

            return view('admin.languages.edit',compact('language'));


        }
        catch (Exception $ex)
        {
            return redirect()->route('language.index')->with('error','حدث خطا ما يرجى محاولة لاحقا');

        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, $id)
    {
        //return $request;
        try
        {
            $language=Language::find($id);

            if(!$language)
            {
                return redirect()->route('language.index',$id)->with('error','هذه اللغة غير موجودة');
            }
            //update on database
            if(!$request->has('active'))
                $request->request->add(['active'=>1]);

            $language->update($request->except('_token'));
            return redirect()->route('language.index')->with('success','تم تحديث اللغة بنجاح');

        }


        catch (Exception $ex) {
            return redirect()->route('language.index')->with('error','حدث خطأ ما يرجى محاولة لاحقا');

        }





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try
        {

              $language=Language::find($id);

            if(!$language)
            {
                return redirect()->route('language.index',$id)->with('error','هذه اللغة غير موجودة');
            }
            //Delete on database
            $language->delete();

            return redirect()->route('language.index')->with('success','تم حذف اللغة بنجاح');

        }


        catch (Exception $ex) {
            return redirect()->route('language.index')->with('error','حدث خطأ ما يرجى محاولة لاحقا');

        }

    }
}
