@extends('admin_layouts.inc')
@section('title','الواجبات')
@section('breadcrumb','الواجبات')
@section('styles')
  <link href="{{ asset('/admin_ui/assets/layouts/layout4/css/image.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Main content -->
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet light bordered">
      <div class="portlet-title">
        <div class="caption font-dark">
          <i class="icon-settings font-dark"></i>
          <span class="caption-subject bold uppercase">بيانات الواجبات</span>
        </div>
        <div class="tools"> </div>
      </div>
      <div class="portlet-body">
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-6">
              <div class="btn-group">
                <button  data-toggle="modal" data-target="#addModal" id="sample_editable_1_new" class="btn btn-primary">
                  أضافة وجبة
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
              <table class="table table-striped table-bordered table-hover table-header-fixed" id="meals">
                <thead>
                  <th class="col-md-1">أسم الوجبه</th>
                  <th class="col-md-1">السعر</th>
                  <th class="col-md-1">السعر الحراري</th>
                  <th class="col-md-1">المحتوي</th>
                  <th class="col-md-1">القسم</th>
                  <th class="col-md-1">الحاله</th>
                  <th class="col-md-1">الصور</th>
                  <th class="col-md-1">الأحجام</th>
                  <th class="col-md-1">خيارات</th>
                </thead>
                <tbody>
                  @foreach ($tableData->getData()->data as $row)
                  <tr>
                    <td>{{  $row->name }}</td>
                    <td>{{  $row->price }}</td>
                    <td>{{  $row->calories }}</td>
                    <td>{{  $row->contents }}</td>
                    <td>{{  $row->category }}</td>
                    <td>{{  $row->is_active }}</td>
                    <td>{{  $row->images }}</td>
                    <td>{{  $row->sizes }}</td>
                    <td>{!! $row->actions !!}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
        </div>
      </div>

<div class="modal fade" id="displayMealImages" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editEmployeeModalLabel"><i class="fa fa-pencil"></i> أضافة صور</h4>
      </div>
      <!-- Main content -->
      <div class="row">
        <div class="col-md-12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light bordered">
            <div class="portlet-body">
              <div class="table-toolbar">
                <div class="row">
                  <div class="col-md-6">
                    <div class="btn-group">
                      <button  data-toggle="modal" data-target="#addImagesModal" id="sample_editable_1_new" class="btn btn-primary">
                        أضافة صور
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <table class="table table-striped table-bordered table-hover table-header-fixed" id="images">
                <thead>
                <th class="col-md-1">صورة الوجبة</th>
                <th class="col-md-1">خيارات</th>
                </thead>
                <tbody id="appendImages"></tbody>
              </table>
            </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
        </div>
      </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>
    </div>
  </div>
</div>

      @include('admin_layouts.Add_imgModal')
      @include('admin_layouts.Edit_imgModal')

      @endsection

      @section('scripts')
        <script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/multipart_insert.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/upload.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/app.js') }}"></script>
      <script type="text/javascript">
       $(document).ready(function() {
         $(document.body).validator().on('click', '.displayImages', function() {
           var self = $(this);
           self.button('loading');
           $.ajax({
             url: "{{ url('meals') }}" + "/" + self.data('id') + "/images" ,
             type: "GET",
             success: function(res){
               self.button('reset');
               $('#appendImages').html(res);
               $('#images').DataTable();
               // $('#displayMealImages form').attr("data-id", self.data('id') );
               $('#displayMealImages').modal('show');
             },
             error: function(){
               self.button('reset');
             }
           });
         });

         $(document.body).on('click', '.deleteForm2', function(e) {
           e.preventDefault();
           if (window.confirm("Are you sure to remove this item ?"))
           {
             var self = $(this);
             $(this).button({loadingText: 'deleting...'});
             $(this).button('loading');

             $.ajax({
               url: self.closest('form').attr('action') ,
               type: "POST",
               data: self.serialize(),
               error: function(){
                 self.button('reset');
               },
               success: function(res){
                 self.button('reset');
                   swal({
                     title: "Deleted successfully",
                     type: "success",
                     closeOnConfirm: false,
                     confirmButtonText: "OK !",
                     confirmButtonColor: "#ec6c62",
                     allowOutsideClick: true
                   });
                   $('#images').DataTable().draw;
               }
             });
           }

         });

        oTable = $('#meals').DataTable({
          "processing": true,
          "serverSide": true,
          "responsive": true,
          'paging'      : true,
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json"
          },
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          "ajax": {{ $tableData->getData()->recordsFiltered }},
          "columns": [
          {data: 'name', name: 'name'},
          {data: 'price', name: 'price'},
          {data: 'calories', name: 'calories'},
          {data: 'contents', name: 'contents'},
          {data: 'category', name: 'category'},
          {data: 'is_active', name: 'is_active'},
          {data: 'images', name: 'images'},
          {data: 'sizes', name: 'sizes'},
          {data: 'actions', name: 'actions', orderable: false, searchable: false}
          ]
        });
      });
    </script>
      <script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
    @endsection
