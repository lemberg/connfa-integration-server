@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', [['label'=> trans('Points'), 'route' => 'points.index'], ['label'=> trans('Edit point'), 'route' => 'points.index']]) !!}
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Edit point') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {!! Form::open(['route' => ['points.update', 'id' => $data->id], 'files' => true, 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) !!}

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

                    <div class="form-group{{ $errors->has('details_url') ? ' has-error' : '' }}">
                        {{ Form::label('details_url', trans('Details url'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::url('details_url', $data->details_url, ['class' => 'form-control col-md-7 col-xs-12']) }}
                            @if ($errors->has('details_url'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('details_url') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="image-block" style="{{ !empty($data->image) ? 'display:block;':'display:none;' }}">
                        <div class="form-group">
                            {{ Form::label('icon-label', trans('Image'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div style="display: inline-block; position: relative;">
                                    {{ Html::image($data->image, $data->name, array('class' => 'img-thumbnail img-responsive')) }}
                                    <button class="btn btn-link" id="type-icon-delete"
                                            data-url="{{ url('points/'.$data->id.'/image') }}"
                                            data-token="{{ csrf_token() }}"
                                            style="padding: 0; position: absolute; top: 0px; right: 0px;"><i
                                                class="fa fa-times" style="font-size: 24px;"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="upload-image-block"
                         style="{{ empty($data->image) ? 'display:block;':'display:none;' }}">
                        <div class="form-group">
                            {{ Form::label('icon-label', trans('Image'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::radio('icon-switch', 'url', true, ['class' => 'flat', 'id' => 'icon-switch-text']) }} {{ trans('Url') }}
                                <br>
                                {{ Form::radio('icon-switch', 'file', false, ['class' => 'flat', 'id' => 'icon-switch-file']) }} {{ trans('Image upload') }}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} form-group-icon-text">
                            {{ Form::label('icon-text', trans('Image url'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::url('image', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }} form-group-icon-file">
                            {{ Form::label('file', trans('Image file'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::file('file', ['accept' => 'image/*', 'class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        {{ Form::label('description', trans('Description'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::textarea('description', $data->description, ['id' => 'editor-points', 'class' => 'form-control col-md-7 col-xs-12']) }}
                            @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
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
