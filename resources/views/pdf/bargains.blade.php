<!DOCTYPE html>
<html lang="en">

<head>

</head>
<style type="text/css">
    body {
        margin: 0px;
        padding: 0px;
    }

    .tgl {
        position: absolute;
        right: 0px;
        top: 100px;
        width: 30%;
    }

    .haha {
        width: 100%;
        border-collapse: collapse;
        padding: 6px;


    }

    .th {
        font-weight: bold;
        padding: 6px;
        text-align: center;

    }

    .td {
        color: black;
        font-weight: bold;
        padding: 6px;
        border: solid;
        text-align: center;
        height: 20px;

    }

    img {
        height: 150px;
        width: 100%;
    }

</style>

<body>
    <section>
        <img src="{{ asset('/assets/images/dmheader.png') }}">
    </section>
    <div style="height: 200px;">
        <div>
            <table>
                <tr>
                    <td>No</td>
                    <td>: {{ str_pad($bargain->bargain_id, 4, '0', STR_PAD_LEFT).$bargain->bargain_id_format }}</td>
                </tr>
                <tr>
                    <td>Kepada</td>
                    <td>: {{ $bargain->customer ?? '' }}</td>
                </tr>
                {{-- <tr>
                    <td>Up</td>
                    <td>: Bapak Willy Rynaldi</td>
                </tr> --}}
                <tr>
                    <td>Lampiran</td>
                    <td>: 1</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>: Penawaran Harga</td>
                </tr>
            </table>
            <p>Dengan Hormat, <br> Bersama ini kami sampaikan penawaran harga, dengan perincian terlampir :</p>
            <div class="tgl">
                Jakarta, 03 Maret 2020
            </div>
        </div>
    </div>
    <div>
        <table class="haha">
            <thead>
                <tr>
                    <th class="th" style="border-left-style: solid; border-top-style: solid;" rowspan="2">NO</th>
                    <th class="th"
                        style="border-left-style: solid; border-top-style: solid; border-bottom-style: solid;"
                        rowspan="2">Description</th>
                    <th class="th" colspan="2" style="border: solid;">Volume</th>
                    <th class="th" colspan="2" rowspan="2" style="border: solid;">Price</th>
                    <th class="th" colspan="2" rowspan="2" style="border: solid;">Total</th>
                </tr>
                <tr>
                    <th class="th" style="border-left-style: solid; border-bottom-style: solid;">QTY</th>
                    <th class="th" style="border-left-style: solid; border-bottom-style: solid;">Satuan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach($detailBargain as $dbar)
                    <tr>
                        <td class="td">{{ ++$i }}</td>
                        <td class="td">{{ $dbar->product_name }}</td>
                        <td class="td">{{ $dbar->qty }}</td>
                        <td class="td">Pcs</td>
                        <td class="td" colspan="2">
                            {{ "Rp " . number_format($dbar->unit_price,2,',','.') }}
                        </td>
                        <td class="td" colspan="2">
                            {{ "Rp " . number_format($dbar->unit_price*$dbar->qty,2,',','.') }}
                        </td>
                    </tr>
                @endforeach
                <!-- bagian yang total jangan diapa-apain lagi! -->
                <tr>
                    <td class="td" rowspan="3"></td>
                    <td class="td" rowspan="3"></td>
                    <td class="td" colspan="4">Sub Total</td>
                    <td class="td" colspan="2">
                        {{ "Rp " . number_format($subTotal,2,',','.') }}
                    </td>
                </tr>
                <tr>
                    @php
                        if ($bargain->discount_type == '%') {
                        $bargainDiscount = $bargain->discount.$bargain->discount_type;
                        }elseif ($bargain->discount_type == '$') {
                        $bargainDiscount = "Rp " . number_format($bargain->discount,2,',','.');
                        }
                    @endphp
                    <td class="td" colspan="4">Discount</td>
                    <td class="td" colspan="2">{{ $bargainDiscount ?? '' }}</td>
                </tr>
                <tr>
                    @php
                        if ($bargain->discount_type == '%') {
                        $discount = $subTotal * $bargain->discount/100;
                        $totalHarga = $subTotal - $discount;
                        }elseif ($bargain->discount_type == '$') {
                        $totalHarga = $subTotal - $bargain->discount;
                        }else {
                        $totalHarga = $subTotal;
                        }
                    @endphp
                    <td class="td" colspan="4">Grand Total</td>
                    <td class="td" colspan="2">
                        {{ "Rp " . number_format($totalHarga,2,',','.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <div>
        <div>
            *harga belum termasuk PPN
            <br>
            <br>
            <div style="width: 300px;">
                Note : <ul>
                    {{ $bargain->bargain_note ?? '' }}
                    <br>
                    <br>
                    <div style="position: absolute; right: 0px; width: 500px; padding: 10px;">
                        <p>Hormat Kami</p><br><br>
                        <p>{{ session('fullname') }}<br>Dunia Murah</p>
                    </div>
            </div>
        </div>
    </div>

    </div>
</body>

</html>
