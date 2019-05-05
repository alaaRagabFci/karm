<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="exampleInputPassword1">رقم العضو</label>
    <input type="number" readonly name="the_user_id" value="{{ $id }}" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputFile"> الحي</label>
    <select required  class="form-control" name="region_id">
        <option selected value="">أختر الحي </option>
        @foreach($regions as $region)
            <option value="{!! $region->id !!}">{!! $region->name !!}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">الشارع</label>
    <input type="text" name="street" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">الوصف</label>
    <textarea rows="2" cols="30" name="description" class="form-control" required></textarea>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">خط الطول</label>
    <input type="text" readonly name="latitude" id="lat" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">خط العرض</label>
    <input type="text" readonly name="longitude" id="long" required class="form-control">
    <span class="help-block with-errors errorName"></span>
</div>

<div class="form-group">
    <label>الموقع</label>
    <div>
        <input id="geocomplete" type="text" class="form-control" placeholder="Type in an address" value="Al-Riyad Saudia" />
    </div>
</div>

<div>
    <div class="map_canvas col-md-offset-2 col-md-10" style="height:400px;margin: 0;width: 100%;"></div>
    <br><br><br><br>
</div>










