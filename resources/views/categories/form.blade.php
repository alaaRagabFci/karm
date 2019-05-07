<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
<div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-primary btn-file"><span class="fileupload-new">صورة القسم</span>
    <span class="fileupload-exists">تغير</span>
    <input type="file" name="image" required/></span>
    <span class="fileupload-preview"></span>
    <a href="#" required class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
    <span class="help-block with-errors errorName"></span>
</div>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">أسم القسم</label>
    <input type="text" name="name" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputFile">الحالة</label>
    <select  class="form-control" name="is_active">
        <option value="1">نشط</option>
        <option value="0">غير نشط</option>
    </select>
</div>


{{--<div class="form-group">--}}
{{--<label class="switch">--}}
    {{--<input name="is_active" class="form-control" type="checkbox" checked>--}}
    {{--<span class="slider round"></span>--}}
{{--</label>--}}
{{--</div>--}}




