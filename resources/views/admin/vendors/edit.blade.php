@extends('layouts.admin')
@section('content')


<div class="container" style="position: relative;top: 95px;right: 67px;">
    <x-breadcrumb title="المتاجر الرئيسية"  linkTitle="{{route('vendors.index')}}" title1="تعديل متجر - {{$vendor->name}}" linkTitle1=""/>
    <form class="form" action="{{route('vendors.update',$vendor->id)}}" enctype="multipart/form-data" method="POST">
       @method('put')
      @csrf
               <!-- This field for return id when update method in validation  required_without:id -->
                <input type="hidden" name="id" value="{{$vendor->id}}">

                <div class="row">
                    <div class="form-group">
                            <div class="col-md-6">
                                <label>اسم التاجر</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{$vendor->name}}">
                                @error('name')
                                 <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label>اختر قسم</label>
                                <select class="form-control" id="category_id" name="category_id">
                                  @foreach ($MainCategories as $MainCategory)
                                    <option value="{{$MainCategory->id}}">{{$MainCategory->name}}</td></option>
                                 @endforeach
                                    @if ($MainCategories && $MainCategories->count()>0)
                                                <option value="{{$MainCategory->id}}">
                                                    @isset($vendor->MainCategory->name)
                                                    {{$vendor->MainCategory->name}}   
                                                    @endisset
                                                </option>
                                      
                                    @endif

                                 </select>
                                @error('category_id')
                                 <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>




                    </div>
                </div>

                <br>
      <br>
      <div class="row">
        <div class="form-group">
                <div class="col-md-6">
                    <label>رقم الهاتف</label>
                    <input type="text" id="mobile" name="mobile" class="form-control" value="{{$vendor->mobile}}" maxlength="15">
                    @error('mobile')
                     <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label>البريد الألكتروني</label>
                    <input type="text" id="email" name="email" class="form-control" value="{{$vendor->email}}">
                    @error('email')
                     <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>




        </div>
    </div>
    <div class="row">
        <div class="form-group">
                <div class="col-md-6">
                    <label>العنوان</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{$vendor->address}}">
                    @error('address')
                     <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label>كلمة المرور</label>
                <input type="password" id="password" name="password" class="form-control" value="{{$vendor->address}}">

                @error('password')
                 <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

           </div>
    </div>
      <div class="row">
        <div class="col-md-6">
            <div class="showback">
            <h4><i class="fa"></i>الحالة</h4>

            <label class="rad-label">
                <input type="radio" class="rad-input" name="active" id="active" value="1" @if($vendor->active==1)checked @endif>
                <div class="rad-design"></div>
                    <span class="rad-text">مفعل</span>
            </label>

            <label class="rad-label">
                <input type="radio" class="rad-input" name="active" id="active" value="2"  @if($vendor->active==2)checked @endif>
                <div class="rad-design"></div>
                <div class="rad-text">غير مفعل</div>
            </label>
            @error('active')
                <p class="text-danger">{{$message}}</p>
            @enderror

           </div>
         </div>
        <div class="col-md-6">

            <label class="control-label col-md-3">تحميل صورة</label>
            <div class="col-md-9">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                  <img src="{{$vendor->logo}}" alt="تحميل صورة القسم" />
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                <div>
                  <span class="btn btn-theme02 btn-file">
                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                  <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                  <input type="file" name="photo" class="default" />

                  </span>
                  @error('photo')
                        <p class="help-block">{{$message}}</p>
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
      </div>
      <button type="submit" class="btn btn-success">تحديث</button>
    </form>




@endsection
