@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Create speaker') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {!! Form::open(['route' => ['speakers.store'], 'files' => true, 'method' => 'POST', 'class' => 'form-horizontal form-label-left']) !!}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            {{ Form::label('first_name', trans('First Name')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('first_name', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
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
                                {{ Form::text('last_name', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
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
                                {{ Form::email('email', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
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
                                {{ Form::text('job', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
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
                                {{ Form::text('organization', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
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
                                {{ Form::text('twitter_name', '', ['class' => 'form-control col-md-7 col-xs-12 has-feedback-left']) }}
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
                                {{ Form::text('website', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('website'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('website') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        @include('partials/image-upload', [
                            'create' => true,
                            'labelName' => trans('Avatar'),
                            'fieldName' => 'avatar',
                            'fieldNameValue' => '',
                            'required' => false,
                        ])

                        <div class="form-group{{ $errors->has('characteristic') ? ' has-error' : '' }}">
                            {{ Form::label('characteristic', trans('Characteristic'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::textarea('characteristic', '', ['id' => 'editor-speaker', 'class' => 'form-control col-md-7 col-xs-12']) }}
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
                                {{ Form::submit(trans('Create'), ['class' => 'btn btn-success']) }}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
