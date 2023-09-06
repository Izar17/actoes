@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.transaction.order_title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.transactions.update', [$transaction->id]) }}"
                enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.transactions.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="asset_id">{{ trans('cruds.transaction.fields.asset') }}</label>
                            <select class="form-control asset_id {{ $errors->has('asset') ? 'is-invalid' : '' }}"
                                id="asset_id" disabled>
                                @foreach ($assets as $id => $asset)
                                    <option value="{{ $id }}"
                                        {{ ($transaction->asset ? $transaction->asset->id : old('asset_id')) == $id ? 'selected' : '' }}>
                                        {{ $asset }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('asset'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('asset') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.asset_helper') }}</span>
                            <input type="hidden" value="{{ $transaction->asset_id }}" name="asset_id" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hospital_id">{{ trans('cruds.transaction.fields.hospital') }}</label>
                            <select class="form-control hospital_id {{ $errors->has('hospital') ? 'is-invalid' : '' }}"
                                id="hospital_id" disabled>
                                @foreach ($hospitals as $id => $hospital)
                                    <option value="{{ $id }}"
                                        {{ ($transaction->hospital ? $transaction->hospital->id : old('hospital_id')) == $id ? 'selected' : '' }}>
                                        {{ $hospital }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('hospital'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hospital') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.hospital_helper') }}</span>
                            <input type="hidden" value="{{ $transaction->hospital_id }}" name="hospital_id" />
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


                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-white" id="tableOrder">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">#</th>
                                        @if ($transaction->asset_id == 6)
                                            <th class="col-md-2">Kit</th>
                                            <th class="col-md-1">Activity GBq</th>
                                        @else
                                            <th class="col-md-2">{{ trans('cruds.transaction.fields.asset_product') }} *
                                            </th>
                                            <th class="col-md-1">
                                                @if ($transaction->asset_id == 4)
                                                    Activity GBq
                                                @else
                                                    {{ trans('cruds.transaction.fields.activity_mci') }}
                                                @endif
                                            </th>
                                        @endif
                                        @if ($transaction->asset_id == 1)
                                            <th class="col-md-2">{{ trans('cruds.transaction.fields.procedure') }}</th>
                                            <th class="col-md-1">{{ trans('cruds.transaction.fields.volume') }}</th>
                                        @endif
                                        <th class="col-md-2">{{ trans('cruds.transaction.fields.patient') }}</th>

                                        @if ($transaction->asset_id == 6)
                                            <th class="col-md-1">Date Needed | Gen #</th>
                                        @else
                                            <th class="col-md-1">{{ trans('cruds.transaction.fields.calibration_date') }}
                                            </th>
                                        @endif
                                        <th class="col-sm-1">{{ trans('cruds.transaction.fields.ofm') }}</th>
                                        @if ($transaction->asset_id != 4)
                                        <th class="col-sm-2">{{ trans('cruds.transaction.fields.run_no') }}</th>
                                        @endif
                                        <th class="col-sm-2">{{ trans('cruds.transaction.fields.remarks') }}</th>
                                        @can('create_transport')
                                            <th class="col-md-1">{{ trans('cruds.transaction.fields.can') }}</th>
                                        @endcan
                                        <th style="width: 80px">{{ trans('cruds.transaction.fields.cancel') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="row-index text-center">
                                            <p> </p>
                                        </td>
                                        <td>
                                            <select class="form-control item" name="item" id="asset_product_id">
                                                @foreach ($asset_products as $id => $asset_product)
                                                    <option value="{{ $id }}"
                                                        {{ $transaction->item == $id ? 'selected' : '' }}>
                                                        {{ $asset_product }}</option>
                                                @endforeach

                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="activity_mci" id="activity_mci"
                                                list="product_activity_id" class="form-control activity_mci"
                                                value="{{ $transaction->activity_mci }}" required>
                                            <datalist id="product_activity_id">
                                            </datalist>
                                            <input type="hidden" id="activity_mbq" name="activity_mbq" />
                                            <input type="hidden" id="discrepancy" name="discrepancy" />
                                            @if ($transaction->asset_id == 4)
                                            <input type="hidden" id="run_no_id" name="run_no" value="8"/>
                                            @endif
                                        </td>
                                        @if ($transaction->asset_id == 1)
                                            <td>
                                                <input type="text" name="procedure1" id="procedure"
                                                    value="{{ $transaction->procedure1 }}" list="product_activity_ids"
                                                    class="form-control procedure" required>
                                                <datalist id="product_activity_ids"></datalist>
                                            </td>
                                            <td>
                                                <input class="form-control volume" list="vol_id" type="text"
                                                    id="volume" value="{{ $transaction->volume }}" name="volume" />
                                                <datalist id="vol_id">
                                                    <option value="N/A">
                                                </datalist>
                                            </td>
                                        @endif
                                        <td>
                                            <input type="text" name="patient" id="patient" list="patient_list_id"
                                                class="form-control patient" value="{{ $transaction->patient }}"
                                                @if ($transaction->asset_id == 6) readonly @else required @endif>
                                            <datalist id="patient_list_id">
                                                <option value="Confidential">
                                            </datalist>
                                        </td>
                                        <td>
                                            <input class="form-control calibration_date" type="date"
                                                value="{{ $transaction->calibration_date }}" name="calibration_date"
                                                id="calibration_date" min="{{ date('Y-m-d') }}" required />
                                            <input class="form-control calibration_time"
                                                @if ($transaction->asset_id == 4) type="hidden"
                                            @else
                                            type="text" @endif
                                                value="{{ substr($transaction->calibration_time, 0, 5) ?? '' }}"
                                                name="calibration_time" id="calibration_time" />
                        </div>
                        </td>
                        <td><input class="form-control" type="text" style="min-width:150px"
                                value="{{ $transaction->orderform_no }}" id="orderform_no" name="orderform_no"
                                required /></td>
                                @if ($transaction->asset_id != 4)
                        <td>
                            <select class="form-control run_no {{ $errors->has('run_no') ? 'is-invalid' : '' }}"
                                name="run_no" id="run_no_id" required>
                                @foreach ($run_nos as $id => $run_no)
                                    <option value="{{ $id }}"
                                        {{ $transaction->run_no == $id ? 'selected' : '' }}>
                                        {{ $run_no }}</option>
                                @endforeach
                            </select>
                        </td>
                        @endif
                        <td>
                            <input type="text" class="form-control remarks" id="remarks" name="remarks"
                                value="{{ $transaction->remarks }}" />
                        </td>
                        @can('create_transport')
                            <td>
                                <select style="width: 120px" class="form-control can" name="can" id="can">
                                    <option>{{ $transaction->can }}</option>
                                    <option>RAM Can</option>
                                    <option>Pail Can</option>
                                </select>
                            </td>
                        @endcan
                        <td>
                            <select style="width: 75px" class="form-control cancel" name="cancelled" id="cancel">
                                <option>{{ $transaction->cancelled }}</option>
                                <option>NO</option>
                                <option>YES</option>
                            </select>
                        </td>
                        </tr>
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
