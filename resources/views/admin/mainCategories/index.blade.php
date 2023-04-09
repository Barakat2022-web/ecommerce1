@extends('layouts.admin')
@section('content')
@include('admin.includes.alerts.success')
@include('admin.includes.alerts.errors')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
                        <input type="hidden" class="serdelete_val_id" value="{{$MainCategory->id}}"/>
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
                                     <button class="btn btn-danger btn-xs servideletebtn" type="submit"><i class="fa fa-trash-o"></i></button>
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
                    url:'/admin/maincategories/'+delete_id,
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
