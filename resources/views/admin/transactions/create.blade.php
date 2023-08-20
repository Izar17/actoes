@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.transaction.order_title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" id="formOrder" action="{{ route('admin.transactions.store') }}" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                <div class="row my-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="asset_id">{{ trans('cruds.transaction.fields.asset') }}</label>

                            <select class="form-control select2 {{ $errors->has('asset') ? 'is-invalid' : '' }}"
                                name="asset_id" id="asset_id" required>
                                <option value="">Select Isotope</option>
                                @foreach ($assets as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('asset'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('asset') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.asset_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required"
                                for="hospital_id">{{ trans('cruds.transaction.fields.hospital') }}</label>
                            <select class="form-control select2 {{ $errors->has('hospital') ? 'is-invalid' : '' }}"
                                name="hospital_id" id="hospital_id" required>
                                @foreach ($hospitals as $id => $hospital)
                                    <option value="{{ $id }}" {{ old('hospital_id') == $id ? 'selected' : '' }}>
                                        {{ $hospital }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('hospital'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hospital') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.hospital_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user">{{ trans('cruds.transaction.fields.user') }}</label>
                            <input type="text" class="form-control user"
                                value="{{ old('email', auth()->user()->name) }}" name="user" readonly />
                        </div>
                    </div>
                </div>

                <div id="show1" class="myDiv">

                </div>
                <div id="show2" class="myDiv">
                    <strong>I-131 (RAI)</strong>
                </div>
                <div id="show3" class="myDiv">
                    <strong>Tl-201</strong>
                </div>
                <div id="show4" class="myDiv">
                    <strong>Y-90</strong>
                </div>
                <div id="show5" class="myDiv">
                    <strong>MIBG (I-131)</strong>
                </div>
                <div id="show6" class="myDiv">
                    <strong>Mo99/Tc99m Generator</strong>
                </div>
                <div id="show7" class="myDiv">
                    <strong>RadioImmunoassay (RIA)</strong>
                </div>
                <div id="show8" class="myDiv">
                    <strong>MISC</strong>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-white" id="tableOrder">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">#</th>
                                        <th class="col-md-2">{{ trans('cruds.transaction.fields.asset_product') }} *</th>
                                        <th class="col-md-1">{{ trans('cruds.transaction.fields.activity_mci') }}</th>
                                        <th class="col-md-2">{{ trans('cruds.transaction.fields.procedure') }}</th>
                                        <th style="width: 80px">{{ trans('cruds.transaction.fields.volume') }}</th>
                                        <th class="col-md-2">{{ trans('cruds.transaction.fields.patient') }}</th>
                                        <th class="col-md-1">{{ trans('cruds.transaction.fields.calibration_date') }}
                                        <th class="col-sm-1">{{ trans('cruds.transaction.fields.ofm') }}</th>
                                        <th class="col-sm-2">{{ trans('cruds.transaction.fields.run_no') }}</th>
                                        <th class="col-sm-2">{{ trans('cruds.transaction.fields.remarks') }}</th>

                                        <th>
                                            <div id="show_add" class="myDiv">
                                                <a href="javascript:void(0)" class="text-success font-50" title="Add"
                                                    id="addBtn"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
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
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    @parent

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
        //Show Hide
        $(document).ready(function() {
            $("div.myDiv").hide();
            $('#asset_id').on('change', function() {
                var demovalue = $(this).val();
                $("div.myDiv").hide();
                $("#show" + demovalue).show();
                if (demovalue != '') {
                    $("#show_add").show();
                }
            });
        });


        function clearAllFields() {
            // Get all input elements on the page
            const inputElements = document.querySelectorAll('input');
            const csrfTokenField = document.querySelector('input[name="_token"]');
            const createdBy = document.querySelector('input[name="user"]');
            // Loop through input elements and clear their values except type="time"
            inputElements.forEach(input => {
                if (input.getAttribute('type') !== 'time' && input !== csrfTokenField && input !== createdBy) {
                    input.value = '';
                }
            });
        }

        //Onchange Asset
        $(document).ready(function() {
            $('#asset_id').on('change', function() {
                clearAllFields();
                const table = document.getElementById('tableOrder');
                const tdList = table.querySelectorAll('td');

                tdList.forEach(td => {
                    td.parentNode.removeChild(td); // Remove the entire <td> element
                });

                callTable();
            });
        });

        // add multiple row
        $("#addBtn").on("click", function() {
            callTable(0, 0);
        });
        var rowId = 0;
        var rowIdx = 0;

        function callTable() {
            ++rowId;
            $("#show_save").show();
            var idAsset = document.getElementById("asset_id").value;
            $("#asset_product_id" + rowId).html('');
            $.ajax({
                url: "{{ url('api/fetch-product') }}",
                type: "POST",
                data: {
                    asset_id: idAsset,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    if (idAsset < 3) {
                        $('#asset_product_id' + rowId).html(
                            '<option value="">Select Unit</option>');
                    }
                    $.each(result.asset_products, function(key, value) {
                        $("#asset_product_id" + rowId).append('<option value="' +
                            value
                            .id + '">' + value.product_name + '</option>');
                    });

                    const procedure = document.getElementById("procedure" + rowId);
                    const volume = document.getElementById("volume" + rowId);
                    if (idAsset == 1) {
                        // If 'readonly' attribute is already set, remove it and make the field editable
                        procedure.removeAttribute('readonly');
                        procedure.setAttribute('required', 'required');
                        volume.removeAttribute('readonly');
                        volume.setAttribute('required', 'required');
                    } else {
                        procedure.value = '';
                        // If 'readonly' attribute is not set, add it and make the field read-only
                        procedure.setAttribute('readonly', 'readonly');
                        procedure.removeAttribute('required');
                        $("#procedure" + rowId).html('');
                        volume.value = '';
                        // If 'readonly' attribute is not set, add it and make the field read-only
                        volume.setAttribute('readonly', 'readonly');
                        volume.removeAttribute('required');
                        $("#volume" + rowId).html('');
                    }

                    $('#asset_product_id' + rowId).on('change', function() {
                        var idProduct = this.value;
                        $("#product_activity_id" + rowId).html('');
                        $.ajax({
                            url: "{{ url('api/fetch-activities') }}",
                            type: "POST",
                            data: {
                                product_id: idProduct,
                                _token: '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(res) {
                                $.each(res.product_activities, function(key,
                                    value) {
                                    $("#product_activity_id" + rowId)
                                        .append('<option value="' +
                                            value
                                            .activity_name + '">');
                                });
                            }
                        });
                        $("#product_activity_ids" + rowId).html('');
                        $.ajax({
                            url: "{{ url('api/fetch-procedure') }}",
                            type: "POST",
                            data: {
                                product_id: idProduct,
                                _token: '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(res) {
                                $.each(res.procedures, function(key,
                                    value) {
                                    $("#product_activity_ids" + rowId)
                                        .append('<option value="' +
                                            value
                                            .procedure_name + '">');
                                });
                            }
                        });
                    });
                }
            });
            $("#leadpot_id" + rowId).html('');
            $.ajax({
                url: "{{ url('api/fetch-leadpot') }}",
                type: "POST",
                data: {
                    asset_id: idAsset,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $.each(result.lead_pots, function(key, value) {
                        $("#leadpot_id" + rowId).append('<option value="' + value
                            .id + '">' + value.lead_code + '</option>');
                    });
                }
            });

            // Adding a row inside the tbody.
            $("#tableOrder tbody").append(`
                <tr id="R${++rowIdx}">
                    <td class="row-index text-center"><p> ${rowIdx}</p></td>
                    <td>
                        <select
                            class="form-control select2 {{ $errors->has('asset_product') ? 'is-invalid' : '' }}"
                            name="item[]" id="asset_product_id${rowIdx}" required>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="activity_mci[]" id="activity_mci${rowIdx}" list="product_activity_id${rowIdx}" class="form-control activity_mci" required>
                        <datalist id="product_activity_id${rowIdx}">
                        </datalist>
                        <input type="hidden" id="activity_mbq${rowIdx}" name="activity_mbq[]"/>
                        <input type="hidden" id="discrepancy${rowIdx}" name="discrepancy[]"/>
                    </td>
                    <td>
                        <input type="text" name="procedure[]" id="procedure${rowIdx}"
                            list="product_activity_ids${rowIdx}" class="form-control procedure required">
                        <datalist id="product_activity_ids${rowIdx}"></datalist>
                    </td>
                    <td>
                        <input class="form-control volume" type="text" id="volume${rowIdx}"
                            name="volume[]" />
                    </td>
                    <td>
                        <input type="text" name="patient[]" id="patient"
                            list="patient_list_id" class="form-control patient" required>
                        <datalist id="patient_list_id"><option value="Confidential"></datalist>
                    </td>
                    <td>
                        <input class="form-control calibration_date" type="date" name="calibration_date[]" id="calibration_date"  min="{{ date('Y-m-d') }}" required/>
                        <input class="form-control calibration_time" type="time" value="12:00" name="calibration_time[]" id="calibration_time"/>
                    </td>
                    <td><input class="form-control" type="text" style="min-width:150px" id="orderform_no" name="orderform_no[]" required/></td>
                    <td>
                        <select
                            class="form-control run_no {{ $errors->has('run_no') ? 'is-invalid' : '' }}"
                            name="run_no[]" id="run_no_id" required>
                            @foreach ($run_nos as $id => $run_no)
                                <option value="{{ $id }}"
                                    {{ old('run_no_id') == $id ? 'selected' : '' }}>
                                    {{ $run_no }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control remarks" id="remarks"
                            name="remarks[]" />
                    </td>
                    <td><a href="javascript:void(0)" class="text-danger font-18 remove" title="Remove"><i class="fa fa-trash-o"></i></a></td>
                </tr>`);
        }
        //<input class="form-control activity_mci" style="width:100px" type="text" id="activity_mci" name="activity_mci[]">
        $("#tableOrder tbody").on("click", ".remove", function() {
            // Getting all the rows next to the row
            // containing the clicked button
            var child = $(this).closest("tr").nextAll();
            // Iterating across all the rows
            // obtained to change the index
            child.each(function() {
                // Getting <tr> id.
                var id = $(this).attr("id");

                // Getting the <p> inside the .row-index class.
                var idx = $(this).children(".row-index").children("p");

                // Gets the row number from <tr> id.
                var dig = parseInt(id.substring(1));

                // Modifying row index.
                idx.html(`${dig - 1}`);

                // Modifying row id.
                $(this).attr("id", `R${dig - 1}`);
            });

            // Removing the current row.
            $(this).closest("tr").remove();

            // Decreasing total number of rows by 1.
            rowIdx--;
        });

        $("#tableOrder tbody").on("input", ".unit_price", function() {
            var unit_price = parseFloat($(this).val());
            $("#qty").val(37 * unit_price);

            var qty = parseFloat($(this).closest("tr").find(".qty").val());
            var total = $(this).closest("tr").find(".total");

            total.val(unit_price * qty);

            calc_total();
        });

        $("#tableOrder tbody").on("input", ".qty", function() {
            var qty = parseFloat($(this).val());
            var unit_price = parseFloat($(this).closest("tr").find(".unit_price").val());
            var total = $(this).closest("tr").find(".total");
            total.val(unit_price * qty);
            calc_total();
        });

        function calc_total() {
            var sum = 0;
            $(".total").each(function() {
                sum += parseFloat($(this).val());
            });
            $(".subtotal").text(sum);

            var amounts = sum;
            var tax = 100;
            $(document).on("change keyup blur", "#qty", function() {
                var qty = $("#qty").val();
                var discount = $(".discount").val();
                $(".total").val(amounts * qty);
                $("#sum_total").val(amounts * qty);
                $("#tax_1").val((amounts * qty) / tax);
                $("#grand_total").val((parseInt(amounts)) - (parseInt(discount)));
            });
        }
    </script>
@endsection
