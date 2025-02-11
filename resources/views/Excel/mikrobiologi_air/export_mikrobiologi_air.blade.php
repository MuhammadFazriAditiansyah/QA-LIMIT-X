<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Analisa Mikrobiologi Air </title>
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
                        <td colspan="2">FFB/FRM/QA/18/03</td>
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
                        <td colspan="5" align="center" style="font-weight:bold;">LAPORAN ANALISA MIKROBIOLOGI AIR</td>
                        <td colspan="2">Page</td>
                        <td colspan="2">1 of 1</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" style="margin: 10px;">
                    <tr style="border-style: hidden;">
                        <td colspan="2">No. </td>
                        <td align="center" style="border-style: hidden;">:</td>
                        <td colspan="7">{{ $mikrobiologi_airs->nodokumen }}</td> <!-- Mengurangi colspan di sini -->
                    </tr>
                    <tr style="border-style: hidden;">
                        <td colspan="2">Tgl Inokulasi</td>
                        <td align="center" style="border-style: hidden;">:</td>
                        <td colspan="7">
                            {{ Carbon\Carbon::parse($mikrobiologi_airs->tgl_inokulasi)->translatedFormat('d M Y') }}
                        </td>
                    </tr>
                    <tr style="border-style: hidden;">
                        <td colspan="2">Tgl Pengamatan</td>
                        <td align="center" style="border-style: hidden;">:</td>
                        <td colspan="7">{{ $mikrobiologi_airs->tgl_pengamatan }}</td> <!-- Mengurangi colspan di sini -->
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-top-style: hidden;">
                <table width="98%" style="margin: 10px;">
                    <tr>
                        <td align="center">No.</td>
                        <td colspan="3" align="center">Sampel air</td>
                        <td align="center" colspan="2">TPC({{ $mikrobiologi_airs->satuan_tpc }})</td>
                        <td align="center" colspan="2">Yeast Mold ({{ $mikrobiologi_airs->satuan_yeast_mold }})</td>
                        <td align="center" colspan="2">Coliform({{ $mikrobiologi_airs->satuan_coliform }})</td>
                        <td colspan="2" align="center">Keterangan</td>
                    </tr>
                    @foreach ($sampel_mikrobiologi_airs as $sampel_mikrobiologi_air)
                        <tr>
                            <td align="center">{{$loop->iteration}}</td>
                            <td colspan="3" align="center">{{ $sampel_mikrobiologi_air->sampel_air }}</td>
                            <td align="center" colspan="2">{{ $sampel_mikrobiologi_air->tpc }}</td>
                            <td align="center" colspan="2">{{ $sampel_mikrobiologi_air->yeast_mold }}</td>
                            <td align="center" colspan="2">{{ $sampel_mikrobiologi_air->coliform }}</td>
                            <td colspan="2" align="center" style="max-width:250px;">{{ $sampel_mikrobiologi_air->keterangan }}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>

    </table>


    <div class="export-excel" style="padding:10px; float:right;">
        <a href="/mikrobiologi_air/exportExcel/{{ $mikrobiologi_airs->id }}" onclick="hideLogoImage()">Export</a>
    </div>
</body>
</html>



