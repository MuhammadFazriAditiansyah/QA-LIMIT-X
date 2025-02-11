<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Analisa Kimia {{$futami->nodokumen}}</title>
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
            <td>
                <table width="100%">
                    <tr>
                        <td rowspan="4" colspan="3" align="center">
                            <img id="logoImage" src="{{ asset('assets/img/futami_bg_excel.png') }}" alt="Logo" style="width:4cm;">                        </td>
                        <td colspan="5" align="center" style="font-weight:bold;">PT FUTAMI FOOD BEVERAGES</td>
                        <td colspan="2">Document No. </td>
                        <td colspan="2">FFB/FRM/QA/18/17</td>
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
                        <td colspan="5" align="center" style="font-weight:bold;">LAPORAN ANALISA KIMIA</td>
                        <td colspan="2">Page</td>
                        <td colspan="2">1 of 1</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td colspan="2" style="border-style:hidden;">No. Dokumen</td>
                        <td align="center" style="border-style:hidden;">:</td>
                        <td colspan="3" style="border-top-style:hidden; border-right-style:hidden;">{{ $futami->nodokumen }}</td>
                        <td style="border-style:hidden;"></td>
                        <td colspan="2" style="border-style:hidden;">Tanggal Terima Sampel</td>
                        <td align="center" style="border-style:hidden;">:</td>
                        <td colspan="2" style="border-top-style:hidden; border-right-style:hidden;">
                            {{ Carbon\Carbon::parse($futami->tanggal_terima)->translatedFormat('d-m-Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-style:hidden;">Pemberi Sampel</td>
                        <td align="center" style="border-style:hidden;">:</td>
                        <td colspan="3" style="border-right-style:hidden;">{{$futami->pemberi_sampel}}</td>
                        <td style="border-style:hidden;"></td>
                        <td colspan="2" style="border-style:hidden;">Jumlah Sampel</td>
                        <td align="center" style="border-style:hidden;">:</td>
                        <td colspan="2" style="border-right-style:hidden;">{{ $futami->jumlah_sampel }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-style:hidden;">Parameter Pengujian</td>
                        <td align="center" style="border-style:hidden;">:</td>
                        <td colspan="3" style="border-right-style:hidden;">{{ $futami->parameter_pengujian }}</td>
                        <td style="border-style:hidden;"></td>
                        <td colspan="2" style="border-style:hidden;">Tanggal Uji</td>
                        <td align="center" style="border-style:hidden;">:</td>
                        <td colspan="2" style="border-right-style:hidden;">
                            {{ Carbon\Carbon::parse($futami->tanggal_uji)->translatedFormat('d-m-Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="border-style:hidden;"></td>
                        <td colspan="2" style="border-style:hidden;"></td>
                        <td style="border-right-style:hidden; border-bottom-style:hidden;"></td>
                        <td colspan="3" style="border-style:hidden;"></td>
                        <td colspan="2" style="border-style:hidden;">Tgl Selesai uji</td>
                        <td align="center" style="border-style:hidden;">:</td>
                        <td colspan="2" style="border-right-style:hidden;">
                            {{ Carbon\Carbon::parse($futami->tanggal_selesai)->translatedFormat('d-m-Y') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr align="center" style="font-weight:bold;">
                        <td rowspan="2">No</td>
                        <td rowspan="2" colspan="3">Sampel</td>
                        <td colspan="4">Parameter dan Nilai Uji</td>
                        <td colspan="2" rowspan="2">Spesifikasi</td>
                        <td colspan="2" rowspan="2">Keterangan</td>
                    </tr>
                    <tr align="center" style="font-weight:bold;">
                        <td>{{ $futami->parameter_pengujian }}</td>
                        <td>{{ $futami->parameter_pengujian_c2 }}</td>
                        <td>{{ $futami->parameter_pengujian_c3 }}</td>
                        <td>{{ $futami->parameter_pengujian_c4 }}</td>
                    </tr>
                    @foreach ($futami_sampel_kimia as $sampel)
                        <tr align='center'>
                            <td>{{ $loop->iteration }}</td>
                            <td colspan="3">{{$sampel->sampel}}</td>
                            <td>{{ $sampel->parameter_nilaiuji }}</td>
                            <td>{{ $sampel->parameter_nilaiuji_c2 }}</td>
                            <td>{{ $sampel->parameter_nilaiuji_c3 }}</td>
                            <td>{{ $sampel->parameter_nilaiuji_c4 }}</td>
                            <td colspan="2">{{ $sampel->spesifikasi}}</td>
                            <td colspan="2">{{ $sampel->keterangan}}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>

    </table>


    <div class="export-excel" style="padding:10px; float:right;">
        <a href="/operator/analisakimia/exportExcel/{{ $futami->id }}" onclick="hideLogoImage()">Export</a>
    </div>
</body>
</html>



