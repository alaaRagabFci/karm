@extends('admin_layouts.inc')
@section('title','عناوين المستخدم')
@section('breadcrumb','عناوين المستخدم')
@section('styles')
<style type="text/css">
.pac-container {
    z-index: 9999999999 !important;
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
          <span class="caption-subject bold uppercase">بيانات عناوين المستخدم</span>
        </div>
        <div class="tools"> </div>
      </div>
      <div class="portlet-body">
        <div class="table-toolbar">
          <div class="row">
            <div class="col-md-6">
              <div class="btn-group">
                <button  data-toggle="modal" data-target="#addModal" id="sample_editable_1_new" class="btn btn-primary">
                  أضافة عنوان
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
              <table class="table table-striped table-bordered table-hover" id="descriptions">
                <thead>
                  <th class="col-md-1">الحي</th>
                  <th class="col-md-1">خط الطول</th>
                  <th class="col-md-1">خط العرض</th>
                  <th class="col-md-1">الشارع</th>
                  <th class="col-md-1">الوصف</th>
                  <th class="col-md-1">خيارات</th>
                </thead>
                <tbody>
                  @foreach ($tableData->getData()->data as $row)
                  <tr>
                    <td>{{  $row->region }}</td>
                    <td>{{  $row->latitude}}</td>
                    <td>{{  $row->longitude}}</td>
                    <td>{{  $row->street}}</td>
                    <td>{{  $row->description}}</td>
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
      <!-- @include('admin_layouts.Edit_Modal') -->

      @endsection

      @section('scripts')
        <script src="{{ asset('/admin_ui/assets/layouts/layout4/scripts/insert.js')}}" type="text/javascript"></script>
              <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBxD7m7Qqn0jrQuZNpIZxC37uqK2iPeeRU"></script>
        <script src="{{asset('admin_ui/jquery.geocomplete.js')}}"></script>
        <script type="text/javascript">
            $(function () {

                $("#geocomplete").geocomplete({
                    map: ".map_canvas",
                    details: "#formy ul",
                    detailsAttribute: "data-geo"
                });

                $("#geocomplete").geocomplete().bind("geocode:result", function (event, result) {
                    $("#lat").val(result.geometry.location.lat());
                    $("#long").val(result.geometry.location.lng());
                    //console.log(result);
                });
                $("#find").click(function () {
                    load_map();
                });

                function load_map() {
                    var latLng = $("#geocomplete").trigger("geocode");
                    $("#geocomplete").geocomplete().bind("geocode:result", function (event, result) {
                        $("#lat").val(result.geometry.location.lat());
                        $("#long").val(result.geometry.location.lng());
                    });
                }

                //load map when loading page
                load_map();

                var map = $('map-canvas');
                google.maps.event.addListener(map, 'click', function (event) {
                    placeMarker(event.latLng);
                });

                function placeMarker(location) {
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                }
            });

       </script>
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
          {data: 'region', name: 'region'},
          {data: 'latitude', name: 'latitude'},
          {data: 'longitude', name: 'longitude'},
          {data: 'street', name: 'street'},
            {data: 'description', name: 'description'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false}
          ]
        })
      });
    </script>
      <script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
    @endsection
