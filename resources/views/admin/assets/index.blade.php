@extends('layouts.admin')
@section('content')
    @can('isotope_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.assets.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.asset.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.asset.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.asset.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.asset.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.asset.fields.description') }}
                            </th>
                            {{-- <th>
                            Danger level
                        </th> --}}
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assets as $key => $asset)
                            <tr data-entry-id="{{ $asset->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $asset->id ?? '' }}
                                </td>
                                <td>
                                    {{ $asset->name ?? '' }}
                                </td>
                                <td>
                                    {{ $asset->description ?? '' }}
                                </td>
                                {{-- <td>
                                {{ $asset->danger_level }}
                            </td> --}}
                                <td>
                                    @can('isotope_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.assets.show', $asset->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('isotope_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.assets.edit', $asset->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            $('.datatable-Asset:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endsection
