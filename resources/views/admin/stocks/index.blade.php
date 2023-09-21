@extends('layouts.admin')
@section('content')
@can('product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12 mt-2">
           <a class="btn btn-success" href="#">
                Create Product Work in progress
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
        {{ trans('cruds.stock.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class=" table table-bordered table-striped table-hover datatable datatable-Stock">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Product Name
                        </th>
                        <th>
                            Quantity
                        </th>
                        <th>
                            Unit
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                        <tr>
                            <td>
                                {{ $product->id ?? '' }}
                            </td>
                            <td>
                                {{ $product->product_name ?? '' }}
                            </td>
                            <td>
                                {{ $product->qty ?? '' }}
                            </td>
                            <td>
                                {{ $product->unit ?? '' }}
                            </td>
                            <td>
                                {{ $product->price ?? '' }}
                            </td>
                            <td>
                                Work in progress
                                {{-- @can('product_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.stocks.show', $product->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('product_edit')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.stocks.edit', $product->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('isotope_delete')
                                    <form action="{{ route('admin.stocks.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan --}}
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
    //Datatables
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            searching: true,
            order: [
                [0, 'asc']
            ],
            pageLength: 25,
            columnDefs: [{
                orderable: true,
                className: '',
                targets: 0
            }]
        });

    });
</script>
@endsection
