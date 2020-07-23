@extends('sales.invoice.invoices');

@section('polist')
<table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
    aria-describedby="user-list-page-info">
    <thead>
        <tr>
        <tr>
            <th>PO ID</th>
            <th>Customer PO</th>
            <th>Nomor Penawaran</th>
            <th>Customer</th>
            <th>Discount</th>
            <th>Tgl Entri</th>
            <th>Action</th>
        </tr>
        </tr>
    </thead>
    <tbody>
        @foreach($salesPo as $sp)
            <tr>
                <td>{{ str_pad($sp->po_id, 4, '0', STR_PAD_LEFT).$sp->po_id_format }}</td>
                <td>{{ $sp->po_num }}</td>
                <td>{{ $sp->bargain_id }}</td>
                <td>{{ $sp->fullname }}</td>
                <td>{{ $sp->po_discount.$sp->po_discount_type }}</td>
                <td>{{ $sp->created_at }}</td>
                <td class="text-center">
                    <div class="flex align-items-center">
                        <a type="submit" class="btn btn-info" data-placement="top" data-toggle="tooltip" title=""
                            data-original-title="Edit"
                            href="{{ url('/sales/invoices/new/?po_id='.$sp->po_id) }}">Buat Invoice</a>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
@endsection
