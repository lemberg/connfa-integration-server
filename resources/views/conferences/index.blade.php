@extends('layouts.conference')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Conferences list') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="conferences-table">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">id</th>
                                <th class="column-title">{{ trans('Name') }}</th>
                                <th class="column-title">{{ trans('Alias') }}</th>
                                <th class="column-title no-link last"><span class="nobr">{{ trans('Action') }}</span></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#conferences-table').DataTable({
            stateSave: true,
            serverSide: true,
            ajax: '{!! route('conferences.data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'alias', name: 'alias'},
                {data: 'actions', name: 'actions', targets: 'no-sort', 'searchable': false, orderable: false, className: 'text-right'}
            ]
        });
    });
</script>
@endpush
