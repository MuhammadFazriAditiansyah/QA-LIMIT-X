<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Analisa Mikrobiologi Bahan Kemas {{$mikrobiologi_bahan_kemas->nodokumen}}</title>
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
                            <img id="logoImage" src="{{ asset('assets/img/futami_bg_excel.png') }}" alt="Logo" style="width:4cm;"></td>
                        <td colspan="5" align="center" style="font-weight:bold;">PT FUTAMI FOOD BEVERAGES</td>
                        <td colspan="2">Document No. </td>
                        <td colspan="2">FFB/FRM/QA/18/08</td>
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
                        <td colspan="5" align="center" style="font-weight:bold;">LAPORAN ANALISA MIKROBIOLOGI BAHAN KEMAS</td>
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
                        <td colspan="9">{{ $mikrobiologi_bahan_kemas->nodokumen }}</td>
                    </tr>
                    <tr style="border-style: hidden;">
                        <td colspan="2">Tgl Inokulasi</td>
                        <td align="center" style="border-style: hidden;">:</td>
                        <td colspan="9">
                            {{ Carbon\Carbon::parse($mikrobiologi_bahan_kemas->tgl_inokulasi)->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                    <tr style="border-style:hidden;">
                        <td colspan="2">Tgl pengamatan</td>
                        <td align="center" style="border-style: hidden;">:</td>
                        <td colspan="9">{{ $mikrobiologi_bahan_kemas->tgl_pengamatan }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-top-style: hidden;">
                <table width="98%" style="margin: 10px;">
                    <tr>
                        <td align="center">No.</td>
                        <td colspan="2" align="center">Nama Bahan Kemas</td>
                        <td colspan="2" align="center">TPC ({{ $mikrobiologi_bahan_kemas->satuan_tpc }})</td>
                        <td colspan="2" align="center">Yeast Mold ({{ $mikrobiologi_bahan_kemas->satuan_yeast_mold }})</td>
                        <td colspan="2" align="center">Coliform ({{ $mikrobiologi_bahan_kemas->satuan_coliform }})</td>
                        <td colspan="3" align="center">Keterangan</td>
                    </tr>
                    @foreach ($sampel_mikrobiologi_bahan_kemas as $bahan_kemas)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td colspan="2" align="center">{{ $bahan_kemas->nama_bahan_kemas }}</td>
                            <td colspan="2" align="center">{{ $bahan_kemas->tpc }}</td>
                            <td colspan="2" align="center">{{ $bahan_kemas->yeast_mold }}</td>
                            <td colspan="2" align="center">{{ $bahan_kemas->coliform }}</td>
                            <td colspan="3" align="center">{{ $bahan_kemas->keterangan }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>

    </table>


    <div class="export-excel" style="padding: 10px; float: right; background-color: rgb(0, 213, 0); margin-top: 10px; border-radius: 5px;">
        <a href="/mikrobiologi_bahan_kemas/exportExcel/{{ $mikrobiologi_bahan_kemas->id }}" onclick="hideLogoImage()" style="color: rgb(255, 255, 255); text-decoration: none;">Export</a>
    </div>
</body>
</html>



