@extends('layouts.admin')
@section('content')
@include('admin.includes.alerts.success')
@include('admin.includes.alerts.errors')


   <div class="container" style="position: relative;top: 95px;right: 67px;">
    <x-breadcrumb title="لغات الموقع"  linkTitle="{{route('language.index')}}" title1="أضافة لغة جديدة" linkTitle1="{{route('language.create')}}"/>
    <table class="table table-striped table-advance table-hover">

        <h4>جميع لغات الموقع</h4>
        <hr>
        <thead>
          <tr>
            <th>الاسم</th>
            <th class="hidden-phone">اختصار</th>
            <th> اتجاه</th>
            <th> الحالة</th>
            <th> الاجراءات</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @isset($Languages)
                @foreach ($Languages as $lang)
                    <tr>
                        <td>{{$lang->name}}</td>
                        <td class="hidden-phone">{{$lang->abbr}}</td>
                        <td>{{$lang->getDirection()}}</td>
                        <td><span class="label label-info label-mini">{{$lang->getActive()}}</span></td>
                        <td>
                        <a href="" class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>
                        <a href="{{route('language.edit',$lang->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                        <form action="{{route('language.destroy',$lang->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash-o"></i></button>
                        </form>

                        </td>
                    </tr>
                @endforeach

            @endisset


        </tbody>
      </table>
   </div>


@endsection
