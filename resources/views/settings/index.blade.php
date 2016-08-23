@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', ['label'=> trans('Settings'), 'route' => 'settings.index']) !!}
            </div>
            <a href="{{ route('settings.edit') }}" class="btn btn-info pull-right"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Settings') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>
                        <strong>{{ trans('Title major') }}:</strong> {{ array_get($data, 'titleMajor') }}
                    </p>
                    <p>
                        <strong>{{ trans('Title minor') }}:</strong> {{ array_get($data, 'titleMinor') }}
                    </p>
                    <p>
                        <strong>{{ trans('Twitter search query') }}:</strong> {{ array_get($data, 'twitterSearchQuery') }}
                    </p>
                    <p>
                        <strong>{{ trans('Twitter widget id') }}:</strong> {{ array_get($data, 'twitterWidgetId') }}
                    </p>
                    <p>
                        <strong>{{ trans('Timezone') }}:</strong> {{ array_get($data, 'timezone') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

