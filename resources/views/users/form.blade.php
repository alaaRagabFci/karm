<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">أسم المستخدم</label>
    <input type="text" name="username" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>


<div class="form-group">
    <label for="exampleInputPassword1">رقم الهاتف</label>
    <input type="text" name="phone" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputFile">الحالة</label>
    <select  class="form-control" name="is_active">
        <option value="1">نشط</option>
        <option value="0">غير نشط</option>
    </select>
</div>

<div class="form-group">
    <label for="exampleInputFile">حظر المستخدم</label>
    <select  class="form-control" name="is_blocked">
        <option value="1">حظر</option>
        <option value="0">ألغاء الحظر</option>
    </select>
</div>