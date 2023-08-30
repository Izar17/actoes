@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            {{ trans('global.search') }}
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.printdrsi.searchDrsi') }}" method="GET" autocomplete="off">
                                @csrf
                                <table width="100%">
                                    <tr>
                                        <td width="20%">Search by:</td>
                                        <td width="35%"><label class="required" for="asset_id">Isotope</label>
                                            <select class="clear-rx-number form-control asset" name="asset_id"
                                                id="asset_id">
                                                <option value="">All</option>
                                                @foreach ($assets as $data)
                                                    <option value="{{ $data->id }}">
                                                        {{ $data->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td width="35%"><label class="required" for="rx_no">RX Number</label>
                                            <input type="text" class="form-control rx-number" id="rx_number"
                                                name="rx_number" placeholder="CODE-00000-YYYY">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label style="width:150px;">Hospital:</label>
                                        </td>
                                        <td colspan="2px">
                                            <select class="clear-rx-number form-control hospital" name="hospital_id"
                                                id="hospital_id" required>
                                                <option value=""></option>
                                                @foreach ($hospitals as $id => $hospital)
                                                    <option value="{{ $hospital->id }}">
                                                        {{ $hospital->hospital }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label style="width:90px;">and by:</label>
                                        </td>
                                        <td>
                                            <select class="clear-rx-number form-control asset" name="run_no"
                                                id="run_no">
                                                <option value="">Run #</option>
                                                @foreach ($run_nos as $data)
                                                    <option value="{{ $data->id }}">
                                                        {{ $data->run_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Calibration Date:</td>
                                        <td>
                                            From<input type="date" class="clear-rx-number form-control startDate"
                                                id="startDate" name="startDate" placeholder="Start Date">
                                        </td>
                                        <td>
                                            To<input type="date" class="clear-rx-number form-control endDate"
                                                id="endDate" name="endDate" placeholder="to Date">
                                        </td>
                                        <td style="text-align:right;" valign="bottom">
                                            <button class="btn  btn-info" type="submit" id="earchButton">
                                                {{ trans('global.search') }}
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Second Column Content -->
                    <div class="card">
                        <div class="card-header">
                            Cancel DR/SI
                        </div>
                        <div class="card-body">
                            <table height="198px">
                                <tr>
                                    <td width="250px"><label class="required" for="dr_no">DR Number</label>
                                        <input type="text" class="form-control dr_no" id="dr_no"
                                            name="dr_no">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="250px"><label class="required" for="invoice_no">SI Number</label>
                                        <input type="text" class="form-control invoice_no" id="invoice_no"
                                            name="invoice_no">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($transactions))
                <div class="card">
                    <div class="card-header">
                        Result
                    </div>
                    <form method="POST" action="{{ route('admin.printdrsi.update', 1) }}" enctype="multipart/form-data"
                        autocomplete="off">
                        @method('PUT')
                        @csrf


                        <div class="table-responsive">
                            <table id="dataTable"
                                class=" table table-bordered table-striped table-hover datatable datatable-transaction">
                                <thead>
                                    <tr>
                                        <th style="width:115px;">
                                            Created Date
                                        </th>
                                        <th style="width:280px;">
                                            {{ trans('cruds.transaction.fields.hospital') }}
                                        </th>
                                        <th style="width:130px;">
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
                                        <th style="width:180px;">
                                            {{ trans('cruds.transaction.fields.user') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.transaction.fields.remarks') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.transaction.fields.dr') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.transaction.fields.si') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.transaction.fields.price') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.transaction.fields.del_charge') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $key => $transaction)
                                        <tr data-entry-id="{{ $transaction->id }}">
                                            <td>
                                                {{ $transaction->created_at }}
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
                                                <input type="hidden" name="hospital"
                                                    value="{{ $transaction->hospital_id }}" />
                                                <input type="hidden" class="form-control dr_no"
                                                    name="item[{{ $key }}]" style="width:50px;"
                                                    value="{{ $transaction->id }}" />
                                                <input type="text" class="form-control dr_no"
                                                    name="dr_no[{{ $key }}]" style="width:100px;"
                                                    value="{{ $transaction->dr_no }}" />
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
                                            <td>
                                                <input type="text" class="form-control price" id="delivery_charge"
                                                    name="delivery_charge[{{ $key }}]" style="width:100px;"
                                                    value="{{ $transaction->delivery_charge }}" required />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group" style="text-align:center;">
                            <div id="show_save" class="myDiv">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#rx_number').on('keyup', function() {
                rxNumberChange();
            });
            $('#rx_number').on('change', function() {
                rxNumberChange();
            });
            $('.clear-rx-number').on('change', function() {
                clearRxNumber();
            });

            function rxNumberChange() {
                $('#hospital_id').val('');
                $('#asset_id').val('');
                $('#run_no').val('');
                $('#startDate').val('');
                $('#endDate').val('');

                const hospital = document.getElementById("hospital_id");
                hospital.removeAttribute('required');
            }

            function clearRxNumber() {
                $('#rx_number').val('');
            }
        });

        const openNewTabButton = document.getElementById('searchButton');

        openNewTabButton.addEventListener('click', function() {
            // Open a new tab/window when the button is clicked
            window.open('admin.reports.print.page1', '_blank');
        });
    </script>
@endsection
