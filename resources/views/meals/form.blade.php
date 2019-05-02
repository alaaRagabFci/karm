<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
<div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-primary btn-file"><span class="fileupload-new">صورة الوجبة</span>
    <span class="fileupload-exists">تغير</span>
    <input type="file" name="images[]" multiple/></span>
    <span class="fileupload-preview"></span>
    <a href="#" required class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
    <span class="help-block with-errors errorName"></span>
</div>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">أسم الوجبة</label>
    <input type="text" name="name" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputFile">القسم</label>
    <select required  class="form-control" name="category_id">
        <option selected value="">أختر القسم </option>
        @foreach($categories as $cat)
            <option value="{!! $cat->id !!}">{!! $cat->name !!}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="exampleInputFile">السعر</label>
    <input type="number" name="price" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputFile">السعر الحراري</label>
    <input type="number" name="calories" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">المحتوي</label>
    <textarea rows="2" cols="30" name="contents" class="form-control" required></textarea>
</div>

<div class="form-group">
    <label for="exampleInputFile">الحالة</label>
    <select  class="form-control" name="is_active">
        <option value="1">نشط</option>
        <option value="0">غير نشط</option>
    </select>
</div>


