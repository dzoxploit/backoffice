<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style type="text/css">
    body {
        font-size: 9px;
    }

</style>
<style>
    .alamat {
        width: 300px;
        font-size: 11px !important;
    }

    .judulsurat {
        margin: 40px;
        width: 150px;
        text-align: center;
        font-size: 14px;
    }

    .judulsurat .top {
        border-bottom: 1px solid;
    }

    .seksi-untuk {
        font-size: 11px;
    }

    .atas-kiri {
        float: left;
    }

    .container {
        overflow: hidden;
        position: relative;
        border: 1px solid;
    }


    .header {
        overflow: hidden;
        width: 100%;
        display: inline-block
    }

    .doc-title {
        float: right;
        padding: 23px;
    }

    .logo-dm {
        width: 180px;
    }

    .centered {
        margin: 0 auto;
    }

    .rightaligned {
        margin-right: 0;
        margin-left: auto;
    }

    .leftaligned {
        margin-left: 0;
        margin-right: auto;
    }


    .kanan-atas .child {
        border: 1px solid;
        width: 240px;
        padding: 5px;
    }

</style>

<body>
    <div class="container">
        <table style="width: 100%">
            <tr>
                <td>
                    <img class="logo-dm"
                        src="{{ asset('/assets/images/pdf/purchaseorder-logodm.png') }}"
                        alt="">
                </td>
                <td style="padding: 10px">
                    <p style="text-align: right; font-weight: bold; font-size: 14px;">PT PUTRA PERDANA SENTOSA</p>
                </td>
            </tr>
        </table>
        <table class="alamat">
            <tr>
                <td>Office</td>
                <td>: Rukan Gading Bukit Indah Blok L No.16</td>
            </tr>
            <tr>
                <td>Telp</td>
                <td>: 021 - 24525877 (Hunting)</td>
            </tr>
            <tr>
                <td>Fax</td>
                <td>: 021 - 24525875</td>
            </tr>
        </table>
        <table style="width: 100%" border="1">
            <tr>
                <td>
                    <div class="judulsurat">
                        <div class="top">
                            <b>PURCHASE ORDER</b>
                        </div>
                        <div class="bottom">
                            <b>SURAT PESANAN</b>
                        </div>
                    </div>
                </td>
                <td>
                    <style>
                        .atas-kanan {
                            border: 1px solid;
                            padding: 5px;
                            width: 190px;
                        }

                        .atas-kanan, .po-header{
                            width: 190px;
                        }

                    </style>
                    <div class="atas-kanan rightaligned">Order Number must appear in all invoice shippingpapers</div>
                    <div class="atas-kanan rightaligned">No Po Harap disebutkan pada setiap invoice</div>
                    <div class="po-header rightaligned" style="">
                        <table>
                            <tr>
                                <td>No. PO</td>
                                <td>PO/PPS-DM/VI/2020/0186</td>
                            </tr>
                            <tr>
                                <td>Date Po</td>
                                <td>12-juli-2020</td>
                            </tr>
                            <tr>
                                <td>Contact Person</td>
                                <td>Dini</td>
                            </tr>
                            <tr>
                                <td>Request</td>
                                <td>0</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>







        <div class="header">
            <div class="logo-dm">

            </div>
            <div class="doc-title">

            </div>
        </div>
        <div class="bagian-atas" style="overflow: auto;">
            <!-- Data bagian atas -->
            <div class="atas-kiri">


                <table class="seksi-untuk">
                    <tr>
                        <td style="text-decoration: underline">To</td>
                        <td>: CV. Mumtazi Sharia</td>
                    </tr>
                    <tr>
                        <td>Kepada</td>
                        <td>&nbsp; Bp Fajar</td>
                    </tr>
                </table>
            </div>

            <!-- Data PO -->
            <div class="atas-kanan">

            </div>
            <br>
            <style>
                .product-list {
                    margin-top: 30px;
                }

            </style>
            <style>
                .table-product {
                    width: 100%;
                    font-size: 11px;
                    padding: 6px;
                    border-collapse: collapse;
                }

            </style>
        </div>
        <div style="margin-top: 20px">
            <u>Please supply the following items in accordance with the terms and condition expressed here in</u>
            <br>
            Harap kirimkan barang-barang menurut persyaratan dan kondisi tersebut dibawah ini
        </div>
        <!-- Tabel dkk -->
        <div class="product-list">
            <table class="table-product" border="1">
                <thead>
                    <tr>
                        <th><u>Item No</u><br>No Brg</th>
                        <th><u>Qty</u><br>Jumlah</th>
                        <th><u>Unit</u><br>Stn</th>
                        <th colspan="2"><u>Description</u><br>Penjelasan</th>
                        <th><u>Unit Price</u><br>Harga Satuan</th>
                        <th colspan="2"><u>Total</u><br>Jumalah Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01</td>
                        <td>12</td>
                        <td>Btl</td>
                        <td colspan="2">Hand Sanitizer @500 Mi</td>
                        <td>36.000</td>
                        <td colspan="2">420.000</td>
                    </tr>
                    <tr>
                        <td>02</td>
                        <td>12</td>
                        <td>Btl</td>
                        <td colspan="2">Hand Sanitizer @1Liter</td>
                        <td>35.000</td>
                        <td colspan="2">420.000</td>
                    </tr>
                    <!-- Ini sengaja cuy dikosongin, jgn diapa2in. -->
                    <tr>
                        <td colspan="5" style="border-bottom: solid 1px #fff; border-left: solid 1px #fff"></td>
                        <td style="font-weight: bold; padding: 5px">Grant Total</td>
                        <td colspan="2">1.420.000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Note dkk -->
        <style>
            .bagian-bawah {
                position: relative;
                margin-top: 40px;
            }

            .seksi-note {
                font-size: 11px;
                float: left;
            }

        </style>
        <div class="bagian-bawah">
            <table class="seksi-note">
                <tr>
                    <td style="text-decoration: underline">Note</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Catatan</td>
                    <td>: Transfer Via BCaspdfj</td>
                </tr>
                <tr>
                    <td style="text-decoration: underline">Delivery date</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tanggal Penyerahan</td>
                    <td>: Dikirim</td>
                </tr>
                <tr>
                    <td style="text-decoration: underline">Term Of Payment</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Syarat Pembayaran</td>
                    <td>: Cash</td>
                </tr>
                <tr style="padding-top: 10px;">
                    <td style="text-decoration: underline">Point of Delivery</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tempat Penyerahan</td>
                    <td>: 0</td>
                </tr>
            </table>
        </div>
        <div class="atas-kanan">
            <div class="child" style="border-bottom: 0px ">Order Number must appear in all invoice shipping papers</div>
            <div class="child">No Po Harap disebutkan pada setiap invoice</div>
        </div>
    </div>
</body>

</html>
