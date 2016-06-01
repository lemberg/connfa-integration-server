@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', [['label'=> trans('Floor plans'), 'route' => 'floors.index'], ['label'=> trans('Floor plan'), 'route' => 'floors.index']]) !!}
            </div>
            {!! Form::open([route('floors.destroy', ['id' => $data->id]), 'method' => 'POST', 'class' => 'pull-right']) !!}
                {{ method_field('DELETE') }}
                {{ Form::button("<i class='fa fa-trash-o'></i> Delete", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
            <a href="{{ route('floors.edit', ['id' => $data->id ]) }}" class="btn btn-info pull-right"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>

            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Floor plans') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>
                        <strong>{{ trans('Name') }}:</strong> {{ $data->name }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Order') }}:</strong> {{ $data->order }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Image') }}:</strong><br>
                        @if(!empty($data->image))
                            {{ Html::image($data->image, $data->name, array('class' => 'img-thumbnail img-responsive')) }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
