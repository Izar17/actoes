@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.hospital.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.hospitals.update', [$hospital->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.hospital.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('hospital') ? 'is-invalid' : '' }}" type="text"
                                name="hospital" id="hospital" value="{{ $hospital->hospital ?? '' }}" required>
                            @if ($errors->has('hospital'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hospital') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.name_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.hospital.fields.address') }}</label>
                            <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text"
                                name="address" id="address" value="{{ $hospital->address ?? '' }}" required>
                            @if ($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.address_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="expiry">{{ trans('cruds.hospital.fields.expiry') }}</label>
                            <input class="form-control {{ $errors->has('expiry') ? 'is-invalid' : '' }}" type="date"
                                name="expiry" id="expiry" value="{{ $hospital->expiry ?? '' }}" required>
                            @if ($errors->has('expiry'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('expiry') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.expiry_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="license_no">{{ trans('cruds.hospital.fields.license_no') }}</label>
                            <input class="form-control {{ $errors->has('license_no') ? 'is-invalid' : '' }}" type="text"
                                name="license_no" id="license_no" value="{{ $hospital->license_no ?? '' }}" required>
                            @if ($errors->has('license_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('license_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.license_no_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="rhso">{{ trans('cruds.hospital.fields.rhso') }}</label>
                            <input class="form-control {{ $errors->has('rhso') ? 'is-invalid' : '' }}" type="text"
                                name="rhso" id="rhso" value="{{ $hospital->rhso ?? '' }}" required>
                            @if ($errors->has('rhso'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rhso') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.rhso_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="contact_no">{{ trans('cruds.hospital.fields.contact_no') }}</label>
                            <input class="form-control {{ $errors->has('contact_no') ? 'is-invalid' : '' }}" type="text"
                                name="contact_no" id="contact_no" value="{{ $hospital->contact_no ?? '' }}" required>
                            @if ($errors->has('contact_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.contact_no_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="rep">{{ trans('cruds.hospital.fields.rep') }}</label>
                            <input class="form-control {{ $errors->has('rep') ? 'is-invalid' : '' }}" type="text"
                                name="rep" id="rep" value="{{ $hospital->rep ?? '' }}" required>
                            @if ($errors->has('rep'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rep') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.rep_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="update_by">Update By</label>
                            <input class="form-control {{ $errors->has('created_by') ? 'is-invalid' : '' }}" type="text"
                                name="created_by" value="{{ old('email', auth()->user()->email) }}" id="created_by"
                                readonly>
                            @if ($errors->has('created_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('created_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.created_by_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.hospital.fields.date') }}</label>
                            <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text"
                                name="date" id="date" value="{{ now()->format('Y-m-d') }}" readonly>
                            @if ($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.date_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="airline">{{ trans('cruds.hospital.fields.airline') }}</label>
                            <input class="form-control {{ $errors->has('airline') ? 'is-invalid' : '' }}" type="text"
                                name="airline" id="airline" value="{{ $hospital->airline ?? '' }}" required>
                            @if ($errors->has('airline'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('airline') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.airline_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="airline_etd">{{ trans('cruds.hospital.fields.airline_etd') }}</label>
                            <input class="form-control {{ $errors->has('airline_etd') ? 'is-invalid' : '' }}"
                                type="text" name="airline_etd" id="airline_etd" value="{{ $hospital->airline_etd ?? '' }}" required>
                            @if ($errors->has('airline_etd'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('airline_etd') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.airline_etd_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="airline_eta">{{ trans('cruds.hospital.fields.airline_eta') }}</label>
                            <input class="form-control {{ $errors->has('airline_eta') ? 'is-invalid' : '' }}"
                                type="text" name="airline_eta" id="airline_eta" value="{{ $hospital->airline_eta ?? '' }}" required>
                            @if ($errors->has('airline_eta'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('airline_eta') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.airline_eta_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="vessel">{{ trans('cruds.hospital.fields.vessel') }}</label>
                            <input class="form-control {{ $errors->has('vessel') ? 'is-invalid' : '' }}" type="text"
                                name="vessel" id="vessel" value="{{ $hospital->vessel ?? '' }}" required>
                            @if ($errors->has('vessel'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vessel') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.vessel_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="vessel_etd">{{ trans('cruds.hospital.fields.vessel_etd') }}</label>
                            <input class="form-control {{ $errors->has('vessel_etd') ? 'is-invalid' : '' }}"
                                type="text" name="vessel_etd" id="vessel_etd" value="{{ $hospital->vessel_etd ?? '' }}" required>
                            @if ($errors->has('vessel_etd'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vessel_etd') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.vessel_etd_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="vessel_eta">{{ trans('cruds.hospital.fields.vessel_eta') }}</label>
                            <input class="form-control {{ $errors->has('vessel_eta') ? 'is-invalid' : '' }}"
                                type="text" name="vessel_eta" id="vessel_eta" value="{{ $hospital->vessel_eta ?? '' }}" required>
                            @if ($errors->has('vessel_eta'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vessel_eta') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.vessel_eta_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="stowage">{{ trans('cruds.hospital.fields.stowage') }}</label>
                            <input class="form-control {{ $errors->has('stowage') ? 'is-invalid' : '' }}" type="text"
                                name="stowage" id="stowage" value="{{ $hospital->stowage ?? '' }}" required>
                            @if ($errors->has('stowage'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('stowage') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.stowage_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="rigging">{{ trans('cruds.hospital.fields.rigging') }}</label>
                            <input class="form-control {{ $errors->has('rigging') ? 'is-invalid' : '' }}" type="text"
                                name="rigging" id="rigging" value="{{ $hospital->rigging ?? '' }}" required>
                            @if ($errors->has('rigging'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rigging') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.rigging_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="placards">{{ trans('cruds.hospital.fields.placards') }}</label>
                            <input class="form-control {{ $errors->has('placards') ? 'is-invalid' : '' }}" type="text"
                                name="placards" id="placards" value="{{ $hospital->placards ?? '' }}" required>
                            @if ($errors->has('placards'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('placards') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.placards_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="vehicle">{{ trans('cruds.hospital.fields.vehicle') }}</label>
                            <input class="form-control {{ $errors->has('vehicle') ? 'is-invalid' : '' }}" type="text"
                                name="vehicle" id="vehicle" value="{{ $hospital->vehicle ?? '' }}" required>
                            @if ($errors->has('vehicle'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vehicle') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.vehicle_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="vehicle_plate">{{ trans('cruds.hospital.fields.vehicle_plate') }}</label>
                            <input class="form-control {{ $errors->has('vehicle_plate') ? 'is-invalid' : '' }}"
                                type="text" name="vehicle_plate" id="vehicle_plate" value="{{ $hospital->vehicle_plate ?? '' }}" required>
                            @if ($errors->has('vehicle_plate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vehicle_plate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.vehicle_plate_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="vehicle_etd">{{ trans('cruds.hospital.fields.vehicle_etd') }}</label>
                            <input class="form-control {{ $errors->has('vehicle_etd') ? 'is-invalid' : '' }}"
                                type="text" name="vehicle_etd" id="vehicle_etd" value="{{ $hospital->vehicle_etd ?? '' }}" required>
                            @if ($errors->has('vehicle_etd'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vehicle_etd') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.vehicle_etd_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="vehicle_eta">{{ trans('cruds.hospital.fields.vehicle_eta') }}</label>
                            <input class="form-control {{ $errors->has('vehicle_eta') ? 'is-invalid' : '' }}"
                                type="text" name="vehicle_eta" id="vehicle_eta" value="{{ $hospital->vehicle_eta ?? '' }}" required>
                            @if ($errors->has('vehicle_eta'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vehicle_eta') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.vehicle_eta_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="forwarder">{{ trans('cruds.hospital.fields.forwarder') }}</label>
                            <input class="form-control {{ $errors->has('forwarder') ? 'is-invalid' : '' }}"
                                type="text" name="forwarder" id="forwarder" value="{{ $hospital->forwarder ?? '' }}" required>
                            @if ($errors->has('forwarder'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('forwarder') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.forwarder_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="forwarder_plate">{{ trans('cruds.hospital.fields.forwarder_plate') }}</label>
                            <input class="form-control {{ $errors->has('forwarder_plate') ? 'is-invalid' : '' }}"
                                type="text" name="forwarder_plate" id="forwarder_plate" value="{{ $hospital->forwarder_plate ?? '' }}" required>
                            @if ($errors->has('forwarder_plate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('forwarder_plate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.forwarder_plate_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="forwarder_etd">{{ trans('cruds.hospital.fields.forwarder_etd') }}</label>
                            <input class="form-control {{ $errors->has('forwarder_etd') ? 'is-invalid' : '' }}"
                                type="text" name="forwarder_etd" id="forwarder_etd" value="{{ $hospital->forwarder_etd ?? '' }}" required>
                            @if ($errors->has('forwarder_etd'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('forwarder_etd') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.forwarder_etd_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required"
                                for="forwarder_eta">{{ trans('cruds.hospital.fields.forwarder_eta') }}</label>
                            <input class="form-control {{ $errors->has('forwarder_eta') ? 'is-invalid' : '' }}"
                                type="text" name="forwarder_eta" id="forwarder_eta" value="{{ $hospital->forwarder_eta ?? '' }}" required>
                            @if ($errors->has('forwarder_eta'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('forwarder_eta') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hospital.fields.forwarder_eta_helper') }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
