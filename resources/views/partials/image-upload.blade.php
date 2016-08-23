@if(!$create and empty(old($fieldName . '_delete')))
    <div class="{{ $fieldName }}-block" style="{{ !empty($fieldNameValue) ? 'display:block;':'display:none;' }}">
        <div class="form-group">
            {{ Form::label('icon-label', $labelName, ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div style="display: inline-block; position: relative;">
                    {{ Html::image($fieldNameValue, '', ['class' => 'img-thumbnail img-responsive']) }}
                    <button class="btn btn-link btn-{{ $fieldName }}-delete" data-field="{{ $fieldName }}" style="padding: 0; position: absolute; top: 0px; right: 0px;"><i class="fa fa-times" style="font-size: 24px;"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="{{ $fieldName }}-upload-block" style="{{ empty($fieldNameValue) ? 'display:block;':'display:none;' }}">
@endif
{{ Form::hidden($fieldName, $fieldNameValue) }}
{{ Form::hidden($fieldName . '_delete', old($fieldName . '_delete')) }}
<div class="form-group">
    {{ Form::label('label-switch', $labelName, ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {{ Form::radio($fieldName . '-switch', $fieldName . '_url', true, ['class' => 'flat', 'id' => $fieldName . '-switch-url']) }} {{ trans('Image url') }}<br>
        {{ Form::radio($fieldName . '-switch', $fieldName . '_file', false, ['class' => 'flat', 'id' => $fieldName . '-switch-file']) }} {{ trans('Image file') }}
    </div>
</div>
<div class="form-group{{ $errors->has($fieldName . '_url') ? ' has-error' : '' }} form-group-{{ $fieldName }}-url">
    {{ Form::label($fieldName . '_url', trans('Image url') . ($required ? ' *' : ''), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {{ Form::url($fieldName . '_url', $fieldNameValue, ['class' => 'form-control col-md-7 col-xs-12']) }}
        @if ($errors->has($fieldName . '_url'))
            <span class="help-block">
                <strong>{{ $errors->first($fieldName . '_url') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has($fieldName . '_file') ? ' has-error' : '' }} form-group-{{ $fieldName }}-file">
    {{ Form::label($fieldName . '_file', trans('Image file') . ($required ? ' *' : ''), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {{ Form::file($fieldName . '_file', ['accept' => 'image/*', 'class' => 'form-control col-md-7 col-xs-12']) }}
        <span class="help-block">
            <?php
            if(ini_get('post_max_size') > ini_get('upload_max_filesize')){
                $size = ini_get('upload_max_filesize');
            }else{
                $size = ini_get('post_max_size');
            }
            ?>
            <span>File size should be less than {{ $size }}. Available extensions: jpg, jpeg, bmp, png, gif.</span>
        </span>
        @if ($errors->has($fieldName . '_file'))
            <span class="help-block">
                <strong>{{ $errors->first($fieldName . '_file') }}</strong>
            </span>
        @endif
    </div>
</div>
@if(!$create and empty(old($fieldName . '_delete')))
    </div>
@endif

