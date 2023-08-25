@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.transaction.order_title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Production">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                ID
                            </th>
                            <th style="width:115px;">
                                Created Date
                            </th>
                            <th style="width:200px;">
                                {{ trans('cruds.transaction.fields.hospital') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.ofm') }}
                            </th>
                            <th style="width:120px;">
                                {{ trans('cruds.transaction.fields.rx_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.patient') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.asset') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.asset_product') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.activity_mci') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.particular') }}
                            </th>
                            <th style="width:130px;">
                                {{ trans('cruds.transaction.fields.calibration_date') }}
                            </th>
                            <th style="width:60px;">
                                {{ trans('cruds.transaction.fields.run_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.remarks') }}
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productions as $key => $production)
                            <tr data-entry-id="{{ $production->id }}">
                                <td>
                                    {{ $production->id }}
                                </td>
                                <td>
                                    {{ $production->created_at }}
                                </td>
                                <td>
                                    {{-- @can('production_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.productions.hospitalFunction', $production->hospital_id) }}">
                                            {{ $production->hospital->hospital ?? '' }}
                                        </a>
                                    @endcan --}}
                                    {{ $production->hospital->hospital ?? '' }}
                                </td>
                                <td>
                                    {{ $production->orderform_no ?? '' }}
                                </td>
                                <td>
                                    {{ $production->rx_no ?? '' }}
                                </td>
                                <td>
                                    {{ $production->patient ?? '' }}
                                </td>
                                <td>
                                    {{ $production->asset->name ?? '' }}
                                </td>
                                <td>
                                    {{ $production->asset_product->product_name ?? '' }}
                                </td>
                                <td>
                                    {{ $production->activity_mci ?? '' }}
                                </td>
                                <td>
                                    {{ $production->activity_mci ?? '' }} mCi
                                    {{ $production->asset_product->product_name ?? '' }}
                                </td>
                                <td>
                                    @php
                                        $calibrationDateTime = $production->calibration_date . ' ' . $production->calibration_time;
                                        $currentDateTime = now();
                                    @endphp
                                    <div
                                        style="
                                            display: flex;
                                            align-items: center;">
                                        {{ $calibrationDateTime }}
                                        @if ($calibrationDateTime < $currentDateTime)
                                            <img src="{{ asset('img/red-warning.png') }}" style="width:30px;height:30px;"
                                                alt="Image">
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    {{ $production->runNumber->run_name ?? '' }}
                                </td>
                                <td>
                                    {{ $production->created_by ?? '' }}
                                </td>
                                <td>
                                    {{ $production->remarks ?? '' }}
                                </td>
                                <td>
                                    @can('production_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.productions.edit', $production->id) }}">
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
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('team_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.transactions.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan
            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [0, 'asc']
                ],
                pageLength: 100,
                columnDefs: [{
                    orderable: true,
                    className: '',
                    targets: 0
                }]
            });
            $('.datatable-Production:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    // setTimeout(function() {
    //     location.reload();
    // }, 10000); // 5000 milliseconds = 5 seconds
</script>
@endsection
