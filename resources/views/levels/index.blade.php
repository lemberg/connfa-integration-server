@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        {{ Html::link(url('/levels/create'), 'Create level', ['class' => 'btn btn-primary pull-right']) }}

        <div class="x_panel">
            <div class="x_title">
                <h2>Levels</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title"># </th>
                            <th class="column-title" style="width: 30%">Name </th>
                            <th class="column-title" style="width: 30%">Order </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($data as $user)
                            <tr>
                                <td>#</td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->order }}
                                </td>
                                <td class="text-right">
                                    <a href="{{ url('/levels/'.$user->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                    <a href="{{ url('/levels/'.$user->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    {!! Form::open(array('url' => '/levels/'.$user->id, 'method' => 'delete', 'style' => 'vertical-align: middle; display: inline-block;')) !!}
                                    <button type="submit" class="btn btn-danger btn-xs"><i class='fa fa-trash-o'></i> Delete</button>
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
