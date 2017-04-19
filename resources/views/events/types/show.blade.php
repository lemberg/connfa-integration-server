@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', [['label'=> trans('Types'), 'route' => 'types.index', 'params' => ['conference_alias' => $conference->alias]], ['label'=> trans('Type'), 'route' => 'types.index', 'params' => ['conference_alias' => $conference->alias]]]) !!}
            </div>
            {!! Form::open([route('types.destroy', ['id' => $data->id, 'conference_alias' => $conference->alias]), 'method' => 'POST', 'class' => 'pull-right']) !!}
                {{ method_field('DELETE') }}
                {{ Form::button("<i class='fa fa-trash-o'></i> Delete", ['onclick' => 'deleteItem(this)', 'class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
            <a href="{{ route('types.edit', ['id' => $data->id, 'conference_alias' => $conference->alias]) }}" class="btn btn-info pull-right"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Type') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>
                        <strong>{{ trans('Name') }}:</strong> {{ $data->name }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Order') }}:</strong> {{ $data->order }}<br>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
