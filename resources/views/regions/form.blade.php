<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputFile"> المدينه</label>
    <select required  class="form-control" name="country_id">
        <option selected value="">أختر المدينه </option>
        @foreach($countries as $country)
            <option value="{!! $country->id !!}">{!! $country->name !!}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">الحي</label>
    <input type="text" name="name" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
<input type="checkbox" name="is_transporting" checked > توصيل<br>
</div>









