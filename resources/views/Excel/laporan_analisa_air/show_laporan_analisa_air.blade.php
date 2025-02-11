<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Analisa Air {{$laporan_analisa_air->nodokumen}}</title>
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
<body style="padding:60px;">
    {{-- table sarang --}}
    <table class="table-border" border="0" width="100%" style="border:solid;">
        <tr>
            <td style="border-bottom-style:hidden;">
                {{-- width ketengah manual --}}
                <table width="98%" style="margin:10px;">
                    <tr>
                        <td rowspan="4" colspan="3" align="center">
                            <img id="logoImage" src="{{ asset('assets/img/futami_bg_excel.png') }}" alt="Logo" style="width:4cm;"></td>
                        <td colspan="5" align="center" style="font-weight:bold;">PT FUTAMI FOOD BEVERAGES</td>
                        <td colspan="2">Document No. </td>
                        <td colspan="2">FFB/FRM/QA/18/15</td>
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
                        <td colspan="5" align="center" style="font-weight:bold;">LAPORAN ANALISA AIR</td>
                        <td colspan="2">Page</td>
                        <td colspan="2">1 of 1</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="95%" style="margin: 10px 30px 10px 30px;">
                    <tr>
                        <td colspan="2" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">Nomor</td>
                        <td align="center" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">:</td>
                        <td colspan="9" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">{{ $laporan_analisa_air->nodokumen }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">Tanggal Sampling</td>
                        <td align="center" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">:</td>
                        <td colspan="9" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">
                            {{ Carbon\carbon::parse($laporan_analisa_air->tgl_sampling)->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-top-style: hidden;">
                <table width="98%" style="margin: 10px;">
                    <tr style="">
                        <td align="center" colspan="2" style="font-weight: bold;">No</td>
                        <td align="center" colspan="2" style="font-weight: bold;">Sampel</td>
                        <td align="center" colspan="2" style="font-weight: bold;">Pengujian</td>
                        <td align="center" colspan="2" style="font-weight: bold;">Shift 1</td>
                        <td align="center" colspan="2" style="font-weight: bold;">Shift 2</td>
                        <td align="center" colspan="2" style="font-weight: bold;">keterangan</td>
                    </tr>
                    @foreach ($sampel_null as $sampel)
                        <tr>
                            <td align="center" colspan="2">{{ $loop->iteration }}</td>
                            <td align="center" colspan="2">{{ $sampel->sampel }}</td>
                            <td align="center" colspan="2">
                                <table style="height: 10%; width:100%;">
                                    @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                        @if ($pengujian->sampel_id == $sampel->id)
                                            <tr style="height:20px; border-style:none;">
                                                <td align="center" style="height:20px;">{{ $pengujian->pengujian }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </td>
                            <td align="center" colspan="2">
                                <table style="height: 10%; width:100%;">
                                    @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                        @if ($pengujian->sampel_id == $sampel->id)
                                            <tr style="height:20px; border-style:none;">
                                                <td align="center" style="height:20px;">{{ $pengujian->shift_1 }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </table>
                            </td>
                            <td align="center" colspan="2">
                                <table style="height: 10%; width:100%;">
                                    @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                        @if ($pengujian->sampel_id == $sampel->id)
                                            <tr style="height:20px; border-style:none;">
                                                <td align="center" style="height:20px;">{{ $pengujian->shift_2 }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </table>
                            </td>
                            <td align="center" colspan="2">
                                <table style="height: 10%; width:100%;">
                                    @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                        @if ($pengujian->sampel_id == $sampel->id)
                                            <tr style="height:20px; border-style:none;">
                                                <td align="center" style="height:20px;">{{ $pengujian->keterangan }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </table>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($sampel_laporan_analisa_air as $sampel)
                        <tr>
                            <td align="center" colspan="2">{{ $no=$no+1 }}</td>
                            <td align="center" colspan="2">{{ $sampel->sampel }}</td>
                            <td align="center" colspan="2">
                                <table style="height: 10%; width:100%;">
                                    @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                        @if ($pengujian->sampel_id == $sampel->id)
                                            <tr style="height:20px; border-style:none;">
                                                <td align="center" style="height:20px;">{{ $pengujian->pengujian }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </table>
                            </td>
                            <td align="center" colspan="2">
                                <table style="height: 10%; width:100%;">
                                    @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                        @if ($pengujian->sampel_id == $sampel->id)
                                            <tr style="height:20px; border-style:none;">
                                                <td align="center" style="height:20px;">{{ $pengujian->shift_1 }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </table>
                            </td>
                            <td align="center" colspan="2">
                                <table style="height: 10%; width:100%;">
                                    @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                        @if ($pengujian->sampel_id == $sampel->id)
                                            <tr style="height:20px; border-style:none;">
                                                <td align="center" style="height:20px;">{{ $pengujian->shift_2 }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </table>
                            </td>
                            <td align="center" colspan="2">
                                <table style="height: 10%; width:100%;">
                                    @foreach ($pengujian_laporan_analisa_air as $pengujian)
                                        @if ($pengujian->sampel_id == $sampel->id)
                                            <tr style="height:20px; border-style:none;">
                                                <td align="center" style="height:20px;">{{ $pengujian->keterangan }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </table>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </table>


    <div class="export-excel" style="padding:10px; float:right;">
        <a href="/laporan_analisa_air/exportExcel/{{ $laporan_analisa_air->id }}" onclick="hideLogoImage()">Export</a>
    </div>
</body>
</html>



