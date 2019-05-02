<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">الكود</label>
    <input type="text" name="code" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">القيمه</label>
    <input type="number" name="value" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputFile">النوع</label>
    <select  class="form-control" name="type" id="type" onchange="selectType()">
        <option>أختر النوع</option>
        <option value="Expiration">تاريخ صلاحية</option>
        <option value="Number">مرات استخدام</option>
    </select>
</div>

<div id="number" class="form-group">
    <label for="exampleInputPassword1">مرات الأستخدام</label>
    <input type="number" disabled id="trips_limit" name="trips_limit" class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div id="expiration" class="form-group">
    <label for="exampleInputPassword1">تاريخ صلاحية</label>
    <input type="date" disabled id="expiration_date" name="expiration_date" class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">الوصف</label>
    <textarea rows="2" cols="30" name="description" class="form-control" required></textarea>
</div>

<div class="form-group">
    <label for="exampleInputFile">الحالة</label>
    <select  class="form-control" name="is_active">
        <option value="1">نشط</option>
        <option value="0">غير نشط</option>
    </select>
</div>









