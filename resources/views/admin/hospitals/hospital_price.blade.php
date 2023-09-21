@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.hospital.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.hospitals.update', 1) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="table-responsive">
                    <table id="dataTable" class=" table table-bordered table-striped table-hover datatable datatable-Stock">
                        <thead>
                            <tr>
                                <th>
                                    Product ID
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
                            @foreach ($hospitalProducts as $key => $product)
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
                                        View, Edit Inprogress
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

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
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
