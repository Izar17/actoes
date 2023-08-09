@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hospital.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hospitals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.id') }}
                        </th>
                        <td>
                            {{ $hospital->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.name') }}
                        </th>
                        <td>
                            {{ $hospital->hospital }}
                        </td>
                    </tr>
                        <th>
                            {{ trans('cruds.hospital.fields.address') }}
                        </th>
                        <td>
                            {{ $hospital->address ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.license_no') }}
                        </th>
                        <td>
                            {{ $hospital->license_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.expiry') }}
                        </th>
                        <td>
                            {{ $hospital->expiry ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.rhso') }}
                        </th>
                        <td>
                            {{ $hospital->rhso ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.rep') }}
                        </th>
                        <td>
                            {{ $hospital->rep ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.created_by') }}
                        </th>
                        <td>
                            {{ $hospital->created_by ?? '' }}
                        </td> 
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.date') }}
                        </th>
                        <td>
                            {{ $hospital->date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.contact_no') }}
                        </th>
                        <td>
                            {{ $hospital->contact_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.airline') }}
                        </th>
                        <td>
                            {{ $hospital->airline ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.airline_etd') }}
                        </th>
                        <td>
                            {{ $hospital->airline_etd ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.airline_eta') }}
                        </th>
                        <td>
                            {{ $hospital->airline_eta ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.vessel') }}
                        </th>
                        <td>
                            {{ $hospital->vessel ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.vessel_etd') }}
                        </th>
                        <td>
                            {{ $hospital->vessel_etd ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.vessel_eta') }}
                        </th>
                        <td>
                            {{ $hospital->vessel_eta ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.stowage') }}
                        </th>
                        <td>
                            {{ $hospital->stowage ?? '' }}
                        </td>
                    </tr>
                    </th>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.rigging') }}
                        </th>
                        <td>
                            {{ $hospital->rigging ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.placards') }}
                        </th>
                        <td>
                            {{ $hospital->placards ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.vehicle') }}
                        </th>
                        <td>
                            {{ $hospital->vehicle ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.vehicle_plate') }}
                        </th>
                        <td>
                            {{ $hospital->vehicle_plate ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.vehicle_etd') }}
                        </th>
                        <td>
                            {{ $hospital->vehicle_etd ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.vehicle_eta') }}
                        </th>
                        <td>
                            {{ $hospital->vehicle_eta ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.forwarder') }}
                        </th>
                        <td>
                            {{ $hospital->forwarder ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.forwarder_plate') }}
                        </th>
                        <td>
                            {{ $hospital->forwarder_plate ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.forwarder_etd') }}
                        </th>
                        <td>
                            {{ $hospital->forwarder_etd ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hospital.fields.forwarder_eta') }}
                        </th>
                        <td>
                            {{ $hospital->forwarder_eta ?? '' }}
                        </td> 
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hospitals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection