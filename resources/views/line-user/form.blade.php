<div class="form-group {{ $errors->has('userId') ? 'has-error' : ''}}">
    <label for="userId" class="control-label">{{ 'Userid' }}</label>
    <input class="form-control" name="userId" type="text" id="userId" value="{{ isset($lineuser->userId) ? $lineuser->userId : ''}}" >
    {!! $errors->first('userId', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('displayName') ? 'has-error' : ''}}">
    <label for="displayName" class="control-label">{{ 'Displayname' }}</label>
    <input class="form-control" name="displayName" type="text" id="displayName" value="{{ isset($lineuser->displayName) ? $lineuser->displayName : ''}}" >
    {!! $errors->first('displayName', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('pictureUrl') ? 'has-error' : ''}}">
    <label for="pictureUrl" class="control-label">{{ 'Pictureurl' }}</label>
    <input class="form-control" name="pictureUrl" type="text" id="pictureUrl" value="{{ isset($lineuser->pictureUrl) ? $lineuser->pictureUrl : ''}}" >
    {!! $errors->first('pictureUrl', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('statusMessage') ? 'has-error' : ''}}">
    <label for="statusMessage" class="control-label">{{ 'Statusmessage' }}</label>
    <input class="form-control" name="statusMessage" type="text" id="statusMessage" value="{{ isset($lineuser->statusMessage) ? $lineuser->statusMessage : ''}}" >
    {!! $errors->first('statusMessage', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('language') ? 'has-error' : ''}}">
    <label for="language" class="control-label">{{ 'Language' }}</label>
    <input class="form-control" name="language" type="text" id="language" value="{{ isset($lineuser->language) ? $lineuser->language : ''}}" >
    {!! $errors->first('language', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
