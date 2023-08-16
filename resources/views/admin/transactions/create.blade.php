@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.transaction.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.transactions.store') }}" enctype="multipart/form-data"
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
                            <label class="required" for="hospital_id">{{ trans('cruds.transaction.fields.hospital') }}</label>
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
                            <label for="created_date">Created Date</label>
                            <input type="text" class="form-control created_date" readonly/>
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
                                        <th class="col-md-2">{{ trans('cruds.transaction.fields.asset_product') }}</th>
                                        <th class="col-md-1">{{ trans('cruds.transaction.fields.activity_mci') }}</th>
                                        <th class="col-md-2">{{ trans('cruds.transaction.fields.patient') }}</th>
                                        <th style="width:80px;">{{ trans('cruds.transaction.fields.calibration_date') }}
                                        <th class="col-md-1">{{ trans('cruds.transaction.fields.lot_no') }}
                                        <th class="col-sm-1">{{ trans('cruds.transaction.fields.ofm') }}</th>
                                        <th class="col-sm-2">{{ trans('cruds.transaction.fields.remarks') }}</th>
                                        <th class="col-sm-1">{{ trans('cruds.transaction.fields.max_doserate') }}</th>
                                        <th class="col-sm-1">{{ trans('cruds.transaction.fields.doserate_meter') }}</th>
                                        <th class="col-sm-1">{{ trans('cruds.transaction.fields.leadpot') }}</th>
                                        </th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="1">
                                        <td>1</td>
                                        <td>
                                            <select
                                                class="form-control select2 {{ $errors->has('asset_product') ? 'is-invalid' : '' }}"
                                                name="item[]" id="asset_product_id1" required>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="activity_mci[]" id="activity_mci1"
                                                list="product_activity_id1" class="form-control activity_mci">
                                            <datalist id="product_activity_id1">
                                            </datalist>
                                            <input type="hidden" id="activity_mbq1" name="activity_mbq[]" />
                                            <input type="hidden" id="discrepancy1" name="discrepancy[]" />
                                        </td>
                                        <td>
                                            <input type="text" name="patient[]" id="patient" list="patient_list_id"
                                                class="form-control activity_mci">
                                            <datalist id="patient_list_id">
                                                <option value="Confidential">
                                            </datalist>
                                        </td>
                                        <td>
                                            <input class="form-control calibration_date" type="date"
                                                name="calibration_date[]" id="calibration_date" required />
                                            <input class="form-control calibration_time" type="time" value="12:00"
                                                name="calibration_time[]" id="calibration_time" />
                                        </td>
                                        <td>
                                            <input class="form-control lot_no" type="text" id="lot_no"
                                                name="lot_no[]" readonly />
                                        </td>
                                        <td>
                                            <input class="form-control" style="min-width:100px" type="text"
                                                id="orderform_no" name="orderform_no[]">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control remarks" id="remarks"
                                                name="remarks[]" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control max_doserate" id="max_doserate"
                                                name="max_doserate[]" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control doserate_meter" id="doserate_meter"
                                                name="doserate_meter[]" />
                                        </td>
                                        <td>
                                            <select
                                                class="form-control leadpot {{ $errors->has('leadpot') ? 'is-invalid' : '' }}"
                                                name="leadpot[]" id="leadpot_id1" required>
                                            </select>
                                        </td>
                                        <td>
                                            <div id="show_add" class="myDiv">
                                                <a href="javascript:void(0)" class="text-success font-18" title="Add"
                                                    id="addBtn"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group"style="text-align:center;">
                            <hr>
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
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
    </script>


    <script>
        $(document).ready(function() {
            $('#asset_id').on('change', function() {
                var idAsset = this.value;

                const lot_no = document.getElementById('lot_no');
                if (idAsset == 2) {
                    lot_no.value = '';
                    // If 'readonly' attribute is not set, add it and make the field read-only
                    lot_no.setAttribute('readonly', 'readonly');
                    lot_no.removeAttribute('required');
                } else {
                    // If 'readonly' attribute is already set, remove it and make the field editable
                    lot_no.removeAttribute('readonly');
                    lot_no.setAttribute('required', 'required');
                }

                $("#asset_product_id1").html('');
                $.ajax({
                    url: "{{ url('api/fetch-product') }}",
                    type: "POST",
                    data: {
                        asset_id: idAsset,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#asset_product_id' + rowId).html(
                            '<option value="">Select Product</option>');
                        $.each(result.asset_products, function(key, value) {
                            $("#asset_product_id1").append('<option value="' +
                                value
                                .id + '">' + value.product_name + '</option>');
                        });
                    }
                });
                $("#leadpot_id1").html('');
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
                            $("#leadpot_id1").append('<option value="' + value
                                .id + '">' + value.lead_code + '</option>');
                        });
                    }
                });

            });
            $('#asset_product_id1').on('change', function() {
                var idProduct = this.value;
                $("#product_activity_id1").html('');
                $.ajax({
                    url: "{{ url('api/fetch-activities') }}",
                    type: "POST",
                    data: {
                        product_id: idProduct,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $.each(res.product_activities, function(key, value) {
                            $("#product_activity_id1").append('<option value="' + value
                                .activity_name + '">');
                        });
                    }
                });
            });
            $('#activity_mci1').on('keyup', function() {
                var idActivity = this.value;
                discrepancy = +idActivity * .10 + +idActivity;
                $("#activity_mbq1").val((idActivity * 37).toFixed(2));
                $("#discrepancy1").val(discrepancy.toFixed(2));
            });
        });
        // add multiple row
        var rowId = 1;
        var rowIdx = 1;
        $("#addBtn").on("click", function() {
            ++rowId;

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
                    $('#asset_product_id' + rowId).html(
                        '<option value="">Select Product</option>');
                    $.each(result.asset_products, function(key, value) {
                        $("#asset_product_id" + rowId).append('<option value="' +
                            value
                            .id + '">' + value.product_name + '</option>');
                    });
                    const lot_no = document.getElementById("lot_no" + rowId);
                    if (idAsset == 2) {
                        lot_no.value = '';
                        // If 'readonly' attribute is not set, add it and make the field read-only
                        lot_no.setAttribute('readonly', 'readonly');
                        lot_no.removeAttribute('required');
                        $("#lot_no" + rowId).html('');
                    } else {
                        // If 'readonly' attribute is already set, remove it and make the field editable
                        lot_no.removeAttribute('readonly');
                        lot_no.setAttribute('required', 'required');
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
                                $('#activity_mci' + rowId).on('keyup', function() {
                                    var idActivity = this.value;
                                    discrepancy = +idActivity * .10 + +
                                        idActivity;
                                    $("#activity_mbq" + rowId).val((
                                        idActivity * 37).toFixed(2));
                                    $("#discrepancy" + rowId).val(
                                        discrepancy.toFixed(2));
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
                            name="item[]" id="asset_product_id${rowIdx}">
                        </select>
                    </td>
                    <td>
                        <input type="text" name="activity_mci[]" id="activity_mci${rowIdx}" list="product_activity_id${rowIdx}" class="form-control activity_mci">
                        <datalist id="product_activity_id${rowIdx}">
                        </datalist>
                        <input type="hidden" id="activity_mbq${rowIdx}" name="activity_mbq[]"/>
                        <input type="hidden" id="discrepancy${rowIdx}" name="discrepancy[]"/>
                    </td>
                    <td>
                        <input type="text" name="patient[]" id="patient"
                            list="patient_list_id" class="form-control activity_mci">
                        <datalist id="patient_list_id"><option value="Confidential"></datalist>
                    </td>
                                        
                    <td>
                        <input class="form-control calibration_date" type="date" name="calibration_date[]" id="calibration_date" required/>
                        <input class="form-control calibration_time" type="time" value="12:00" name="calibration_time[]" id="calibration_time"/>
                    </td>
                    <td>
                        <input class="form-control lot_no" type="text" id="lot_no${rowIdx}" name="lot_no[]" readonly/>
                    </td>
                    <td><input class="form-control" type="text" style="min-width:150px" id="orderform_no" name="orderform_no[]"></td>               
                    <td>
                        <input type="text" class="form-control remarks" id="remarks"
                            name="remarks[]" />
                    </td>
                    <td>
                        <select
                            class="form-control leadpot {{ $errors->has('leadpot') ? 'is-invalid' : '' }}"
                            name="leadpot[]" id="leadpot_id${rowIdx}">
                        </select>
                    </td>
                    <td><a href="javascript:void(0)" class="text-danger font-18 remove" title="Remove"><i class="fa fa-trash-o"></i></a></td>
                </tr>`);
        });

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
