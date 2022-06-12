@extends('layouts.admin')
@section('content')


<div class="container" style="position: relative;top: 95px;right: 67px;">
    <x-breadcrumb title="الأقسام الرئيسية"  linkTitle="{{route('maincategories.index')}}" title1="تعديل قسم - {{$mainCategory->name}}" linkTitle1=""/>
    <form class="form" action="{{route('maincategories.update',$mainCategory->id)}}" enctype="multipart/form-data" method="POST">
       @method('put')
      @csrf
               <!-- This field for return id when update method in validation  required_without:id -->
                <input type="hidden" name="id" value="{{$mainCategory->id}}">

                <div class="row">
                    <div class="form-group">
                            <div class="col-md-6">
                                <label>اسم القسم-{{__('messages.'.$mainCategory->translation_lang)}}</label>
                                <input type="text" id="name" name="category[0][name]" class="form-control" value="{{$mainCategory->name}}">
                                @error('category.0.name')
                                 <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 hidden">
                                <label>اختصار اللغة-{{__('messages.'.$mainCategory->translation_lang)}}</label>
                                <input type="text" id="translation_lang"   name="category[0][translation_lang]" class="form-control" value="{{$mainCategory->translation_lang}}">

                                @error('category.0.translation_lang')
                                <span class="text-danger">هذا الحقل مطلوب</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="showback">
                                <h4><i class="fa"></i>الحالة-{{__('messages.'.$mainCategory->translation_lang)}}</h4>

                                <label class="rad-label">
                                    <input type="radio" class="rad-input" name="category[0][active]" id="active" value="1" @if($mainCategory->active==1)checked @endif>
                                    <div class="rad-design"></div>
                                        <span class="rad-text">مفعل</span>
                                </label>

                                <label class="rad-label">
                                    <input type="radio" class="rad-input" name="category[0][active]" id="active" value="2"  @if($mainCategory->active==2)checked @endif>
                                    <div class="rad-design"></div>
                                    <div class="rad-text">غير مفعل</div>
                                </label>
                                @error('category.0.active')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror

                            </div>
                        </div>

                    </div>
                </div>

                <br>
      <br>
      <div class="row">
        <div class="col-md-6">

            <label class="control-label col-md-3">تحميل صورة</label>
            <div class="col-md-9">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                  <img src="{{$mainCategory->photo}}" alt="تحميل صورة القسم" />
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

    <div class="col-md-6 mt">
        <div class="row content-panel">
          <div class="panel-heading">
            <ul class="nav nav-tabs nav-justified">
                {{-- return the model realtion categories() --}}
                @isset($mainCategory->categories)
                  @foreach ($mainCategory->categories as $index=>$translation)

                     <li class="@if($index==0) active @endif">
                          <a data-toggle="tab" href="#overview{{$index}}" aria-expanded="{{$index==0 ? 'true':'false'}}">
                            {{$translation->translation_lang}}
                         </a>
                     </li>
                  @endforeach
              @endisset

            </ul>
          </div>
          <!-- /panel-heading -->
          <!-- tabs to another language rather than default,use if isset and foreach to duplicate the tab for another language-->
          <div class="panel-body">
            <div class="tab-content">
                @isset($mainCategory->categories)
                  @foreach ($mainCategory->categories as $index=>$translation)
                    <div id="overview{{$index}}" aria-expanded="{{$index==0 ? 'true':'false'}}" class="tab-pane @if($index==0) active @endif">
                        <div class="row">
                            <form class="form" action="{{route('maincategories.update',$translation->id)}}"
                                enctype="multipart/form-data" method="POST">
                                @method('put')
                            @csrf
                                        <!-- This field for return id when update method in validation  required_without:id -->
                                        <input type="hidden" name="id" value="{{$translation->id}}">

                                        <div class="row">
                                            <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label>اسم القسم-{{__('messages.'.$translation->translation_lang)}}</label>
                                                        <input type="text" id="name" name="category[0][name]" class="form-control" value="{{$translation->name}}">
                                                        @error('category.0.name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 hidden">
                                                        <label>اختصار اللغة-{{__('messages.'.$translation->translation_lang)}}</label>
                                                        <input type="text" id="translation_lang"   name="category[0][translation_lang]" class="form-control" value="{{$translation->translation_lang}}">

                                                        @error('category.0.translation_lang')
                                                        <span class="text-danger">هذا الحقل مطلوب</span>
                                                        @enderror
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                        <div class="showback">
                                                            <h4><i class="fa"></i>الحالة-{{__('messages.'.$translation->translation_lang)}}</h4>

                                                            <label class="rad-label">
                                                                <input type="radio" class="rad-input" name="category[0][active]" id="active" value="1" @if($translation->active==1)checked @endif>
                                                                <div class="rad-design"></div>
                                                                    <span class="rad-text">مفعل</span>
                                                            </label>

                                                            <label class="rad-label">
                                                                <input type="radio" class="rad-input" name="category[0][active]" id="active" value="2"  @if($translation->active==2)checked @endif>
                                                                <div class="rad-design"></div>
                                                                <div class="rad-text">غير مفعل</div>
                                                            </label>
                                                            @error('category.0.active')
                                                                <p class="text-danger">{{$message}}</p>
                                                            @enderror

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                            <button type="submit" class="btn btn-success">تحديث</button>
                            </form>
                        </div>
                    </div>
                @endforeach
              @endisset
            </div>
            <!-- /tab-content -->
          </div>
          <!-- /panel-body -->
        </div>
        <!-- /col-lg-12 -->
      </div>


@endsection
