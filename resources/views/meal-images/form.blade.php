<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">رقم الوجبه</label>
    <input type="number" readonly name="meal_id" value="{{ $id }}" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
<div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-primary btn-file"><span class="fileupload-new">صور القسم</span>
    <span class="fileupload-exists">تغير</span>
    <input type="file" name="images[]" multiple/></span>
    <span class="fileupload-preview"></span>
    <a href="#" required class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
    <span class="help-block with-errors errorName"></span>
</div>
</div>

