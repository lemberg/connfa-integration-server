@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render(
                    'breadcrumbs',
                    [['label'=> trans('Settings'), 'route' => 'settings.index'], ['label'=> trans('Edit settings'), 'route' => 'settings.index']]
                ) !!}
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Settings') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {!! Form::open(['route' => ['settings.update'], 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) !!}
                        <div class="form-group{{ $errors->has('titleMajor') ? ' has-error' : '' }}">
                            {{ Form::label('titleMajor', trans('Title major'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('titleMajor', $data['titleMajor'], ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('titleMajor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('titleMajor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('titleMinor') ? ' has-error' : '' }}">
                            {{ Form::label('titleMinor', trans('Title minor'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('titleMinor', $data['titleMinor'], ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('titleMinor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('titleMinor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('twitterSearchQuery') ? ' has-error' : '' }}">
                            {{ Form::label('twitterSearchQuery', trans('Twitter search query')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('twitterSearchQuery', $data['twitterSearchQuery'], ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('twitterSearchQuery'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('twitterSearchQuery') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if(!empty($timezoneList))
                            <div class="form-group{{ $errors->has('timezone') ? ' has-error' : '' }}">
                                {{ Form::label('timezone', trans('Timezone')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        {{ Form::select(
                                            'timezone',
                                            $timezoneList,
                                            $data['timezone'],
                                            ['class' => 'select2_single form-control col-md-7 col-xs-12']
                                        ) }}
                                    @if ($errors->has('timezone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('timezone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif
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

