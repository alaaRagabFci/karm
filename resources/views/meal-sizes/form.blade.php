<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">رقم الوجبه</label>
    <input type="number" readonly name="meal_id" value="{{ $id }}" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">الحجم</label>
    <input type="text" name="size" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">السعر</label>
    <input type="number" name="price" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>



