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
                        {{ $salesInvoice->bill_to }}
                    </td>
                </tr>
                <tr>
                    <td>Ship To : </td>
                    <td class="round">
                        {{ $salesInvoice->ship_to }}
                    </td>
                </tr>
            </table>
        </div>
        <div style="position: absolute; right: 0px; width: 300px;">
            <h1 style="text-align: left; margin: 1px"><b>Sales Invoice</b></h1>
            <table style="border: 2px solid; border-radius: 5px;">
                <tr>
                    <td style="border-right-style: solid;">Invoice Date <br>
                        {{ date_format($salesInvoice->created_at, 'd M yy') }}</td>
                    <td>Invoice No. <br> PPS-DM/0320/0055</td>
                </tr>
                <tr>
                    <td style="border-top-style: solid; border-right-style: solid;">Terms <br> Net
                        {{ $salesInvoice->terms }}</td>
                    <td style="border-top-style: solid;">003-20.21893002</td>
                </tr>
                <tr>
                    <td style="border-top-style: solid; border-right-style: solid;">Ship Via <br>
                        {{ ucfirst($salesInvoice->ship_via) }} (Ekspedisi)</td>
                    <td style="border-top-style: solid;">Ship Date <br>
                        {{ date('d M yy', strtotime($salesInvoice->ship_date)) }}</td>
                </tr>
                <tr>
                    <td style="border-top-style: solid; border-right-style: solid;">PO. No. <br>
                        {{ str_pad($salesInvoice->po_id, 4, '0', STR_PAD_LEFT).$salesInvoice->po_id_format }}
                    </td>
                    <td style="border-top-style: solid;">Currency <br> IDR</td>
                </tr>
            </table>
        </div>
    </div>
    </div>
    <table class="haha" style="width: 100%">
        <thead>
            <tr>
                <th class="th">Item</th>
                <th class="th">Item Description</th>
                <th class="th">Qty</th>
                <th class="th">Unit Price</th>
                <th class="th">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($poCustomerDetail as $pcd)
                <tr>
                    <td class="td" style="border-left-style: solid;">{{ $pcd->product_id }}</td>
                    <td class="td">{{ $pcd->product_name }}</td>
                    <td class="td">{{ $pcd->qty }}</td>
                    <td class="td">
                        {{ "Rp " . number_format($pcd->unit_price,2,',','.') }}
                    </td>
                    <td class="td">
                        {{ "Rp " . number_format($pcd->unit_price*$pcd->qty,2,',','.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <br>
    <div>
        <div style="position: absolute; left: 0px; width: 500px;">
            <div class="kotak" style="width: 300px;">
                {{ $salesInvoice->spell }}
            </div>
            <br>
            <div class="round" style="width: 300px;">
                {{ $salesInvoice->notes ?? '' }}
            </div>
        </div>
        <div style="position: absolute; right: 0px; width: 200px;">
            <table>
                <tr>
                    <td class="td2">Sub Total : </td>
                    <td class="td2">{{ $totalPrice['subTotalPrice'] }}</td>
                </tr>
                {{-- <tr>
                           <td class="td2">Discount : </td>
                           <td class="td2">0</td>
                       </tr> --}}
                <tr>
                    <td class="td2">PPN : </td>
                    <td class="td2">{{ $totalPrice['ppn'] }}</td>
                </tr>
                <tr>
                    <td class="td2">Freight : </td>
                    <td class="td2">{{ $totalPrice['freight'] }}</td>
                </tr>
                <tr>
                    <td class="td2">Total Invoice : </td>
                    <td class="td2">{{ $totalPrice['invoiceTotal'] }}</td>
                </tr>
            </table>
            <br>
            <h6>Sign</h6>
            <br><br>
            <hr />
            <div>{{ session('fullname') }}</div>
            <div style="font-size: 15px"><b>Finance & Accounting</b></div>

        </div>


    </div>
</body>

</html>
