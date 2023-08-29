@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span>{{ trans('cruds.transaction.order_title_singular') }} {{ trans('global.list') }}</span>
            <div class="row">
                <table>
                    <tr>
                        <td>
                            <input class="form-control asset" type="search" id="search_hospital" placeholder="Search by Hospital...">
                        </td>
                        <td>
                            <select class="form-control asset" id="asset_id" style="width:250px;">
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
                            <select class="form-control asset" id="run_no" style="width:250px;">
                                <option value="" disabled selected>Select Run #</option>
                                <option value="">Select All</option>
                                @foreach ($run_nos as $data)
                                    <option value="{{ $data->run_name }}">
                                        {{ $data->run_name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table  id="dataTable" class=" table table-bordered table-striped table-hover datatable datatable-Production">
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

            $('#search_hospital').on('keyup', function() {
                table.column(2).search(this.value).draw();
            });

            $('#asset_id').on('change', function() {
                var selectedValue = $(this).val();
                table.column(6) // Replace '1' with the index of the column you want to filter
                    .search(selectedValue)
                    .draw();
            });
            $('#run_no').on('change', function() {
                var selectedValue = $(this).val();
                table.column(11) // Replace '1' with the index of the column you want to filter
                    .search(selectedValue)
                    .draw();
            });
    // setTimeout(function() {
    //     location.reload();
    // }, 10000); // 5000 milliseconds = 5 seconds
});
</script>
@endsection
