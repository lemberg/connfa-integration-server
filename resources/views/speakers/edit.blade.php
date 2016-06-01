@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', [['label'=> trans('Speaker'), 'route' => 'speakers.index'], ['label'=> trans('Edit speaker'), 'route' => 'speakers.index']]) !!}
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Edit speaker') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {!! Form::open(['route' => ['speakers.update', 'id' => $data->id], 'files' => true, 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) !!}
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            {{ Form::label('first_name', trans('First Name')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('first_name', $data->first_name, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            {{ Form::label('last_name', trans('Last Name')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('last_name', $data->last_name, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', trans('Email'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::email('email', $data->email, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('job') ? ' has-error' : '' }}">
                            {{ Form::label('job', trans('Job'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('job', $data->job, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('job'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('organization') ? ' has-error' : '' }}">
                            {{ Form::label('organization', trans('Organization'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('organization', $data->organization, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('organization'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('twitter_name') ? ' has-error' : '' }} has-feedback">
                            {{ Form::label('twitter_name', trans('Twitter name'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('twitter_name', $data->twitter_name_without_at, ['class' => 'form-control col-md-7 col-xs-12 has-feedback-left']) }}
                                <span class="fa fa-at form-control-feedback left" aria-hidden="true"></span>
                                @if ($errors->has('twitter_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('twitter_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                            {{ Form::label('website', trans('Website'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('website', $data->website, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="image-block" style="{{ !empty($data->avatar) ? 'display:block;':'display:none;' }}">
                            <div class="form-group">
                                {{ Form::label('icon-label', trans('Avatar'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div style="display: inline-block; position: relative;">
                                        {{ Html::image($data->avatar, $data->first_name. ' '. $data->last_name, array('class' => 'img-thumbnail img-responsive')) }}
                                        <button class="btn btn-link" id="type-icon-delete"
                                                data-url="{{ url('speakers/'.$data->id.'/avatar') }}"
                                                data-token="{{ csrf_token() }}"
                                                style="padding: 0; position: absolute; top: 0px; right: 0px;"><i
                                                    class="fa fa-times" style="font-size: 24px;"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="upload-image-block"
                             style="{{ empty($data->avatar) ? 'display:block;':'display:none;' }}">
                            <div class="form-group">
                                {{ Form::label('icon-label', trans('Avatar'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::radio('icon-switch', 'url', true, ['class' => 'flat', 'id' => 'icon-switch-text']) }} {{ trans('Url') }}
                                    <br>
                                    {{ Form::radio('icon-switch', 'file', false, ['class' => 'flat', 'id' => 'icon-switch-file']) }} {{ trans('Image upload') }}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }} form-group-icon-text">
                                {{ Form::label('icon-text', trans('Url'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::url('avatar', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                    @if ($errors->has('avatar'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} form-group-icon-file">
                                {{ Form::label('image', trans('Image'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
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
                        <div class="form-group{{ $errors->has('characteristic') ? ' has-error' : '' }}">
                            {{ Form::label('characteristic', trans('Characteristic'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::textarea('characteristic', $data->characteristic, ['id' => 'editor-speaker', 'class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('characteristic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('characteristic') }}</strong>
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

