<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
    <title>laporan Analisa Mikrobiologi Bahan Baku {{ $mikrobiologi_bahan_baku->nodokumen }}</title>
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

        td.left-col {
            padding-left: 10px;
        }
    </style>
</head>
<body>
    <table cellpadding="3" style="border:solid; width:100%;">
        {{-- table kop surat --}}
        <table width="98%" style="border:solid; margin:10px auto;">
            <tr>
                <td rowspan="4" colspan="" align="center">
                    {{-- logo futami  --}}
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/futami bg.png'))) }}" style="width: 4cm; ">
                </td>
                <td colspan="" align="center">PT FUTAMI FOOD & BEVERAGES</td>
                <td colspan="" align="left">Document No.</td>
                <td colspan="" align="left">:</td>
                <td colspan="" align="left" style="border-left-style:hidden;">FFB/FRM/QA/18/07</td>
            </tr>
            <tr>
                <td colspan="" rowspan="2" align="center" style="border-bottom-style:hidden;">FORMULIR</td>
                <td colspan="" align="left">Issued Date</td>
                <td colspan="" align="left">:</td>
                <td colspan="" align="left" style="border-left-style:hidden;">18/05/2022</td>
            </tr>
            <tr>
                <td colspan="" align="left">Revission No.</td>
                <td colspan="" align="left">:</td>
                <td colspan="" align="left" style="border-left-style:hidden;">000</td>
            </tr>
            <tr>
                <td colspan="" align="center">LAPORAN ANALISA MIKROBIOLOGI <br> BAHAN BAKU</td>
                <td colspan="" align="left">Page</td>
                <td colspan="" align="left">:</td>
                <td colspan="" align="left" style="border-left-style:hidden;">1 of 1</td>
            </tr>
        </table>

        <table class="table-none" style="border-style:hidden; margin-left:10%;">
            <tr style="border-style:none;">
                <td style="border-style:none;">No. Dokumen</td>
                <td style="border-style:none;"> : {{ $mikrobiologi_bahan_baku->nodokumen }}</td>
            </tr>
            <tr>
                <td style="border-style:none;">Tanggal Inokulasi</td>
                <td style="border-style:none;"> :
                    {{ Carbon\carbon::parse($mikrobiologi_bahan_baku->tgl_inokulasi)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td style="border-style:none;">Tanggal Pengamatan</td>
                <td style="border-style:none;"> :
                    {{-- {{ Carbon\Carbon::parse($mikrobiologi_bahan_baku->tgl_pengamatan)->translatedFormat('d F Y') }}</td> --}}
                    {{ $mikrobiologi_bahan_baku->tgl_pengamatan }}</td>
            </tr>
        </table>


        <table class="table" border="0" width="95%" cellpadding="0" cellspacing="0"
            style="margin:10px auto;  border:solid;">
            <tr style="">
                <td rowspan="0" align="center">No</td>
                <td rowspan="0" align="center">Nama Bahan Baku</td>
                <td colspan="0" align="center">TPC ({{ $mikrobiologi_bahan_baku->satuan_tpc }})</td>
                <td rowspan="0" align="center">Yeast & Mold ({{ $mikrobiologi_bahan_baku->satuan_yeast_mold }})</td>
                <td rowspan="0" align="center">Coliform ({{ $mikrobiologi_bahan_baku->satuan_coliform }})</td>
                <td rowspan="0" align="center">Keterangan</td>
            </tr>
            @foreach ($sampel_mikrobiologi_bahan_baku as $bahan_baku)
                <tr align="center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $bahan_baku->nama_bahan_baku }}</td>
                    <td>{{ $bahan_baku->tpc }}</td>
                    <td>{{ $bahan_baku->yeast_mold }}</td>
                    <td>{{ $bahan_baku->coliform }}</td>
                    <td>{{ $bahan_baku->keterangan }}</td>
                </tr>
            @endforeach
        </table>

        <table border="0" width="auto" cellpadding="0" cellspacing="0"
            style="margin:10px auto; margin-left:auto; border:solid; margin-top:10%; align:center;">
            <tr align="center" style="">
                <td style="border-top-style:hidden; border-left-style:hidden;"></td>
                <td style="border-left:solid; width:35mm;">Dibuat oleh</td>
                <td style="width:35mm;">Diperiksa oleh</td>
                <td style="width:35mm;">Disetujui oleh</td>
            </tr>
            <tr align="center">
                <td class="left-col" style="border-top:solid; height:12mm; width:18mm;" cellpadding="5">Tanda tangan</td>
                <td cellpadding="5">
                    @if ($mikrobiologi_bahan_baku['statusOP'] == 0)
                        Belum ditandatangani
                    @elseif($mikrobiologi_bahan_baku['statusOP'] == 1)
                        <img src="data:image/png;base64, {!! base64_encode(
                            QrCode::format('png')->size(40)->generate($mikrobiologi_bahan_baku->user_id_OP . '_' . $mikrobiologi_bahan_baku->name_id_OP),
                        ) !!}" alt="">
                    @endif
                </td>
                <td>
                    @if ($mikrobiologi_bahan_baku['statusST'] == 0)
                        Belum ditandatangani
                    @elseif($mikrobiologi_bahan_baku['statusST'] == 1)
                        <img src="data:image/png;base64, {!! base64_encode(
                            QrCode::format('png')->size(40)->generate($mikrobiologi_bahan_baku->user_id_ST . '_' . $mikrobiologi_bahan_baku->name_id_ST),
                        ) !!}" alt="">
                    @elseif ($mikrobiologi_bahan_baku['statusST'] == 2)
                        Ditolak
                    @endif
                </td>
                <td>
                    @if ($mikrobiologi_bahan_baku['statusSP'] == 0)
                        Belum ditandatangani
                    @elseif($mikrobiologi_bahan_baku['statusSP'] == 1)
                        <img src="data:image/png;base64, {!! base64_encode(
                            QrCode::format('png')->size(40)->generate($mikrobiologi_bahan_baku->user_id_SP . '_' . $mikrobiologi_bahan_baku->name_id_SP),
                        ) !!}" alt="">
                    @endif
                </td>
            </tr>
            <tr align="center">
                <td colspan="" align="center" style="height:6mm;">Jabatan</td>
                <td colspan="" align="center">QA Lab. Technician</td>
                <td colspan="" align="center">QA Staff</td>
                <td colspan="" align="center">QA Supervisor</td>
            </tr>
            <tr align="center">
                <td colspan="" align="center" style="height:6mm;">Nama</td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_bahan_baku->name_id_OP == null)
                        Belum dibaca
                    @elseif($mikrobiologi_bahan_baku->name_id_OP)
                        {{ $mikrobiologi_bahan_baku->name_id_OP }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_bahan_baku->statusST == 2)
                        Ditolak
                    @elseif($mikrobiologi_bahan_baku->name_id_ST == null)
                        Belum dibaca
                    @elseif($mikrobiologi_bahan_baku->name_id_ST)
                        {{ $mikrobiologi_bahan_baku->name_id_ST }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_bahan_baku->name_id_SP == null)
                        Belum dibaca
                    @elseif($mikrobiologi_bahan_baku->name_id_SP)
                        {{ $mikrobiologi_bahan_baku->name_id_SP }}
                    @endif
                </td>
            </tr>
            <tr align="center">
                <td colspan="" align="center" style="height:6mm;">Tanggal</td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_bahan_baku->created_at_OP == null)
                        Data kosong
                    @else
                        {{ Carbon\Carbon::parse($mikrobiologi_bahan_baku->created_at_OP)->translatedFormat('d F Y') }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_bahan_baku->statusST == 2)
                        Ditolak
                    @elseif ($mikrobiologi_bahan_baku->created_at_ST == null)
                        Data kosong
                    @elseif ($mikrobiologi_bahan_baku->statusST == 1)
                        {{ Carbon\Carbon::parse($mikrobiologi_bahan_baku->created_at_ST)->translatedFormat('d F Y') }}
                    @endif
                </td>
                <td colspan="" align="center">
                    @if ($mikrobiologi_bahan_baku->created_at_SP == null)
                        Data kosong
                    @else
                        {{ Carbon\Carbon::parse($mikrobiologi_bahan_baku->created_at_SP)->translatedFormat('d F Y') }}
                    @endif
                </td>
            </tr>
        </table>
    </table>


</body>

</html>
