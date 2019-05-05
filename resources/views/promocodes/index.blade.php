@extends('admin_layouts.inc')
@section('title','كوبونات الخصم')
@section('breadcrumb','كوبونات الخصم')
@section('styles')
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
          <span class="caption-subject bold uppercase">بيانات كوبونات الخصم</span>
        </div>
        <div class="tools"> </div>
      </div>
      <div class="portlet-body">
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-6">
              <div class="btn-group">
                <button  data-toggle="modal" data-target="#addModal" id="sample_editable_1_new" class="btn btn-primary">
                  أضافة كوبون خصم
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
              <table class="table table-striped table-bordered table-hover" id="descriptions">
                <thead>
                  <th class="col-md-1">رقم الكوبون</th>
                  <th class="col-md-1">الكود</th>
                  <th class="col-md-1">القيمه</th>
                  <th class="col-md-1">نوع الكوبون</th>
                  <th class="col-md-1">وصف</th>
                  <th class="col-md-1">الحاله</th>
                  <th class="col-md-1">خيارات</th>
                </thead>
                <tbody>
                  @foreach ($tableData->getData()->data as $row)
                  <tr>
                    <td>{{  $row->id }}</td>
                    <td>{{  $row->code }}</td>
                    <td>{{  $row->value }}</td>
                    <td>{{  $row->type }}</td>
                    <td>{{  $row->description }}</td>
                    <td>{{  $row->is_active }}</td>
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

      @include('admin_layouts.Add_Modal')
      @include('promocodes.Edit_Modal')

      @endsection

      @section('scripts')
        <script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/insert.js')}}" type="text/javascript"></script>
      <script type="text/javascript">
        function selectType(){
          $type = document.getElementById("type").value;
          if($type === 'Expiration'){
            $('#trips_limit').attr("disabled", "true");
            document.getElementById('expiration_date').removeAttribute('disabled');
          }
          else{
            $('#expiration_date').attr("disabled", "true");
            document.getElementById('trips_limit').removeAttribute('disabled');
          }
        }

        function selectType2(){
          $type = document.getElementById("type2").value;
          if($type === 'Expiration'){
            $('#trips_limit2').attr("disabled", "true");
            document.getElementById('expiration_date2').removeAttribute('disabled');
          }
          else{
            $('#expiration_date2').attr("disabled", "true");
            document.getElementById('trips_limit2').removeAttribute('disabled');
          }
        }

       $(document).ready(function() {
        oTable = $('#descriptions').DataTable({
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
          {data: 'id', name: 'id'},
          {data: 'code', name: 'code'},
          {data: 'value', name: 'value'},
          {data: 'type', name: 'type'},
          {data: 'description', name: 'description'},
          {data: 'is_active', name: 'is_active'},
          {data: 'actions', name: 'actions', orderable: false, searchable: false}
          ],
          order: [ [0, 'desc'] ]
        })
      });
    </script>
      <script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
    @endsection
