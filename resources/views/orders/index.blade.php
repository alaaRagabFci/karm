@extends('admin_layouts.inc')
@section('title','الطلبات')
@section('breadcrumb','الطلبات')
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
          <span class="caption-subject bold uppercase">بيانات الطلبات</span>
        </div>
        <div class="tools"> </div>
      </div>
      <div class="portlet-body">
              <table class="table table-striped table-bordered table-hover" id="descriptions">
                <thead>
                  <th class="col-md-1">رقم الطلب</th>
                  <th class="col-md-1">العضو</th>
                  <th class="col-md-1">الموصل</th>
                  <th class="col-md-1">الكاشير</th>
                  <th class="col-md-1">ألية استلام الطلب</th>
                  <th class="col-md-1">المبلغ</th>
                  <th class="col-md-1">الحاله</th>
                  <th class="col-md-1">خيارات</th>
                </thead>
                <tbody>
                  @foreach ($tableData->getData()->data as $row)
                  <tr>
                    <td>{{  $row->id }}</td>
                    <td>{{  $row->user }}</td>
                    <td>{{  $row->driver }}</td>
                    <td>{{  $row->cashair }}</td>
                    <td>{{  $row->receivingType }}</td>
                    <td>{{  $row->amount }}</td>
                    <td>{{  $row->status }}</td>
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

<div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> تفاصيل الطلب</h4>
      </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <!-- BEGIN EXAMPLE TABLE PORTLET-->
              <div class="portlet light bordered">
                <div class="portlet-body">
                  <table class="table table-striped table-bordered table-hover" id="details">
                    <thead>
                    <th class="col-md-1">الوجبه</th>
                    <th class="col-md-1">الكميه</th>
                    </thead>
                    <tbody id="orderDetails"></tbody>
                  </table>
                </div>
              </div>
              <!-- END EXAMPLE TABLE PORTLET-->
            </div>
          </div>
        </div>
    </div>
  </div>
</div>


      @endsection

      @section('scripts')
      <script type="text/javascript">
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
          {data: 'user', name: 'user'},
          {data: 'driver', name: 'driver'},
          {data: 'cashair', name: 'cashair'},
          {data: 'receivingType', name: 'receivingType'},
          {data: 'amount', name: 'amount'},
          {data: 'status', name: 'status'},
          {data: 'actions', name: 'actions', orderable: false, searchable: false}
          ],
          order: [ [0, 'desc'] ]
        });

         $(document.body).validator().on('click', '.order-details', function() {
           var self = $(this);
           self.button('loading');
           $.ajax({
             url: "order-details/" + self.data('id') ,
             type: "GET",
             success: function(res){
               self.button('reset');
               $('#orderDetails').html(res);
               $('#details').DataTable({ retrieve: true, order: [ [0, 'desc'] ], language: {
                   "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json"
                 }});
               $('#orderDetailsModal').modal('show');
             },
             error: function(){
               self.button('reset');
             }
           });
         });
      });
    </script>
      <script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
    @endsection
