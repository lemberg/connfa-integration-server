@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', [['label'=> trans('Settings'), 'route' => 'settings.index'], ['label'=> trans('Edit settings'), 'route' => 'settings.index']]) !!}
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Settings') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {!! Form::open(['route' => ['settings.update'], 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) !!}
                    @if($data)
                        @foreach($data as $key => $value)
                            <div class="form-group">
                                {{ Form::label($value->key, trans(ucfirst(strtolower(implode(' ', preg_split('/(?=[A-Z])/', $value->key))))), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text($value->key, $value->value, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                </div>
                            </div>
                        @endforeach
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

