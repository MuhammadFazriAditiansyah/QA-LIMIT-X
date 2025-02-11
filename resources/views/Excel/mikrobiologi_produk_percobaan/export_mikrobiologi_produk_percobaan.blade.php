<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mikrobiologi Produk Percobaan</title>
    <style>
        @page {
            margin-left: 0.1in;
            margin-right: 0.1in;
            margin-top: 0.1in;
            margin-bottom: 0.1in;
        }

        body {
            margin-left: 0.1in;
            margin-right: 0.1in;
            margin-top: 0.1in;
            margin-bottom: 0.1in;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-border{
            border: 3px solid black;
            border-collapse: collapse;
        }


    </style>
</head>
<body style="padding:40px;">
    {{-- table sarang --}}
    <table class="table-border" border="0" width="100%"  cellpadding="0" cellspacing="0" style="border:solid;">
        <tr>
            <td style="border-bottom-style:hidden;">
                {{-- width ketengah manual --}}
                <table width="98%" style="margin:10px;">
                    <tr>
                        <td rowspan="4" colspan="3" align="center">
                            {{-- <img id="logoImage" src="{{ asset('assets/img/futami_bg_excel.png') }}" alt="Logo" style="width:4cm;"></td> --}}
                        <td colspan="5" align="center" style="font-weight:bold;">PT FUTAMI FOOD BEVERAGES</td>
                        <td colspan="2">Document No. </td>
                        <td colspan="2">FFB/FRM/QA/18/06</td>
                    </tr>
                    <tr>
                        <td colspan="5" rowspan="2" align="center" style="font-weight:bold;">FORMULIR</td>
                        <td colspan="2">Issued Date</td>
                        <td colspan="2">18/05/2022</td>
                    </tr>
                    <tr>
                        <td colspan="2">Revission No.</td>
                        <td colspan="2">000</td>
                    </tr>
                    <tr>
                        <td colspan="5" align="center" style="font-weight:bold;">LAPORAN ANALISA MIKROBIOLOGI PRODUK PERCOBAN</td>
                        <td colspan="2">Page</td>
                        <td colspan="2">1 of 1</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" style="margin: 10px 30px 10px 30px;">
                    <tr style="border-style:hidden;">
                        <td colspan="2">No. </td>
                        <td align="center" style="border-style: hidden;">:</td>
                        <td colspan="9">{{ $mikrobiologi_produk_percobaan->nodokumen }}</td>
                    </tr>
                    <tr style="border-style: hidden;">
                        <td colspan="2">Tgl Inokulasi</td>
                        <td align="center" style="border-style: hidden;">:</td>
                        <td colspan="9">
                            {{ Carbon\Carbon::parse($mikrobiologi_produk_percobaan->tgl_inokulasi)->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                    <tr style="border-style:hidden;">
                        <td colspan="2">Tgl pengamatan</td>
                        <td align="center" style="border-style: hidden;">:</td>
                        <td colspan="9">{{ $mikrobiologi_produk_percobaan->tgl_pengamatan }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-top-style: hidden;">
                <table width="98%" style="margin: 10px;">
                    <tr>
                        <td align="center">No.</td>
                        <td colspan="2" align="center">Kode Sampling</td>
                        <td align="center">Jam pada EXP Date</td>
                        <td colspan="2" align="center">TPC ({{ $mikrobiologi_produk_percobaan->satuan_tpc }})</td>
                        <td colspan="2" align="center">Yeast Mold ({{ $mikrobiologi_produk_percobaan->satuan_yeast_mold }})</td>
                        <td colspan="2" align="center">Coliform ({{ $mikrobiologi_produk_percobaan->satuan_coliform }})</td>
                        <td colspan="2" align="center">Keterangan</td>
                    </tr>
                    @foreach ($sampel_mikrobiologi_produk_percobaan as $produk_percobaan)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td colspan="2" align="center">{{ $produk_percobaan->kode_sampling }}</td>
                            <td align="center">{{ Carbon\carbon::parse($produk_percobaan->exp_date)->translatedFormat('h:i') }}</td>
                            <td colspan="2" align="center">{{ $produk_percobaan->tpc }}</td>
                            <td colspan="2" align="center">{{ $produk_percobaan->yeast_mold }}</td>
                            <td colspan="2" align="center">{{ $produk_percobaan->coliform }}</td>
                            <td colspan="2" align="center">{{ $produk_percobaan->keterangan }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>

    </table>


    <div class="export-excel" style="padding:10px; float:right;">
        <a href="/mikrobiologi_produk_percobaan/exportExcel/{{ $mikrobiologi_produk_percobaan->id }}" onclick="hideLogoImage()">Export</a>
    </div>
</body>
</html>



