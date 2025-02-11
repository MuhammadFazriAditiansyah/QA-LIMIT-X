<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mikrobiologi Proses Produksi</title>
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
                        <td colspan="2">FFB/FRM/QA/18/05</td>
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
                        <td colspan="5" align="center" style="font-weight:bold;">LAPORAN ANALISA MIKROBIOLOGI PROSES PRODUKSI</td>
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
                        <td colspan="9">{{ $mikrobiologi_proses_produksi->nodokumen }}</td>
                    </tr>
                    <tr style="border-style: hidden;">
                        <td colspan="2">Tgl Inokulasi</td>
                        <td align="center" style="border-style: hidden;">:</td>
                        <td colspan="9">
                            {{ Carbon\Carbon::parse($mikrobiologi_proses_produksi->tgl_inokulasi)->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                    <tr style="border-style:hidden;">
                        <td colspan="2">Tgl pengamatan</td>
                        <td align="center" style="border-style: hidden;">:</td>
                        <td colspan="9">{{ $mikrobiologi_proses_produksi->tgl_pengamatan }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-top-style: hidden;">
                <table width="98%" style="margin: 10px;">
                    <tr>
                        <td align="center">No.</td>
                        <td colspan="3" align="center">Sampel</td>
                        <td align="center" colspan="2">TPC({{ $mikrobiologi_proses_produksi->satuan_tpc }})</td>
                        <td align="center" colspan="2">Yeast Mold ({{ $mikrobiologi_proses_produksi->satuan_yeast_mold }})</td>
                        <td align="center" colspan="2">Coliform({{ $mikrobiologi_proses_produksi->satuan_coliform }})</td>
                        <td colspan="2" align="center">Keterangan</td>
                    </tr>
                    @foreach ($sampel_mikrobiologi_proses_produksi as $proses_produksi)
                        <tr>
                            <td align="center">{{$loop->iteration}}</td>
                            <td colspan="3" align="center">{{ $proses_produksi->sampel }}</td>
                            <td align="center" colspan="2">{{ $proses_produksi->tpc }}</td>
                            <td align="center" colspan="2">{{ $proses_produksi->yeast_mold }}</td>
                            <td align="center" colspan="2">{{ $proses_produksi->coliform }}</td>
                            <td colspan="2" align="center" style="max-width:250px;">{{ $proses_produksi->keterangan }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>

    </table>


    <div class="export-excel" style="padding:10px; float:right;">
        <a href="/mikrobiologi_proses_produksi/exportExcel/{{ $mikrobiologi_proses_produksi->id }}" onclick="hideLogoImage()">Export</a>
    </div>
</body>
</html>



