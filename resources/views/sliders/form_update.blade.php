<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-primary btn-file"><span class="fileupload-new">العرض</span>
    <span class="fileupload-exists">تغير</span>
    <input type="file" name="image"/></span>
        <span class="fileupload-preview"></span>
        <a href="#" required class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
        <span class="help-block with-errors errorName"></span>
    </div>
</div>

<div class="form-group" style="display:none;">
    <label for="exampleInputFile">pic path</label>
    <input type="text" name="image" id="image" required>
</div>

<div class="form-group">
    <label for="exampleInputFile">الوجبة</label>
    <select required  class="form-control" name="meal_id">
        <option selected value="">أختر الوجبة </option>
        @foreach($meals as $meal)
            <option value="{!! $meal->id !!}">{!! $meal->name !!}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="exampleInputFile">الحالة</label>
    <select  class="form-control" name="is_active">
        <option value="1">نشط</option>
        <option value="0">غير نشط</option>
    </select>
</div>











