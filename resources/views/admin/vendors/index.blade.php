@extends('layouts.admin')
@section('content')
@include('admin.includes.alerts.success')
@include('admin.includes.alerts.errors')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />

   <div class="container" style="position: relative;top: 95px;right: 67px;">
    <x-breadcrumb title="الأقسام الرئيسية"  linkTitle="{{route('vendors.index')}}" title1="أضافة متجر جديد" linkTitle1="{{route('vendors.create')}}"/>

    <table class="table table-striped table-advance table-hover">
        <h4>المتاجر الرئيسية</h4>
        <hr>
        <thead>
          <tr>
            <th><i class="fa fa-bullhorn">الاسم</i> </th>
            <th class="hidden-phone"><i class="fa fa-question-circle">الصورة</i></th>
            <th><i class="fa fa-bookmark">رقم الموبايل</i> </th>
            <th><i class="fa fa-bookmark">العنوان</i> </th>
            <th><i class="fa fa-bookmark">البريد الألكتروني</i> </th>
            <th><i class="fa fa-bookmark">القسم الرئيسي</i> </th>
            <th class="hidden-phone">الحالة</th>
            <th class="hidden-phone">الأجراءات</th>
          </tr>
        </thead>
        <tbody>
            @isset($vendors)
            @foreach ($vendors as $vendor)
            <tr>
                <input type="hidden" class="serdelete_val_id" value="{{$vendor->id}}"/>
                <td>{{$vendor->name}}</td>
                <td class="hidden-phone"><img style="width: 100px;height: 100px;max-width: fit-content" src="{{$vendor->logo}}"></td>
                <td>{{$vendor->mobile }}</td>
                <td>{{$vendor->address}}</td>
                <td>{{$vendor->email}}</td>

                    <td>
                        @isset($vendor->MainCategory->name)
                        {{$vendor->MainCategory->name}}
                        @else
                        {{__('messages.no_department')}}
                        @endisset
                    </td>



                <td><span class="label label-success label-mini">{{$vendor->getActive()}}</span></td>
                <td>

                  <a href="{{route('vendors.edit',$vendor->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                  <form action="{{route('vendors.destroy',$vendor->id)}}" method="post">
                      @method('delete')
                      @csrf
                      <button class="btn btn-danger btn-xs servideletebtn" type="submit"><i class="fa fa-trash-o"></i></button>
                  </form>

                  <a href="{{route('vendors.status',$vendor->id)}}" class="btn btn-warning btn-xs">
                    @if ($vendor->active==1)
                                 ألغاء تفعيل @else
                                   تفعيل
                                   @endif
                </a>

                </td>
              </tr>

            @endforeach

            @endisset




        </tbody>
      </table>

   </div>


@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $('.servideletebtn').click(function(e){
            e.preventDefault();
            var delete_id=$(this).closest("tr").find(".serdelete_val_id").val();
            //console.log(delete_id);
            swal({
                    title: "{{__('messages.Are you sure?')}}",
                    text: "{{__('messages.Once deleted, you will not be able to recover this imaginary file!')}}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                var data={
                    "_token":$('input[name="_token"]').val(),
                    "id":delete_id
                }
                $.ajax({
                    type:"DELETE",
                    url:'/admin/vendors/'+delete_id,
                    data:data,
                    success:function(response){
                        swal(response.success, {
                        icon: "success",
                        }).then((result) => {
                            location.reload();
                        });
                    }
                })

            }

            });
        })
    })
</script>

@endsection
