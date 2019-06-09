<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">رقم الوجبه</label>
    <input type="number" readonly name="meal_id" value="{{ $id }}" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputFile">الأضافه</label>
    <select required  class="form-control" name="addition_id">
        <option selected value="">أختر الأضافه </option>
        @foreach($additions as $addition)
            <option value="{!! $addition->id !!}">{!! $addition->name !!}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <label for="exampleInputPassword1">السعر</label>
    <input type="number" name="price" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>