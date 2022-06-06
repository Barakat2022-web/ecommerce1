@extends('layouts.admin')
@section('content')



<div class="container" style="position: relative;top: 95px;right: 67px;">
    <x-breadcrumb title="لغات الموقع"  linkTitle="{{route('language.index')}}" title1="أضافة لغة جديدة" linkTitle1=""/>
    <form class="form" action="{{route('language.store')}}" method="POST">
      @csrf
      <div class="row">
        <div class="form-group">

          <div class="col-md-6">
            <label>اسم اللغة</label>
            <input type="text" id="name"  placeholder="ادخل اسم اللغة" name="name" class="form-control">

            @error('name')
            <p class="help-block">{{$message}}</p>
            @enderror
          </div>
          <div class="col-md-6">
            <label>اختصار اللغة</label>
            <input type="text" id="abbr"  placeholder="ادخل اختصار اللغة" name="abbr" class="form-control">

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
              <option value="rtl">من اليمين الى اليسار</option>
              <option value="ltr">من اليسار الى اليمين</option>
            </select>
            @error('direction')
            <p class="help-block">{{$message}}</p>
            @enderror
          </div>



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




            </div>
                @error('active')
                <p class="help-block">{{$message}}</p>
                @enderror



        </div>
      </div>
      <button type="submit" class="btn btn-success">حفظ</button>
    </form>


@endsection
