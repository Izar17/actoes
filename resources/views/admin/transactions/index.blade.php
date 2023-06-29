@extends('layouts.admin')
@section('content')
@can('stock_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12 mt-2">
       <a class="btn btn-success" href="{{ route("admin.transactions.create") }}">
            {{ trans('global.add') }} {{ trans('cruds.transaction.title_singular') }}
        </a>
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transaction.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Transaction">
                <thead>
                    <tr>
                        <th>
                            Created at
                        </th>
                        <th>
                            {{ trans('cruds.transaction.fields.asset') }}
                        </th>
                        <th>
                            {{ trans('cruds.transaction.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.transaction.fields.stock') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $key => $transaction)
                        <tr data-entry-id="{{ $transaction->id }}">
                            <td>
                                {{ $transaction->created_at}}
                            </td>
                            <td>
                                {{ $transaction->asset->name ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->stock ?? '' }}
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 0, 'desc' ]],
    pageLength: 100,
      columnDefs: [{
          orderable: true,
          className: '',
          targets: 0
      }]
  });
  $('.datatable-Transaction:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
