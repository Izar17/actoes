@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.transaction.order_title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="row my-3">
                    <div class="col-md-6">
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

                            @foreach ($transactions as $cb => $transaction)
                            @endforeach
                            <input type="text" class="form-control hospital" value="{{ $transaction->created_by ?? '' }}"
                                readonly />
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-transaction">
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
                                            @if ($calibrationDateTime < $currentDateTime)
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
            </form>
        </div>
    </div>
@endsection
