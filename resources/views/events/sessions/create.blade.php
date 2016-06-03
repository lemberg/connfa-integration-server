@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', [['label'=> trans('Session events'), 'route' => 'sessions.index'], ['label'=> trans('Create Session event'), 'route' => 'sessions.index']]) !!}
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Create Session event') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {!! Form::open(['route' => ['sessions.store'], 'method' => 'POST', 'class' => 'form-horizontal form-label-left']) !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('name', trans('Name')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('name', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('start_at') ? ' has-error' : '' }} has-feedback">
                            {{ Form::label('start_at', trans('Start at')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('start_at', '', ['class' => 'form-control col-md-7 col-xs-12 has-feedback-left']) }}
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                @if ($errors->has('start_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('end_at') ? ' has-error' : '' }} has-feedback">
                            {{ Form::label('end_at', trans('End at')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('end_at', '', ['class' => 'form-control col-md-7 col-xs-12  has-feedback-left']) }}
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                @if ($errors->has('end_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('speakers') ? ' has-error' : '' }}">
                            {{ Form::label('speakers', trans('Speakers'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::select('speakers', $speakers, [], ['class' => 'form-control col-md-7 col-xs-12 select2_multiple', 'multiple' => 'multiple', 'name' => 'speakers[]']) }}
                                @if ($errors->has('speakers'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('speakers') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
                            {{ Form::label('place', trans('Place'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('place', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('place'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('place') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('version') ? ' has-error' : '' }}">
                            {{ Form::label('version', trans('Version'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('version', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('version'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('version') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            {{ Form::label('url', trans('Url'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::url('url', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('url') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('level_id') ? ' has-error' : '' }}">
                            {{ Form::label('level_id', trans('Level'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::select('level_id', ['NULL' => 'Select the option'] + $levels, 'NULL', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('level_id'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('level_id') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                            {{ Form::label('type_id', trans('Type'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::select('type_id', ['NULL' => 'Select the option'] + $types, 'NULL', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('type_id'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('type_id') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('track_id') ? ' has-error' : '' }}">
                            {{ Form::label('track_id', trans('Track'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::select('track_id', ['NULL' => 'Select the option'] + $tracks, 'NULL', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('track_id'))
                                    <span class="help-block">
                                                    <strong>{{ $errors->first('track_id') }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                            {{ Form::label('order', trans('Order'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('order', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('order'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                            {{ Form::label('editor', trans('Text'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::textarea('text', '', ['id' => 'editor', 'class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('text'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('text') }}</strong>
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
