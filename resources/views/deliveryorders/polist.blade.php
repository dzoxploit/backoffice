@extends('deliveryorders.delivery-order');

@section('polist')
<table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
    aria-describedby="user-list-page-info">
    <thead>
        <tr>
        <tr>
            <th>PO ID</th>
            <th>Supplier</th>
            <th>PO Date</th>
            <th>Action</th>
        </tr>
        </tr>
    </thead>
    <tbody>
        @foreach($purchaseOrders as $po)
            <tr>
                <td>{{ str_pad($po->po_id, 4, '0', STR_PAD_LEFT).$po->po_id_format }}
                </td>
                <td>{{ $po->sup_name }}</td>
                <td>{{ $po->date }}</td>
                <td class="text-center">
                    <div class="flex align-items-center">
                        <a type="submit" class="btn btn-info" data-placement="top" data-toggle="tooltip" title=""
                            data-original-title="Edit"
                            href="{{ url('/deliveryorders/new/?po_id='.$po->po_id) }}">Buat
                            DO</a>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="row justify-content-between mt-3">
    {{ $purchaseOrders->links() }}
</div>
@endsection
