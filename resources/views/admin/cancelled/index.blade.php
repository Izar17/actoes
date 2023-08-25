@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>{{ trans('cruds.cancel.title_singular') }} {{ trans('global.list') }}</span>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable"
                    class="table table-bordered table-striped table-hover datatable datatable-Transaction">
                    <thead>
                        <tr>
                            <th style="width:100px;">
                                ID | Created Date
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
                            <th style="width:100px;">
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
                                {{ trans('cruds.transaction.fields.cancel') }}
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="transactionTableBody">
                        @foreach ($transactions as $key => $transaction)
                            <tr data-entry-id="{{ $transaction->id }}">
                                <td>
                                    {{ $transaction->id }} | {{ $transaction->created_at }}
                                </td>
                                <td>
                                    {{ $transaction->hospital->hospital ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->orderform_no ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->rx_no ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->asset->name ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->asset_product->product_name ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->activity_mci ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->activity_mci ?? '' }} mCi
                                    {{ $transaction->asset_product->product_name ?? '' }}
                                </td>
                                <td>
                                    @php
                                        $calibrationDateTime = $transaction->calibration_date . ' ' . $transaction->calibration_time;
                                        $currentDateTime = now();
                                    @endphp
                                    <div
                                        style="
                                    display: flex;
                                    align-items: center;">
                                        {{ $calibrationDateTime }}
                                        @if ($calibrationDateTime < $currentDateTime && $transaction->status == 1)
                                            <img src="{{ asset('img/red-warning.png') }}" style="width:30px;height:30px;"
                                                alt="Image">
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    {{ $transaction->runNumber->run_name ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->created_by ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->remarks ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->cancelled ?? '' }}
                                </td>
                                <td>

                                    @can('order_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.transactions.edit', $transaction->id) }}">
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
        function selectAll() {

            // Clear existing DataTable rows
            $('#dataTable').DataTable().clear().draw();
            var currentDateTime = new Date().toISOString();

            // Add all transactions to DataTable
            @foreach ($transactions as $transaction)

                $('#dataTable').DataTable().row.add([
                    "{{ $transaction->id }} {{ $transaction->created_at }}",
                    "{{ $transaction->hospital->hospital }}",
                    "{{ $transaction->asset_id }}",
                    "{{ $transaction->remarks }}",
                    "{{ $transaction->item }}",
                    "{{ $transaction->orderform_no }}",
                    "{{ $transaction->activity_mci }}",
                    "{{ $transaction->activity_mbq }}",
                    "{{ $transaction->discrepancy }}",
                    "{{ $transaction->unit }}",
                    "{{ $transaction->particular }}",
                    "{{ $transaction->patient }}",
                    "",
                    "{{ $transaction->lead_pot }}",
                    "{{ $transaction->max_doserate }}",
                ]).draw(false);
            @endforeach

            return;
        }

        //Onchange Asset
        $(document).ready(function() {
            $('#asset_id').on('change', function() {
                var idAsset = this.value;
                // Check if "Select All" option is chosen
                if (idAsset === "") {
                    location.reload();
                }
            });
        });

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
                    [0, 'desc']
                ],
                pageLength: 100,
                columnDefs: [{
                    orderable: true,
                    className: '',
                    targets: 0
                }]
            });
            $('.datatable-Transaction:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

        // setTimeout(function() {
        //     location.reload();
        // }, 5000); // 5000 milliseconds = 5 seconds
    </script>
@endsection
