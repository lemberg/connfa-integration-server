@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', ['label'=> trans('Location'), 'route' => 'location.index', 'params' => ['conference_alias' => $conference->alias]]) !!}
            </div>
            <a href="{{ route('location.edit', ['conference_alias' => $conference->alias]) }}" class="btn btn-info pull-right"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Location') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>
                        <strong>{{ trans('Name') }}:</strong> {{ $data->name }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Address') }}:</strong> {{ $data->address }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Latitude') }}:</strong> {{ $data->lat }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Longitude') }}:</strong> {{ $data->lon }}<br>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
