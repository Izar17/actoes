@extends('layouts.admin')
@section('content')
@can('hospital_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.hospitals.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.hospital.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.hospital.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Hospital">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.license_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.expiry') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.rhso') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.rep') }}
                        </th>
                        <!-- <th>
                            {{ trans('cruds.hospital.fields.created_by') }}
                        </th> -->
                        <th>
                            {{ trans('cruds.hospital.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.contact_no') }}
                        </th>
                        <!-- <th>
                            {{ trans('cruds.hospital.fields.airline') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.airline_etd') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.airline_eta') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.vessel') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.vessel_etd') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.vessel_eta') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.stowage') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.rigging') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.placards') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.vehicle') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.vehicle_plate') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.vehicle_etd') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.vehicle_eta') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.forwarder') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.forwarder_plate') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.forwarder_etd') }}
                        </th>
                        <th>
                            {{ trans('cruds.hospital.fields.forwarder_eta') }}
                        </th> -->
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hospitals as $key => $hospital)
                        <tr data-entry-id="{{ $hospital->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $hospital->id ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->hospital ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->address ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->license_no ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->expiry ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->rhso ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->rep ?? '' }}
                            </td>
                            <!-- <td>
                                {{ $hospital->created_by ?? '' }}
                            </td> -->
                            <td>
                                {{ $hospital->date ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->contact_no ?? '' }}
                            </td>
                            <!-- <td>
                                {{ $hospital->airline ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->airline_etd ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->airline_eta ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->vessel ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->vessel_etd ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->vessel_eta ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->stowage ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->rigging ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->placards ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->vehicle ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->vehicle_plate ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->vehicle_etd ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->vehicle_eta ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->forwarder ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->forwarder_plate ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->forwarder_etd ?? '' }}
                            </td>
                            <td>
                                {{ $hospital->forwarder_eta ?? '' }}
                            </td> -->

                            <td>
                                @can('hospital_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.hospitals.show', $hospital->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('hospital_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.hospitals.edit', $hospital->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('hospital_delete')
                                    <form action="{{ route('admin.hospitals.destroy', $hospital->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('hospital_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hospitals.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  $('.datatable-Hospital:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
