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
                        <input class="form-control {{ $errors->has('hospital') ? 'is-invalid' : '' }}" type="text" name="hospital" id="hospital" value="{{ old('name', $hospital->hospital) }}" readonly>
                        @if($errors->has('hospital'))
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
                        <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ $hospital->address }}" readonly>
                        @if($errors->has('address'))
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
                        <input class="form-control {{ $errors->has('expiry') ? 'is-invalid' : '' }}" type="date" name="expiry" id="expiry" value="{{ $hospital->expiry }}" required>
                        @if($errors->has('expiry'))
                            <div class="invalid-feedback">
                                {{ $errors->first('expiry') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.hospital.fields.expiry_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="required" for="license_no">{{ trans('cruds.hospital.fields.license_no') }}</label>
                        <input class="form-control {{ $errors->has('license_no') ? 'is-invalid' : '' }}" type="text" name="license_no" id="license_no" value="{{ $hospital->license_no }}" required>
                        @if($errors->has('license_no'))
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
                        <input class="form-control {{ $errors->has('rhso') ? 'is-invalid' : '' }}" type="text" name="rhso" id="rhso" value="{{ $hospital->rhso }}" required>
                        @if($errors->has('rhso'))
                            <div class="invalid-feedback">
                                {{ $errors->first('rhso') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.hospital.fields.rhso_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="required" for="contact_no">{{ trans('cruds.hospital.fields.contact_no') }}</label>
                        <input class="form-control {{ $errors->has('contact_no') ? 'is-invalid' : '' }}" type="text" name="contact_no" id="contact_no" value="{{ $hospital->contact_no }}" required>
                        @if($errors->has('contact_no'))
                            <div class="invalid-feedback">
                                {{ $errors->first('contact_no') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.hospital.fields.contact_no_helper') }}</span>
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