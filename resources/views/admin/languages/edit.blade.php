@extends('layouts.admin')
@section('content')



<div class="container" style="position: relative;top: 95px;right: 67px;">
    <x-breadcrumb title="لغات الموقع"  linkTitle="{{route('language.index')}}" title1="أضافة لغة جديدة" linkTitle1=""/>
    <form class="form" action="{{route('language.update',$language->id)}}" method="POST">
        @method('put')
        @csrf
      <div class="row">
        <div class="form-group">

          <div class="col-md-6">
            <label>اسم اللغة</label>
            <input type="text" id="name" value="{{$language->name}}"  placeholder="ادخل اسم اللغة" name="name" class="form-control">

            @error('name')
            <p class="help-block">{{$message}}</p>
            @enderror
          </div>
          <div class="col-md-6">
            <label>اختصار اللغة</label>
            <input type="text" id="abbr" value="{{$language->abbr}}"  placeholder="ادخل اختصار اللغة" name="abbr" class="form-control">

            @error('abbr')
            <p class="help-block">{{$message}}</p>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <div class="form-group">

          <div class="col-md-6">
            <label>اتجاه اللغة</label>

            <select name="direction" class="form-control">

              <option value="rtl" @if($language->direction=='rtl')selected @endif>من اليمين الى اليسار</option>
              <option value="ltr" @if($language->direction=='ltr')selected @endif>من اليسار الى اليمين</option>
            </select>
            @error('direction')
            <p class="help-block">{{$message}}</p>
            @enderror
          </div>



            <div class="col-md-6">


                <div class="showback">
                    <h4><i class="fa"></i>الحالة</h4>

                        <label class="rad-label">
                            <input type="radio" class="rad-input" name="active" id="active" value="1" @if($language->active==1)checked @endif>
                            <div class="rad-design"></div>
                            <span class="rad-text">مفعل</span>
                          </label>

                          <label class="rad-label">
                            <input type="radio" class="rad-input" name="active" id="active" value="2" @if($language->active==2)checked @endif   >
                            <div class="rad-design"></div>
                            <div class="rad-text">غير مفعل</div>
                          </label>




                </div>

                @error('active')
                <p class="help-block">{{$message}}</p>
                @enderror
            </div>


        </div>
      </div>
      <button type="submit" class="btn btn-success">{{__('messages.update')}}</button>
    </form>


@endsection
