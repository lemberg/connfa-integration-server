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
                    @if($data)
                        @foreach($data as $key => $value)
                            <p>
                                <strong>{{ trans(ucfirst(strtolower(implode(' ', preg_split('/(?=[A-Z])/', $value->key))))) }}:</strong>
                                {{ $value->value }}<br>
                            </p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

