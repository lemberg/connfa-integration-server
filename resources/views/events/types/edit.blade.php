@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Edit type') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    {!! Form::open(['route' => ['types.update', 'id' => $data->id], 'files' => true, 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('name', trans('Name')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('name', $data->name, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                            {{ Form::label('order', trans('Order'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('order', $data->order, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('order'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('order') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="image-block" style="{{ !empty($data->icon) ? 'display:block;':'display:none;' }}">
                            <div class="form-group">
                                {{ Form::label('icon-label', trans('Icon'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div style="display: inline-block; position: relative;">
                                    {{ Html::image($data->icon, $data->name, array('class' => 'img-thumbnail img-responsive')) }}
                                    <button class="btn btn-link" id="type-icon-delete" data-url="{{ url('types/'.$data->id.'/icon') }}" data-token="{{ csrf_token() }}" style="padding: 0; position: absolute; top: 0px; right: 0px;"><i class="fa fa-times" style="font-size: 24px;"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="upload-image-block" style="{{ empty($data->icon) ? 'display:block;':'display:none;' }}">
                            <div class="form-group">
                                {{ Form::label('icon-label', trans('Url or icon'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::radio('icon-switch', 'url', true, ['class' => 'flat', 'id' => 'icon-switch-text']) }} {{ trans('Url') }}<br>
                                    {{ Form::radio('icon-switch', 'file', false, ['class' => 'flat', 'id' => 'icon-switch-file']) }} {{ trans('Image upload') }}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }} form-group-icon-text">
                                {{ Form::label('icon-text', trans('Url'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::url('icon', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                    @if ($errors->has('icon'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('icon') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} form-group-icon-file">
                                {{ Form::label('icon-file', trans('Icon'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::file('image', ['accept' => 'image/*', 'class' => 'form-control col-md-7 col-xs-12']) }}
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                {{ Form::submit(trans('Update'), ['class' => 'btn btn-success']) }}
                            </div>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
