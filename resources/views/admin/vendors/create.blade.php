@extends('layouts.admin')
@section('content')



<div class="container" style="position: relative;top: 95px;right: 67px;">
    <x-breadcrumb title="المتاجر الرئيسية"  linkTitle="{{route('vendors.index')}}" title1="أضافة متجر رئيسي جديد" linkTitle1=""/>
    <form class="form" action="{{route('vendors.store')}}" enctype="multipart/form-data" method="POST">
      @csrf

                <div class="row">
                    <div class="form-group">
                            <div class="col-md-6">
                                <label>اسم المتجر</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}">
                                @error('name')
                                 <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label>اختر القسم</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        @if ($MainCategories && $MainCategories->count()>0)
                                           @foreach ($MainCategories as $MainCategory)
                                               <option value="{{$MainCategory->id}}">{{$MainCategory->name}}</option>
                                           @endforeach
                                        @endif
                                     </select>
                                    @error('category_id')
                                     <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                               </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="showback">
                        <h4><i class="fa"></i>الحالة</h4>

                        <label class="rad-label">
                            <input type="radio" class="rad-input" name="active" id="active" value="1" checked>
                            <div class="rad-design"></div>
                                <span class="rad-text">مفعل</span>
                        </label>

                        <label class="rad-label">
                            <input type="radio" class="rad-input" name="active" id="active" value="2">
                            <div class="rad-design"></div>
                            <div class="rad-text">غير مفعل</div>
                        </label>
                        @error('active')
                            <p class="text-danger">{{$message}}</p>
                        @enderror

                       </div>
                    </div>

                </div>
                <br>



       <div class="row">
           <div class="form-group">
            <div class="col-md-6">
                <label>رقم الهاتف</label>
                <input type="text" id="mobile" name="mobile" class="form-control" value="{{old('mobile')}}" maxlength="15">
                @error('mobile')
                 <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label>البريد الألكتروني</label>
                <input type="text" id="email" name="email" class="form-control" value="{{old('email')}}">
                @error('email')
                 <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
           </div>
       </div>

       <div class="row">
        <div class="form-group">
         <div class="col-md-6">
             <label>كلمة المرور</label>
             <input type="password" id="password" name="password" class="form-control" value="{{old('password')}}">

             @error('password')
              <span class="text-danger">{{$message}}</span>
             @enderror
         </div>

        </div>
    </div>


      <br>
      <div class="row">
        <div class="col-md-6">

            <label class="control-label col-md-3">تحميل صورة</label>
            <div class="col-md-9">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                  <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                <div>
                  <span class="btn btn-theme02 btn-file">
                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                  <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                  <input type="file" name="logo" class="default" />

                  </span>
                  @error('photo')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                </div>
              </div>
              <span class="label label-info">NOTE!</span>
              <span>
                Attached image thumbnail is
                supported in Latest Firefox, Chrome, Opera,
                Safari and Internet Explorer 10 only
                </span>
            </div>
        </div>
        <div class="col-md-6">
            <label for="address">العنوان</label>
            <input type="text" name="address" id="address" class="form-control">
            @error('address')
            <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="row">
                <iframe width="520" height="402" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=520&amp;height=402&amp;hl=en&amp;q=%20Amman+(irbid,alhuson)&amp;t=k&amp;z=10&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> <a href='https://mapswebsite.net/'>embedding google map</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=e2593397e614636fc18a510c49f60ae67845163c'></script>
            </div>


        </div>
      </div>







      <button type="submit" class="btn btn-success">حفظ</button>
    </form>


@endsection
