@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.search') }}
        </div>

        <div class="card-body">
            <form action="{{ route('admin.reports.print.print') }}" method="GET" autocomplete="off" target="_blank">
                @csrf
                <div class="col-md-6">
                    <table>
                        <tr>
                            <td>Print by:</td>
                            <td><label class="required" for="asset_id">Isotope</label>
                                <select class="form-control asset" name="asset_id" id="asset_id" required>
                                    <option value=""></option>
                                    @foreach ($assets as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><label class="required" for="print_form">Form</label>
                                <select class="form-control print_form" name="printField" id="print_forms" required>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3px">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label style="width:150px;">Search by Hospital:</label>
                            </td>
                            <td colspan="3px">
                                <select class="clear-rx-number form-control hospital" style="width:391px;"
                                    name="hospital_id" id="hospital_id">
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
                                <select class="clear-rx-number form-control asset" name="run_no" id="run_no">
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
                                From<input type="date" class="clear-rx-number form-control startDate" id="startDate"
                                    name="startDate" placeholder="Start Date">
                            </td>
                            <td>
                                To<input type="date" class="clear-rx-number form-control endDate" style="width:190px;"
                                    id="endDate" name="endDate" placeholder="to Date">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3px">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td>RX Number:</td>
                            <td>
                                <input type="text" class="form-control rx-number" style="width:200px;" id="rx_number"
                                    name="rx_number">
                            </td>
                            <td align="right">
                                <button class="btn btn-danger" type="submit" id="earchButton">
                                    {{ trans('global.print') }}
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {

            //Onchange Asset
            $('#asset_id').on('change', function() {

                var idAsset = document.getElementById("asset_id").value;
                $("#print_forms").html('');
                $.ajax({
                    url: "{{ url('api/fetch-form') }}",
                    type: "POST",
                    data: {
                        asset_id: idAsset,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $.each(result.print_forms, function(key, value) {
                            $("#print_forms").append('<option value="' + value
                                .page_id + '">' + value.form_name + '</option>');
                        });
                    }
                });
            });







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
                $('#run_no').val('');
                $('#startDate').val('');
                $('#endDate').val('');
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
