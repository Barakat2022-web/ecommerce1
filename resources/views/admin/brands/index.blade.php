@extends('layouts.admin')
@section('content')
@include('admin.includes.alerts.success')
@include('admin.includes.alerts.errors')
<link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />

   <div class="container" style="position: relative;top: 95px;right: 67px;">
    <x-breadcrumb title="الأقسام الرئيسية"  linkTitle="{{route('maincategories.index')}}" title1="أضافة قسم جديد" linkTitle1="{{route('maincategories.create')}}"/>
    <table cellpadding="0" cellspacing="0" class="display table table-bordered" id="hidden-table-info">
        <thead>
          <tr>
            <th>القسم</th>
            <th>الصورة</th>
            <th>تاريخ الأنشاء</th>
            <th>تاريخ التحديث</th>
            <th class="hidden-phone">الحالة</th>
            <th class="hidden-phone">الأجراءات</th>
           </tr>
        </thead>
        <tbody>
            @isset($MainCategories)
               @foreach ($MainCategories as $MainCategory)
                    <tr>
                        <td>{{$MainCategory->name}}</td>
                        <td><img style="width: 100px;height: 100px;max-width: fit-content" src="{{$MainCategory->photo}}"></td>
                        <td>{{$MainCategory->created_at}}</td>
                        <td>{{$MainCategory->updated_at}}</td>
                        <td class="hidden-phone">
                            <span class="label label-info label-mini">{{$MainCategory->getActive()}}</span>
                        </td>
                             <td>

                                <a href="{{route('maincategories.edit',$MainCategory->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>

                                <form action="{{route('maincategories.destroy',$MainCategory->id)}}" method="post">
                                     @method('delete')
                                     @csrf
                                     <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash-o"></i></button>
                                 </form>

                                 <a href="{{route('maincategories.Changestatus',$MainCategory->id)}}" class="btn btn-warning btn-xs">
                                 @if ($MainCategory->active==1)
                                 ألغاء تفعيل @else
                                   تفعيل
                                   @endif


                         </tr>


                    </tr>
                @endforeach
            @endisset
        </tbody>
      </table>
   </div>


@endsection
