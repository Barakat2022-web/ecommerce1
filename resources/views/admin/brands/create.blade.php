@extends('layouts.admin')
@section('content')



<div class="container" style="position: relative;top: 95px;right: 67px;">
    <x-breadcrumb title="الأقسام الرئيسية"  linkTitle="{{route('maincategories.index')}}" title1="أضافة قسم رئيسي جديد" linkTitle1=""/>
    <form class="form" action="{{route('maincategories.store')}}" enctype="multipart/form-data" method="POST">
      @csrf
       {{-- This mean to check the active language --}}
       @if (get_languages()->count()>0)
            @foreach (get_languages() as $index=>$lang)

                <div class="row">
                    <div class="form-group">
                            <div class="col-md-12">
                                <label>اسم القسم-{{__('messages.'.$lang->abbr)}}</label>
                                <input type="text" id="name" name="category[{{$index}}][name]" class="form-control" value="{{old('category[0][name]')}}">
                                @error('category.0.name')
                                 <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 hidden">
                                <label>اختصار اللغة-{{__('messages.'.$lang->abbr)}}</label>
                                <input type="text" id="translation_lang"   name="category[{{$index}}][translation_lang]" class="form-control" value="{{$lang->abbr}}">

                                @error('category.0.translation_lang')
                                <span class="text-danger">هذا الحقل مطلوب</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="showback">
                                <h4><i class="fa"></i>الحالة-{{__('messages.'.$lang->abbr)}}</h4>

                                <label class="rad-label">
                                    <input type="radio" class="rad-input" name="category[{{$index}}][active]" id="active" value="1" checked>
                                    <div class="rad-design"></div>
                                        <span class="rad-text">مفعل</span>
                                </label>

                                <label class="rad-label">
                                    <input type="radio" class="rad-input" name="category[{{$index}}][active]" id="active" value="2">
                                    <div class="rad-design"></div>
                                    <div class="rad-text">غير مفعل</div>
                                </label>
                                @error('category.$index.active')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror

                            </div>
                        </div>

                    </div>
                </div>

                <br>
            @endforeach
       @endif
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
                    <span class="fileupload-new"><i class="fa fa-paperclip"></i>أختر صورة</span>
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







      <button type="submit" class="btn btn-success">حفظ</button>
    </form>


@endsection
