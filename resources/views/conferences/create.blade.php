@extends('layouts.conference')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('conference_breadcrumbs', [['label'=> trans('Create conference'), 'route' => 'conferences.index']]) !!}
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Create conference') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    {!! Form::open(['route' => ['conferences.store'], 'method' => 'POST', 'class' => 'form-horizontal form-label-left conference-form']) !!}
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
                    <div class="form-group{{ $errors->has('alias') ? ' has-error' : '' }}">
                        {{ Form::label('alias', trans('Alias')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::text('alias', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
                            @if ($errors->has('alias'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('alias') }}</strong>
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

