@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        {{ Html::link(route('speakers.create'), trans('Create speaker'), ['class' => 'btn btn-primary pull-right']) }}

        <div class="x_panel">
            <div class="x_title">
                <h2>{{ trans('Speakers') }}</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">#</th>
                                <th class="column-title">{{ trans('Avatar') }}</th>
                                <th class="column-title">{{ trans('Name') }}</th>
                                <th class="column-title">{{ trans('Email') }}</th>
                                <th class="column-title no-link last"><span class="nobr">{{ trans('Action') }}</span></th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    @if(!empty($item->avatar2))
                                        {{ Html::image($item->avatar, $item->first_name . ' ' . $item->last_name, array('class' => 'avatar img-responsive')) }}
                                    @endif
                                </td>
                                <td>
                                    {{ $item->first_name }} {{ $item->last_name }}
                                </td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('speakers.show', ['id' => $item->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> {{ trans('View') }}</a>
                                    <a href="{{ route('speakers.edit', ['id' => $item->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>
                                    {!! Form::open(['url' => route('speakers.destroy', ['id' => $item->id]), 'method' => 'POST', 'style' => 'vertical-align: middle; display: inline-block;']) !!}
                                        {{ method_field('DELETE') }}
                                        {{ Form::button("<i class='fa fa-trash-o'></i> ".trans('Delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs']) }}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pull-right">
                {!! $data->links() !!}
            </div>
        </div>
    </div>
@endsection
