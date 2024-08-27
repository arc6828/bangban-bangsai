<div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
    <label for="url" class="control-label">{{ 'Url' }}</label>
    <input class="form-control" name="url" type="file" id="url" value="{{ isset($stationimage->url) ? $stationimage->url : ''}}" >
    {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('owner') ? 'has-error' : ''}}">
    <label for="owner" class="control-label">{{ 'Owner' }}</label>
    <input class="form-control" name="owner" type="text" id="owner" value="{{ isset($stationimage->owner) ? $stationimage->owner : ''}}" >
    {!! $errors->first('owner', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('station_code') ? 'has-error' : ''}}">
    <label for="station_code" class="control-label">{{ 'Station Code' }}</label>
    <input class="form-control" name="station_code" type="text" id="station_code" value="{{ isset($stationimage->station_code) ? $stationimage->station_code : ''}}" >
    {!! $errors->first('station_code', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
