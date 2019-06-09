@extends('admin_layouts.inc')
@section('title','الأضافات')
@section('breadcrumb','الأضافات')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('styles')
<style>
  #mealAdditions tr {
    cursor: move;
  }
</style>
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
            <span class="caption-subject bold uppercase">بيانات الأضافات</span>
          </div>
          <div class="tools"> </div>
        </div>
        <div class="portlet-body">
          <div class="table-toolbar">
            <div class="row">
              <div class="col-md-6">
                <div class="btn-group">
                  <button  data-toggle="modal" data-target="#addModal" id="sample_editable_1_new" class="btn btn-primary">
                    أضافة جديد
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-striped table-bordered table-hover table-header-fixed" id="mealAdditions">
            <thead>
            <th class="col-md-1"> الترتيب</th>
            <th class="col-md-1"> الوجبة</th>
            <th class="col-md-1">الأضافه</th>
            <th class="col-md-1">السعر</th>
            <th class="col-md-1">خيارات</th>
            </thead>
            <tbody class="row_position">
            @foreach ($tableData->getData()->data as $row)
              <tr>
                <td>{{ $row->sort }}</td>
                <td>{{ $row->meal }}</td>
                <td>{{ $row->addition }}</td>
                <td>{{ $row->price }}</td>
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

  </div>
  </div>
  </div>

      @include('admin_layouts.Add_Modal')
      @include('admin_layouts.Edit_Modal')

@endsection

@section('scripts')
  <script type="text/javascript">

    $( ".row_position" ).sortable({
      delay: 50,
      stop: function() {
        var selectedData = new Array();
        $('.row_position tr').each(function() {
          selectedData.push($(this).attr("id"));
        });
        updateOrder(selectedData);

      }

    });

    function updateOrder(data) {
      $.ajax({
        url: "{{ url('meal-additions/sort') }}",
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: Object.assign({}, data),
        success: function(res){
          oTable.draw();
        },
        error: function(){}
      });
    }

  </script>
  <script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/insert.js')}}" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      oTable = $('#mealAdditions').DataTable({
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
          {data: 'sort', name: 'sort'},
          {data: 'meal', name: 'meal'},
          {data: 'addition', name: 'addition'},
          {data: 'price', name: 'price'},
          {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ]
      });
    });
  </script>
  <script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
@endsection
