<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Mail\VendorCreated;
use App\Models\main_category;
use App\Models\vendor;
use App\Notifications\VendorCreated as NotificationsVendorCreated;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $vendors=vendor::selection()->paginate(5);

        return view('admin.vendors.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get main categories from model MainCategory to let the admin select the main category related to vendor

        $MainCategories=main_category::Arabic()->active()->get();
        return view('admin.vendors.create',compact('MainCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {

      //return $request->except('_token');
        try {
             //default value of file path
             $file_path="";

             if($request->has('logo'))
             {
                 //uploadImage method exist in helper folder inside app/Helpers/General.php
                 $file_path=uploadImage('vendors',$request->logo);
             }

             $vendor=vendor::create(
                 [
                     "name"=>$request->name,
                    "logo"=>$file_path,
                    "mobile"=>$request->mobile,
                    "address"=>$request->address,
                    "email"=>$request->email,
                    "active"=>$request->active,
                    "category_id"=>$request->category_id,
                    "password"=>$request->password
                     ]);

                     $message=[
                        'title'=>'Mail From admin website',
                        'body'=>'You are added to Ecommerce admin panel'
                    ];


              Mail::to($vendor->email)->send(new VendorCreated($message));

            return redirect()->route('vendors.index')->with('success','تم أضافة المتجر بنجاح');

        } catch (Exception $ex)
        {

            return redirect()->route('vendors.index')->with('error','حدث خطا ما يرجى محاولة لاحقا');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try
        {
              $vendor=vendor::Selection()->find($id);

             if(!$vendor)
               return redirect()->route('vendors.index')->with('error','هذا التاجر غير موجود أو ربما يكون محذوفا');

                     $MainCategories=main_category::Arabic()->active()->get();
            return view('admin.vendors.edit',compact('vendor','MainCategories'));
        }
        catch(Exception $ex)
        {

            return redirect()->route('vendors.index')->with('error','حدث خطا ما يرجى محاولة لاحقا');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, $id)
    {

        try {
            $vendor=vendor::Selection()->find($id);

            if(!$vendor)
              return redirect()->route('vendors.index')->with('error','هذا التاجر غير موجود أو ربما يكون محذوفا');


              /*
              use if have more than one command transaction in database
               If all command between begin and end transaction execute all,else one fail
               make rollback
              */

              DB::beginTransaction();

              if($request->has('photo'))
              {
                  //uploadImage method exist in helper folder inside app/Helpers/General.php
                  $file_path=uploadImage('vendors',$request->photo);

                  vendor::where('id',$id)->update(['logo'=>$file_path]);
              }

              $data=[];
              //The password may be updated or not
              if($request->has('password'))
              {
                  $data['password']=$request->password;
              }

              //use except password and photo because not every time need updated may be not update
              //id,_token because its get for request not to save in db
               $data=$request->except('_token','id','photo','password','_method');

              vendor::where('id',$id)->update($data);

              DB::commit();

           return redirect()->route('vendors.index')->with('success','تم تحديث بيانات  المتجر بنجاح');
        }
        catch (Exception $ex)
        {
            return $ex;
            DB::rollBack();
            return redirect()->route('vendors.index')->with('error','حدث خطا ما يرجى محاولة لاحقا');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $Vendors=vendor::find($id);



          if(!$Vendors)
          {
              return redirect()->route('vendors.index')->with('error','هذا التاجر غير موجود');

          }



          //check if main category is not related to any vendor before delete



               $logo=Str::after($Vendors->logo,'localhost:8000/');

               File::delete($logo);//Delete photo from folder

          //else Delete MainCategory
          $Vendors->delete();



          return redirect()->route('vendors.index')->with('success','تم حدف التاجر بنجاح');


      } catch (Exception $ex)
      {

          //return $ex;
          //throw $th;
          //DB::rollBack(); No need rollback because there is no more than one transaction in DB

          return redirect()->route('vendors.index')->with('error','حدث خطأ ما برجاء المحاولة لاحقا');
      }
    }

    public function ChangeStatus($id)
    {
        try
        {
            $Vendors=vendor::find($id);

            if(!$Vendors)
                return redirect()->route('vendors.index')->with('error','هذا التاجر غير موجود');

                //check if status is not active will become active else will become not active

                 $active=$Vendors->active==2?1:2;

                 //update the active column in Vendors Table
                 $Vendors->update(['active'=>$active]);

                 return redirect()->route('vendors.index')->with('success','تم تغيير حالة التاجر بنجاح');

        }
        catch(Exception $ex)
        {
            return redirect()->route('vendors.index')->with('error','حدث خطأ ما برجاء المحاولة لاحقا');
        }
    }
}
