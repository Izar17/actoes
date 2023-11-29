@extends('layouts.admin')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" id="success-message">
            {{ session('success') }}
        </div>
    @endif
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
                                                    {{-- <option value="{{ $data->id }}"> --}}
                                                    <option value="{{ $data->id }}"
                                                        @if (isset($request)) @if ($data->id == $request->asset_id ?? '') selected @endif
                                                        @endif>
                                                        {{ $data->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td width="35%"><label class="required" for="rx_no">RX Number</label>
                                            <input type="text" class="form-control rx-number" id="rx_number"
                                                name="rx_number" value="{{ $request->rx_number ?? '' }}"
                                                placeholder="CODE-00000-YYYY">
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
                                                    {{-- <option value="{{ $hospital->id }}"> --}}
                                                    <option value="{{ $hospital->id }}"
                                                        @if (isset($request)) @if ($hospital->id == $request->hospital_id ?? '') selected @endif
                                                        @endif>
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
                                                    {{-- <option value="{{ $data->id }}"> --}}
                                                    <option value="{{ $data->id }}"
                                                        @if (isset($request)) @if ($data->id == $request->run_no ?? '') selected @endif
                                                        @endif>
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
                                                id="startDate" name="startDate"
                                                value="@if (isset($request)) {{ $request->startDate }} @endif">
                                        </td>
                                        <td>
                                            To<input type="date" class="clear-rx-number form-control endDate"
                                                id="endDate" name="endDate"
                                                value="@if (isset($request)) {{ $request->endDate }} @endif">

                                            <input type="hidden" value="NO" name="cancel" />
                                        </td>
                                        <td style="text-align:right;" valign="bottom">
                                            <button class="btn  btn-info" type="submit" id="searchButton">
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
                            Cancel DRSI
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.printdrsi.searchByDrsi') }}" method="GET" autocomplete="off">
                                @csrf
                                <table>
                                    <tr>
                                        <td width="250px">Search by:
                                            <select name="selectDrsi" class="form-control selectDrsi">
                                                <option value="ALL"></option>
                                                <option value="DR">DR</option>
                                                <option value="SI">SI</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="250px">Input DR or SI Number:</label>
                                            <input type="text" class="form-control drsi" id="invoice_no" name="drsi">
                                            <input type="hidden" value="YES" name="cancel" />
                                        </td>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right;" valign="bottom">
                                            <button class="btn  btn-info" type="submit" id="searchDrSiButton">
                                                Search
                                            </button>
                                        </td>
                                    </tr>
                                    </tr>
                                </table>
                            </form>
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
                                                    name="edr_no[{{ $key }}]" style="width:100px;"
                                                    value="{{ $transaction->dr_no }}" />
                                                <input type="text" class="form-control dr_no"
                                                    name="dr_no[{{ $key }}]" style="width:100px;"
                                                    value="{{ $transaction->dr_no }}" list="dr_list_id"
                                                    @if ($request->selectDrsi == 'SI') readonly @endif />
                                                <datalist id="dr_list_id">
                                                    @if ($request->selectDrsi == 'DR')
                                                        <option value="Cancel">
                                                    @endif
                                                </datalist>
                                            </td>
                                            <td>
                                                <input type="hidden" class="form-control invoice_no"
                                                    name="einvoice_no[{{ $key }}]" style="width:100px;"
                                                    value="{{ $transaction->invoice_no }}" />
                                                <input type="text" class="form-control invoice_no"
                                                    name="invoice_no[{{ $key }}]" style="width:100px;"
                                                    value="{{ $transaction->invoice_no }}" list="si_list_id"
                                                    @if ($request->selectDrsi == 'DR') readonly @endif />
                                                <datalist id="si_list_id">
                                                    @if ($request->selectDrsi == 'SI')
                                                        <option value="Cancel">
                                                    @endif
                                                </datalist>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control price" id="price"
                                                    name="price[{{ $key }}]" style="width:100px;"
                                                    value="{{ $transaction->price ?? 0 }}" />
                                                <input type="hidden" class="form-control dr_no"
                                                    name="item[{{ $key }}]" style="width:50px;"
                                                    value="{{ $transaction->id }}" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group" style="text-align:center;">
                            <div id="show_save" class="myDiv">

                                <input type="hidden" name="_token" value="{{ $request->_token ?? '' }}" />
                                <input type="hidden" name="asset_id" value="{{ $request->asset_id ?? '' }}" />
                                <input type="hidden" name="rx_number" value="{{ $request->rx_number ?? '' }}" />
                                <input type="hidden" name="hospital_id" value="{{ $request->hospital_id ?? '' }}" />
                                <input type="hidden" name="run_no" value="{{ $request->run_no ?? '' }}" />
                                <input type="hidden" name="startDate" value="{{ $request->startDate ?? '' }}" />
                                <input type="hidden" name="endDate" value="{{ $request->endDate ?? '' }}" />

                                <input type="hidden" value="{{ $request->cancel }}" name="cancel" />

                                <input type="hidden" value="{{ $request->selectDrsi ?? '' }}" name="selectDrsi" />
                                <input type="hidden" value="{{ $request->drsi ?? '' }}" name="drsi" />

                                @if ($request->cancel == 'NO')
                                    <button class="btn btn-warning" type="submit">Update</button>
                                @else
                                    <button class="btn btn-danger" type="submit">Cancel and Update</button>
                                @endif

                            </div>
                        </div>
                    </form>
                    <form action="{{ route('admin.printdrsi.printDr') }}" method="GET" autocomplete="off"
                        target="_blank">
                        @csrf

                        <input type="hidden" name="asset_id" value="{{ $request->asset_id ?? '' }}" />
                        <input type="hidden" name="rx_number" value="{{ $request->rx_number ?? '' }}" />
                        <input type="hidden" name="hospital_id" value="{{ $request->hospital_id ?? '' }}" />
                        <input type="hidden" name="run_no" value="{{ $request->run_no ?? '' }}" />
                        <input type="hidden" name="startDate" value="{{ $request->startDate ?? '' }}" />
                        <input type="hidden" name="endDate" value="{{ $request->endDate ?? '' }}" />

                        <input type="hidden" value="{{ $request->cancel }}" name="cancel" />

                        <input type="hidden" value="{{ $request->selectDrsi ?? '' }}" name="selectDrsi" />
                        <input type="hidden" value="{{ $request->drsi ?? '' }}" name="drsi" />
                        <div class="form-group" style="text-align:center;">
                            <center>
                            <div id="show_save" class="myDiv">
                                <table>
                                    <tr>
                                        <td>
                                            Date: <input type="text" class="form-control calDate" name="calDate"
                                                style="width:150px;" value="{{ $delCharge->calibration_date ?? '' }}"
                                                required /></td>
                                        <td>&nbsp;<br>
                                            <button class="btn btn-success" type="submit" id="earchButton">
                                                Print Delivery Receipt
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            </center>
                        </div>
                    </form>
                    <form action="{{ route('admin.printdrsi.printSi') }}" method="GET" autocomplete="off"
                        target="_blank">
                        @csrf
                        <input type="hidden" name="asset_id" value="{{ $request->asset_id ?? '' }}" />
                        <input type="hidden" name="rx_number" value="{{ $request->rx_number ?? '' }}" />
                        <input type="hidden" name="hospital_id" value="{{ $request->hospital_id ?? '' }}" />
                        <input type="hidden" name="run_no" value="{{ $request->run_no ?? '' }}" />
                        <input type="hidden" name="startDate" value="{{ $request->startDate ?? '' }}" />
                        <input type="hidden" name="endDate" value="{{ $request->endDate ?? '' }}" />

                        <input type="hidden" value="{{ $request->cancel }}" name="cancel" />

                        <input type="hidden" value="{{ $request->selectDrsi ?? '' }}" name="selectDrsi" />
                        <input type="hidden" value="{{ $request->drsi ?? '' }}" name="drsi" />
                        <center>
                            <div class="form-group">
                                <div id="show_save" class="myDiv">
                                    @foreach ($delCharges as $delCharge)
                                    @endforeach
                                    <table>
                                        <tr>
                                            <td>
                                                Delivery Charge: <input type="text" class="form-control price"
                                                    id="delivery_charge" name="delivery_charge" style="width:100px;"
                                                    value="{{ $delCharge->delivery_charge ?? 0 }}" required />
                                            </td>
                                            <td>&nbsp;<br>
                                                <button class="btn btn-success" type="submit" id="earchButton">
                                                    Print Sales Invoice
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </center>
                    </form>
                    <form action="{{ route('admin.printdrsi.printSdr') }}" method="GET" autocomplete="off"
                        target="_blank">
                        <input type="hidden" name="asset_id" value="{{ $request->asset_id ?? '' }}" />
                        <input type="hidden" name="rx_number" value="{{ $request->rx_number ?? '' }}" />
                        <input type="hidden" name="hospital_id" value="{{ $request->hospital_id ?? '' }}" />
                        <input type="hidden" name="run_no" value="{{ $request->run_no ?? '' }}" />
                        <input type="hidden" name="startDate" value="{{ $request->startDate ?? '' }}" />
                        <input type="hidden" name="endDate" value="{{ $request->endDate ?? '' }}" />

                        <input type="hidden" value="{{ $request->cancel }}" name="cancel" />

                        <input type="hidden" value="{{ $request->selectDrsi ?? '' }}" name="selectDrsi" />
                        <input type="hidden" value="{{ $request->drsi ?? '' }}" name="drsi" />
                        <div class="form-group" style="text-align:center;">
                            <div id="show_save" class="myDiv">
                                <center>
                                    <table>
                                        <tr>
                                            <td>
                                                @foreach ($delCharges as $delCharge)
                                                @endforeach
                                                Doctor Name: <input type="text" class="form-control price"
                                                    id="doctor_name" name="doctor_name" style="width:200px;"
                                                    value="{{ $delCharge->doctor_name ?? '' }}" required />
                                            </td>
                                            <td>
                                                Delivery Charge: <input type="text" class="form-control price"
                                                    id="delivery_charge" name="delivery_charge" style="width:100px;"
                                                    value="{{ $delCharge->delivery_charge ?? 0 }}" required />
                                            </td>
                                            <td>&nbsp;<br>
                                                <button class="btn btn-success" type="submit" id="earchButton">
                                                    Print Special Delivery Receipt
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </center>
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

        const openNewTabButton = document.getElementById('printButton');

        openNewTabButton.addEventListener('click', function() {
            // Open a new tab/window when the button is clicked
            window.open('printdrsi', '_blank');
        });

        // Wait for the document to be ready
        document.addEventListener('DOMContentLoaded', function() {
            // Get the success message element
            var successMessage = document.getElementById('success-message');

            // Hide the success message after 5 seconds (5000 milliseconds)
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 5000); // Adjust the time interval as needed
        });
    </script>
@endsection
