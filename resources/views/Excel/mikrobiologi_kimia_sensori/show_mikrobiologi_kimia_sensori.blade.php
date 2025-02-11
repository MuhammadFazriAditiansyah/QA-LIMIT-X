<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemeriksaan Kimia Sensori {{$mikrobiologi_kimia_sensori->nodokumen}}</title>
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
                        <td colspan="3">Document No. </td>
                        <td colspan="3">FFB/FRM/QA/18/27</td>
                    </tr>
                    <tr>
                        <td colspan="5" rowspan="2" align="center" style="font-weight:bold;">FORMULIR</td>
                        <td colspan="3">Issued Date</td>
                        <td colspan="3">18/05/2022</td>
                    </tr>
                    <tr>
                        <td colspan="3">Revission No.</td>
                        <td colspan="3">000</td>
                    </tr>
                    <tr>
                        <td colspan="5" align="center" style="font-weight:bold;">PEMERIKSAAN KIMIA SENSORI</td>
                        <td colspan="3">Page</td>
                        <td colspan="3">1 of 1</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="95%" style="margin: 10px 30px 10px 30px;">
                    <tr>
                        <td colspan="3" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">Nomor</td>
                        <td align="center" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">:</td>
                        <td colspan="3" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">{{ $mikrobiologi_kimia_sensori->nodokumen }}</td>
                        <td style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;"></td>
                        <td colspan="3" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">Nama Produk</td>
                        <td align="center" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">:</td>
                        <td colspan="2" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">{{ $mikrobiologi_kimia_sensori->nama_produk }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">Tanggal Produksi</td>
                        <td align="center" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">:</td>
                        <td colspan="3" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">
                            {{ Carbon\carbon::parse($mikrobiologi_kimia_sensori->tgl_produksi)->translatedFormat('d F Y') }}
                        </td>
                        <td style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;"></td>
                        <td colspan="3" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">Jumlah Batch</td>
                        <td align="center" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">:</td>
                        <td colspan="2" style="border-top-style:hidden; border-right-style:hidden; border-bottom-style:hidden; border-left-style:hidden;">{{ $mikrobiologi_kimia_sensori->jumlah_batch }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-top-style: hidden;">
                <table width="98%" style="margin: 10px;">
                    <tr>
                        <td align="center">No</td>
                        <td align="center">Kode Sampling</td>
                        <td align="center">Waktu</td>
                        <td align="center">Exp Date</td>

                        <td align="center">
                            {{ $mikrobiologi_kimia_sensori->parameter_c1 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c1 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c1 }})</sup>
                            @endif
                        </td>
                        <td align="center">
                            {{ $mikrobiologi_kimia_sensori->parameter_c2 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c2 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c2 }})</sup>
                            @endif
                        </td>
                        <td align="center">
                            {{ $mikrobiologi_kimia_sensori->parameter_c3 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c3 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c3 }})</sup>
                            @endif
                        </td>
                        <td align="center">
                            {{ $mikrobiologi_kimia_sensori->parameter_c4 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c4 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c4 }})</sup>
                            @endif
                        </td>
                        <td align="center">
                            {{ $mikrobiologi_kimia_sensori->parameter_c5 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c5 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c5 }})</sup>
                            @endif
                        </td>
                        <td align="center">
                            {{ $mikrobiologi_kimia_sensori->parameter_c6 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c6 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c6 }})</sup>
                            @endif
                        </td>
                        <td align="center">
                            {{ $mikrobiologi_kimia_sensori->parameter_c7 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c7 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c7 }})</sup>
                            @endif
                        </td>
                        <td align="center">
                            {{ $mikrobiologi_kimia_sensori->parameter_c8 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c8 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c8 }})</sup>
                            @endif
                        </td>
                        <td align="center">
                            {{ $mikrobiologi_kimia_sensori->parameter_c9 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c9 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c9 }})</sup>
                            @endif
                        </td>
                        <td align="center">
                            {{ $mikrobiologi_kimia_sensori->parameter_c10 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c10 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c10 }})</sup>
                            @endif
                        </td>
                    </tr>
                    @foreach ($sampel_mikrobiologi_kimia_sensori as $kimia_sensori)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td align="center">{{ $kimia_sensori->kode_sampling }}</td>
                            <td align="center">{{ Carbon\carbon::parse($kimia_sensori->waktu)->translatedFormat('h:i') }}</td>
                            <td align="center">{{ Carbon\carbon::parse($kimia_sensori->exp_date)->translatedFormat('d F Y') }}</td>
                            <td align="center">{{ $kimia_sensori->parameter_c1 }}</td>
                            <td align="center">{{ $kimia_sensori->parameter_c2 }}</td>
                            <td align="center">{{ $kimia_sensori->parameter_c3 }}</td>
                            <td align="center">{{ $kimia_sensori->parameter_c4 }}</td>
                            <td align="center">{{ $kimia_sensori->parameter_c5 }}</td>
                            <td align="center">{{ $kimia_sensori->parameter_c6 }}</td>
                            <td align="center">{{ $kimia_sensori->parameter_c7 }}</td>
                            <td align="center">{{ $kimia_sensori->parameter_c8 }}</td>
                            <td align="center">{{ $kimia_sensori->parameter_c9 }}</td>
                            <td align="center">{{ $kimia_sensori->parameter_c10 }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="14">Keterangan: {{ $mikrobiologi_kimia_sensori->keterangan }}</td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>


    <div class="export-excel" style="padding:10px; float:right;">
        <a href="/mikrobiologi_kimia_sensori/exportExcel/{{ $mikrobiologi_kimia_sensori->id }}" onclick="hideLogoImage()">Export</a>
    </div>
</body>
</html>



