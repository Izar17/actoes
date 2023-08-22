@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.transaction.order_title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.drsis.update', [$ida]) }}" enctype="multipart/form-data"
                autocomplete="off">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.drsis.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hospital_id">{{ trans('cruds.transaction.fields.hospital') }}</label>

                            @foreach ($productions as $hosp => $production)
                            @endforeach
                            <input type="text" class="form-control hospital"
                                value="{{ $production->hospital->hospital ?? '' }}" readonly />

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user">{{ trans('cruds.transaction.fields.user') }}</label>
                            <input type="text" class="form-control user" value="{{ old('email', auth()->user()->name) }}"
                                name="performed_by" readonly />
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-Production">
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
                                    {{ trans('cruds.transaction.fields.patient') }}
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
                                <th class="col-md-1">
                                    {{ trans('cruds.transaction.fields.dr') }}
                                </th>
                                <th class="col-md-1">
                                    {{ trans('cruds.transaction.fields.si') }}
                                </th>
                                <th class="col-md-1">
                                    {{ trans('cruds.transaction.fields.price') }}
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
                                        {{ $production->orderform_no ?? '' }}
                                    </td>
                                    <td>
                                        {{ $production->rx_no ?? '' }}
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
                                        {{ $production->patient ?? '' }}
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
                                                <img src="{{ asset('img/warning.png') }}" style="width:30px;height:30px;"
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
                                        <input type="hidden" name="hospital" value="{{ $production->hospital_id}}"/>
                                        <input type="hidden" class="form-control dr_no" name="item[{{ $key }}]"
                                            style="width:50px;" value="{{ $production->id }}" />
                                        <input type="text" class="form-control dr_no" name="dr_no[{{ $key }}]"
                                            style="width:100px;" value="{{ $production->dr_no }}" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control invoice_no" 
                                            name="invoice_no[{{ $key }}]" style="width:100px;"
                                            value="{{ $production->invoice_no }}" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control price" id="price" name="price[{{ $key }}]"
                                            style="width:100px;" value="{{ $production->price }}" required />
                                    </td>
                                </tr>
                            @endforeach
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
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('team_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.transactions.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan
            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [0, 'desc']
                ],
                pageLength: 100,
                columnDefs: [{
                    orderable: true,
                    className: '',
                    targets: 0
                }]
            });
            $('.datatable-Production:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endsection
