@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>{{ trans('cruds.transaction.order_title_singular') }} {{ trans('global.list') }}</span>
            <div class="row">

                <table>
                    <tr>
                        <td>
                            <input class="clear-field form-control asset" style="width:400px;" type="search"
                                id="search_hospital" placeholder="Search by Hospital...">
                        </td>
                        <td>
                            <select class="clear-field form-control asset" id="asset_id" style="width:200px;">
                                <option value="" disabled selected>Select Isotope</option>
                                <option value="">Select All</option>
                                @foreach ($assets as $data)
                                    <option value="{{ $data->name }}">
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="clear-field form-control asset" id="run_no" style="width:200px;">
                                <option value="" disabled selected>Select Run #</option>
                                <option value="">Select All</option>
                                @foreach ($run_nos as $data)
                                    <option value="{{ $data->run_name }}">
                                        {{ $data->run_name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="clear-field form-control dateRangePicker" style="width:200px;"
                                id="dateRangePicker" placeholder="Select date range">
                        </td>
                        <td>
                            <button class="form-control clear" id="clearBtn">Clear</button>
                        </td>
                    </tr>
                </table>
            </div>
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
                            <th style="width:100px;">
                                {{ trans('cruds.transaction.fields.rx_number') }}
                            </th>
                            <th style="width:80px;">
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
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $key => $transaction)
                            <tr data-entry-id="{{ $transaction->id }}">
                                <td>
                                    {{ $transaction->id }} | {{ $transaction->created_at }}
                                </td>
                                <td>
                                    {{-- @can('order_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.transactions.show', $transaction->hospital_id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan --}}
                                    {{ $transaction->hospital->hospital ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->orderform_no ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->rx_no ?? '' }}
                                </td>
                                <td>
                                    {{ $transaction->patient ?? '' }}
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
                                    {{ $transaction->particular ?? '' }}
                                    {{ $transaction->asset_product->product_name ?? '' }}
                                </td>
                                <td>
                                    @php
                                        $calibrationDateTime = $transaction->calibration_date . ' ' . $transaction->calibration_time;
                                        $currentDateTime = now();
                                        $sixHoursBefore = now()->subHours(6);
                                    @endphp
                                    <div
                                        style="
                                    display: flex;
                                    align-items: center;">
                                        {{ $calibrationDateTime }}
                                        @if ($calibrationDateTime < $currentDateTime && $calibrationDateTime < $sixHoursBefore && $transaction->status == 1)
                                            <img src="{{ asset('img/yellow-warning.png') }}" style="width:30px;height:30px;" alt="Image">
                                        @elseif ($calibrationDateTime < $currentDateTime && $transaction->status == 1)
                                        <img src="{{ asset('img/red-warning.png') }}" style="width:30px;height:30px;"
                                            alt="Image">
                                    @else
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css">
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>


    <script>
        //Datatables
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                searching: true,
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

            $('#clearBtn').on('click', function() {
                $('.clear-field').val('');
                $('#dateRangePicker').val('');
                table.search('').columns().search('').draw();
            });

            $('#search_hospital').on('keyup', function() {
                table.column(1).search(this.value).draw();
            });

            $('#asset_id').on('change', function() {
                var selectedValue = $(this).val();
                table.column(5) // Replace '1' with the index of the column you want to filter
                    .search(selectedValue)
                    .draw();
            });
            $('#run_no').on('change', function() {
                var selectedValue = $(this).val();
                table.column(10) // Replace '1' with the index of the column you want to filter
                    .search(selectedValue)
                    .draw();
            });

            // Initialize the date range picker
            // $('#dateRangePicker').daterangepicker({
            //     opens: 'right', // or 'right'
            //     startDate: moment(),
            //     endDate: moment().add(7, 'days'),
            //     ranges: {
            //         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            //         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            //         'This Month': [moment().startOf('month'), moment().endOf('month')],
            //         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
            //             'month').endOf('month')]
            //     }
            // });
            $('#dateRangePicker').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });


            // Apply date filter to the DataTable
            $('#dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
                const startDate = picker.startDate.format('YYYY-MM-DD');
                const endDate = picker.endDate.format('YYYY-MM-DD');
                const dateRange = startDate + ' - ' + endDate;

                table.columns(9).search(dateRange).draw();
            });

            // Clear filter and input when 'Clear' is clicked
            $('#dateRangePicker').on('cancel.daterangepicker', function() {
                $(this).val('');
                table.column(9).search('').draw();
            });
        });
    </script>
@endsection
