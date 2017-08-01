@extends('backend.layouts.app')

@section ('title', trans('labels.backend.banner.management') )

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>{{ trans('labels.backend.banner.management') }}</h1>
@endsection

@section('content')
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('labels.backend.banner.management') }}</h3>
        <div class="box-tools pull-right">
            @include('backend.banner.includes.partials.banner-header-buttons')
        </div><!-- /.box tools -->
    </div><!-- /.box-header -->


    <div class="box-body">
            <div class="table-responsive">
                <table id="banners-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.banner.table.banner_name') }}</th>
                            <th>{{ trans('labels.backend.banner.table.image') }}</th>
                            <th>{{ trans('labels.backend.banner.table.url') }}</th>
                            <th>{{ trans('labels.backend.banner.table.order_number') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}

    <script>
        $(function() {
            $('#banners-table').DataTable({
                dom: 'lfrtip',
                processing: false,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route("admin.banner.get") }}',
                    type: 'post',
                    error: function (xhr, err) {
                        if (err === 'parsererror')
                            location.reload();
                    }
                },
                columns: [
                    {data: 'name', name: '{{config('backend.banners_table')}}.name', sortable: true, searchable: true},
                    {data: 'image', name: '{{config('backend.banners_table')}}.image', sortable: true, searchable: false},
                    {data: 'url', name: '{{config('backend.banners_table')}}.url', sortable: true, searchable: true},
                    {data: 'order_number', name: '{{config('backend.banners_table')}}.order_number', sortable: true, searchable: true},
                    {data: 'sort', name: '{{config('backend.banners_table')}}.name'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[1, "asc"]]
            });
        });
    </script>
@endsection