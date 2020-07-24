<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
        body {
            padding: 0px;
            margin: 0px;
        }

        ,
        .haha {
            width: 100%;
            border-collapse: collapse;
            padding: 6px;
        }

        .th {
            color: black;
            font-weight: bold;
            padding: 6px;
            border: solid;
            text-align: center;
        }

        .td {
            padding: 6px;
            border: solid;
            text-align: center;
        }

        .round {
            border: 2px solid;
            border-radius: 5px;
            padding: 10px;
            width: 200px;
        }

        .kotak {
            border: solid;
            height: 30px;
            padding: 5px;
            left: 0px;
            padding: 10px;
            font-size: 12px;
        }

        .td2 {
            height: 30px;
            width: 100px;
            border: solid;

        }

        td,
        th,
        li {
            font-size: 12px;
        }

    </style>
</head>

<body>
    <div style="height: 350px;">
        <table style="width: 100%">
        </table>
        <div style="position: absolute; left: 0px; width: 300px;">
            <table>
                <tr>
                    <td> </td>
                    <td class="round">
                        PT. PUTRA PERDANA SENTOSA<br>KOMPLEK RUKAN GADING BUKIT INDAH
                        BLOK L-16, JL.GADING BUKIT RAYA<br>KELAPA GADING JAKARTA UTARA

                    </td>
                </tr>
                <tr>
                    <td>Bill To : </td>
                    <td class="round">
                        {{ $data_invoice->trans_name }}
                    </td>
                </tr>
                <tr>
                    <td>Ship To : </td>
                    <td class="round">
                    {{ $data_invoice->trans_address}}, {{$data_invoice->kab_nama}} , {{ $data_invoice->propinsi_nama }} , {{ $data_invoice->trans_zipcode }}
                    </td>
                </tr>
            </table>
        </div>
        <div style="position: absolute; right: 0px; width: 300px;">
            <h1 style="text-align: left; margin: 1px"><b>Surat Pesanan Bussiness To Customer</b></h1>
            <table style="border: 2px solid; border-radius: 5px;">
                <tr>
                    <td style="border-right-style: solid;">Invoice Date <br>
                        {{ date_format($tanggal_sekarang, 'd M yy') }}</td>
                    <td>Invoice No. <br> {{ $data_invoice->trans_invoice }}</td>
                </tr>
            </table>
        </div>
    </div>
    </div>
    <table class="haha" style="width: 100%">
        <thead>
            <tr>
                <th class="th">No</th>
                <th class="th">Sku</th>
                <th class="th">Name Product</th>
                <th class="th">Qty</th>
                <th class="th">Unit Price</th>
                <th class="th">Weight</th>
                <th class="th">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detail_invoice as $pcd)
                <tr>
                    <td class="td" style="border-left-style: solid;">{{ $pcd->no }}</td>
                    <td class="td">{{ $pcd->prod_sku }}</td>
                    <td class="td">{{ $pcd->prod_name }}</td>
                    <td class="td">{{ $pcd->detail_quantity }}</td>
                    <td class="td">
                        {{ "Rp " . number_format($pcd->unit_price,2,',','.') }}
                    </td>
                    <td class="td">{{ $pcd->weight }}</td>
                    <td class="td">
                        {{ "Rp " . number_format($pcd->ammount,2,',','.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <br>
    <div>
        <div style="position: absolute; left: 0px; width: 500px;">
            <div class="round" style="width: 300px;">
            Note:  {{ $data_invoice->trans_note  }}
            </div>
        </div>
        <div style="position: absolute; right: 0px; width: 200px;">
            <table>
                <tr>
                    <td class="td2">Sub Total : </td>
                    <td class="td2"> {{ "Rp " . number_format($data_invoice->trans_subtotal,2,',','.') }}</td>
                </tr>
                {{-- <tr>
                           <td class="td2">Discount : </td>
                           <td class="td2">0</td>
                       </tr> --}}
                <tr>
                    <td class="td2">Freight : </td>
                    <td class="td2">{{ "Rp " . number_format($data_invoice->trans_carrier_price,2,',','.') }}</td>
                </tr>
                <tr>
                    <td class="td2">Total Invoice : </td>
                    <td class="td2">{{ "Rp " . number_format($data_invoice->trans_payment_value,2,',','.') }}</td>
                </tr>
            </table>
            <br>
            <h6>Sign</h6>
            <br><br>
            <hr />
            <div>{{ $data_invoice->trans_name }}</div>
            <div style="font-size: 15px"><b>Customer</b></div>

        </div>


    </div>
</body>

</html>
