<input type="hidden" name="_token" value="{{ csrf_token() }}">

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
    <label for="exampleInputPassword1">الأضافة</label>
    <input type="text" name="name" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>


<div class="form-group">
    <label for="exampleInputPassword1">السعر</label>
    <input type="number" name="price" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>