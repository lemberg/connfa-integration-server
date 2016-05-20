@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        {!! Form::open(array('url' => '/levels/'.$data->id, 'method' => 'delete', 'class' => 'pull-right')) !!}
        <button type="submit" class="btn btn-danger "><i class='fa fa-trash-o'></i> Delete</button>
        {!! Form::close() !!}
        <a href="{{ url('/levels/'.$data->id.'/edit') }}" class="btn btn-info pull-right"><i class="fa fa-pencil"></i> Edit</a>

        <div class="x_panel">
            <div class="x_title">
                <h2>Level</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <p>
                    <strong>Name:</strong> {{ $data->name }} <br>
                </p>
                <p>
                    <strong>Order:</strong> {{ $data->order }} <br>
                </p>
            </div>
        </div>
    </div>
@endsection
