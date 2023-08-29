@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.transaction.order_title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.drsis.update', 17) }}" enctype="multipart/form-data"
                autocomplete="off">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.drsis.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <div class="row my-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hospital_id">{{ trans('cruds.transaction.fields.hospital') }}</label>

                            @foreach ($transactions as $hosp => $transaction)
                            @endforeach
                            <input type="text" class="form-control hospital"
                                value="{{ $transaction->hospital->hospital ?? '' }}" readonly />

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user">{{ trans('cruds.transaction.fields.user') }}</label>
                            <input type="text" class="form-control user" value="{{ old('email', auth()->user()->name) }}"
                                name="performed_by" readonly />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="hospital_id">Search:</label>
                        <table>
                            <tr>
                                <td>
                                    <select class="form-control asset" id="asset_id" style="width:200px;">
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
                                    <select class="form-control asset" id="run_no" style="width:200px;">
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
                                    <input type="text" class="form-control dateRangePicker" style="width:200px;"
                                        id="dateRangePicker" placeholder="Select date range">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="table-responsive">
                    <table id="dataTable"
                        class=" table table-bordered table-striped table-hover datatable datatable-transaction">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    ID
                                </th>
                                <th style="width:115px;">
                                    Created Date
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
                                    {{ trans('cruds.transaction.fields.patient') }}
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
                                <th class="col-md-1">
                                    {{ trans('cruds.transaction.fields.dr') }}
                                </th>
                                <th class="col-md-1">
                                    {{ trans('cruds.transaction.fields.si') }}
                                </th>
                                <th class="col-md-1">
                                    {{ trans('cruds.transaction.fields.price') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $key => $transaction)
                                <tr data-entry-id="{{ $transaction->id }}">
                                    <td>
                                        {{ $transaction->id }}
                                    </td>
                                    <td>
                                        {{ $transaction->created_at }}
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
                                        {{ $transaction->patient ?? '' }}
                                    </td>
                                    <td>
                                        {{ $transaction->activity_mci ?? '' }} mCi
                                        {{ $transaction->asset_product->product_name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $transaction->calibration_date }}
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
                                        <input type="hidden" name="hospital" value="{{ $transaction->hospital_id }}" />
                                        <input type="hidden" class="form-control dr_no" name="item[{{ $key }}]"
                                            style="width:50px;" value="{{ $transaction->id }}" />
                                        <input type="text" class="form-control dr_no" name="dr_no[{{ $key }}]"
                                            style="width:100px;" value="{{ $transaction->dr_no }}" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control invoice_no"
                                            name="invoice_no[{{ $key }}]" style="width:100px;"
                                            value="{{ $transaction->invoice_no }}" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control price" id="price"
                                            name="price[{{ $key }}]" style="width:100px;"
                                            value="{{ $transaction->price }}" required />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="form-group"style="text-align:center;">
                    <hr>
                    <div id="show_save" class="myDiv">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </form>
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
                    [0, 'desc']
                ],
                pageLength: 100,
                columnDefs: [{
                    orderable: true,
                    className: '',
                    targets: 0
                }]
            });

            $('#asset_id').on('change', function() {
                var selectedValue = $(this).val();
                table.column(4) // Replace '1' with the index of the column you want to filter
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
            $('#dateRangePicker').daterangepicker({
                opens: 'right', // or 'right'
                startDate: moment(),
                endDate: moment().add(7, 'days'),
                ranges: {
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            });


            // Apply date filter to the DataTable
            $('#dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
                const startDate = picker.startDate.format('YYYY-MM-DD');
                const endDate = picker.endDate.format('YYYY-MM-DD');
                const dateRange = startDate + ' to ' + endDate;

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
