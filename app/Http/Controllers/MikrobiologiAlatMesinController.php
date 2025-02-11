<?php

namespace App\Http\Controllers;

use App\Models\Mikrobiologi_alat_mesin;
use Illuminate\Http\Request;
use App\Models\Sampel_mikrobiologi_alat_mesin;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MikrobiologiAlatMesinExport;
use App\Models\ExportedFile;

class MikrobiologiAlatMesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Operator Function
    public function mikrobiologi_alat_mesin(Request $request)
    {
        // $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('delete', 0)->get();

        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('delete', 0);

        if ($request->has('tgl_inokulasi') && $request->has('tgl_pengamatan')) {
            $tgl_inokulasi = Carbon::parse($request->tgl_inokulasi)->toDateTimeString();
            $tgl_pengamatan = Carbon::parse($request->tgl_pengamatan)->toDateTimeString();
            $mikrobiologi_alat_mesin->whereBetween('tgl_inokulasi', [$tgl_inokulasi, $tgl_pengamatan]);
        }

        $mikrobiologi_alat_mesin = $mikrobiologi_alat_mesin->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('mikrobiologi_alat_mesin.operator.mikrobiologi_alat_mesin', compact('mikrobiologi_alat_mesin'))->with('no', ($mikrobiologi_alat_mesin->currentPage() - 1) * $mikrobiologi_alat_mesin->perPage() + 1);

        // return view('mikrobiologi_alat_mesin.operator.mikrobiologi_alat_mesin', compact('mikrobiologi_alat_mesin'))->with('no');
    }

    public function add_mikrobiologi_alat_mesin(Request $request)
    {
        return view('mikrobiologi_alat_mesin.operator.add_mikrobiologi_alat_mesin');
    }

    public function input_mikrobiologi_alat_mesin(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|min:3',
            'tgl_inokulasi' => 'required',
            'tgl_pengamatan' => 'required',
        ],[
            'nama_produk.required' => 'Kolom nama produk harus di isi',
            'tgl_inokulasi.required' => 'Kolom tanggal inokulasi harus di isi',
            'tgl_pengamatan.required' => 'Kolom tanggal pengamatan harus di isi',
        ]);

        $get_now = Carbon::now()->translatedFormat('d-m-y h:i:s');
        $get_tahun = Carbon::now()->translatedFormat('y');
        $get_bulan = Carbon::now()->translatedFormat('m');
        $get_menit = Carbon::now()->translatedFormat('i');

        function numberToRoman($num)
        {
            // Be sure to convert the given parameter into an integer
            $n = intval($num);
            $result = '';

            // Declare a lookup array that we will use to traverse the number:
            $lookup = array(
                'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
                'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
                'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
            );

            foreach ($lookup as $roman => $value)
            {
                // Look for number of matches
                $matches = intval($n / $value);

                // Concatenate characters
                $result .= str_repeat($roman, $matches);

                // Substract that from the number
                $n = $n % $value;
            }

            return $result;
        }

        $get_last_no_dokumen = Mikrobiologi_alat_mesin::latest()->first();

        // if(is_null($get_last_no_dokumen) || $get_last_no_dokumen->created_at->format('y') !== $get_tahun) {
        //     $nodokumen_get_num = 0;
        // } else {
        //     $nodokumen_get_num = (int)explode("/", $get_last_no_dokumen->nodokumen)[0] + 1;
        // }

        if(is_null($get_last_no_dokumen) || $get_last_no_dokumen->created_at->format('y') !== $get_tahun) {
            $get_last_no_dokumen = 0;
        } else {
            $get_last_no_dokumen = $get_last_no_dokumen->nodokumen;
        }

        $nodokumen_get_num = explode("/", $get_last_no_dokumen)[0]+1; //membagi angka dengan axplode
        $nodokumen = $nodokumen_get_num."/LAMS-A/".numberToRoman($get_bulan)."/".$get_tahun;


        // dd($nodokumen);

        //get tahun "sudah"
        //get bulan -> setelah get bulan konversi bulan ke romawi ""sudah
        //get nomor dokumen terakhir dengan cara
        //get nomor dokumen dari database dari record paling terakhir,
        // $get_last_no_dokumen = Futami::latest()->first()->nodokumen;
        //setelah dapat nomor dokumen parsing hanya nomor saja
        //setelah dapat nomornya saja + 1
        //setelah dapat semua formatnya gabung jadi 1 variable nodokumen

        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::create([
            'nodokumen' => $nodokumen,
            'nama_produk' => $request->nama_produk,
            'tgl_inokulasi' => $request->tgl_inokulasi,
            'tgl_pengamatan' => $request->tgl_pengamatan,
            'satuan_tpc' => $request->satuan_tpc,
            'satuan_yeast_mold' => $request->satuan_yeast_mold,
            'satuan_coliform' => $request->satuan_coliform,


            'statusOP' => 0,
            'statusST' => 0,
            'statusSP' => 0,
            'delete' => 0,
        ]);

        // dd($mikrobiologiProdukPercobaan);
        return redirect('/operator/sampel_mikrobiologi_alat_mesin/' .$mikrobiologi_alat_mesin->id)->with('successAdd', 'Berhasil membuat Dokumen Baru!'); //mereturn / lewat / , bukan lewat name yang diberikan
    }

    public function sampel_mikrobiologi_alat_mesin(Request $request, $id)
    {
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::Where('id', $id)->first();

        return view('mikrobiologi_alat_mesin.operator.sampel_mikrobiologi_alat_mesin', compact('id', 'mikrobiologi_alat_mesin'));
    }


    public function input_sampel_mikrobiologi_alat_mesin(Request $request, $id)
    {
        $request->validate([
            'inputSampel' => 'required|array|min:1',

            'inputSampel.*.nama_objek' => 'required',
            'inputSampel.*.jam_sampling' => 'required',
            'inputSampel.*.tpc' => 'required',
            'inputSampel.*.yeast_mold' => 'required',
            'inputSampel.*.coliform' => 'required',
            // 'inputSampel.*.keterangan' => 'required|min:5',
        ],[
            'inputSampel.required' => 'Kolom Kode Sampling harus di isi',
            'inputSampel.array' => 'Kolom Kode Sampling harus berupa array',
            'inputSampel.min' => 'Minimal satu Kode Sampling harus diisi',

            'inputSampel.*.nama_objek.required' => 'Kolom Nama Objek harus di isi',
            'inputSampel.*.jam_sampling.required' => 'Kolom Jam Sampling harus di isi',
            'inputSampel.*.tpc.required' => 'Kolom TPC harus di isi',
            'inputSampel.*.yeast_mold.required' => 'Kolom Yeast & Mold harus di isi',
            'inputSampel.*.coliform.required' => 'Kolom Coliform harus di isi',
            // 'inputSampel.*.keterangan.required' => 'Kolom keterangan harus di isi',
            // 'inputSampel.*.keterangan.min' => 'Kolom keterangan harus memiliki panjang minimal 5 karakter',
        ]);

        foreach($request->inputSampel as $key => $value){
            DB::table('sampel_mikrobiologi_alat_mesins')->insert([
                'nama_objek' => $value['nama_objek'],
                'jam_sampling' => $value['jam_sampling'],
                'tpc' => $value['tpc'],
                'yeast_mold' => $value['yeast_mold'],
                'coliform' => $value['coliform'],
                'keterangan' => $value['keterangan'],
                'id_alat_mesin' => $id,
            ]);
        }

        return redirect('/operator/mikrobiologi_alat_mesin')->with('successAddSampel', 'Berhasil membuat Data Mikrobiologi Alat Dan Mesin Baru!');
    }

    public function mikrobiologi_alat_mesin_operatorttd(request $request, $id)
    {
        $request->validate([
            'ttd_operator' => 'required',
        ],[
           'ttd_operator' => 'Kolom TTD harus di isi!',
        ]);
        // $mikrobiologis = Mikrobiologi_produk::all();
        Mikrobiologi_alat_mesin::where('id', $id)->update([
            'statusOP' => 1,
            'user_id_OP' => auth::user()->id,
            'name_id_OP' => auth::user()->nama,
            'created_at_OP' => $request->ttd_operator,
            // 'created_at_OP' => Carbon::now()->format('d F Y'),
        ]);

        return redirect()->route('mikrobiologi_alat_mesin')->with('operatorttd', 'Data telah ditandatangani oleh Operator!');
   }

    public function mikrobiologi_alat_mesin_Destroy($id)
    {
        Mikrobiologi_alat_mesin::findOrFail($id)->delete(); // Soft delete data

        return redirect()->route('mikrobiologi_alat_mesin')->with('successDelete', 'Data berhasil dihapus. Lihat di History untuk mengembalikan.');
    }

    public function mikrobiologi_alat_mesin_history(Request $request)
    {
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::onlyTrashed();

        if ($request->has('tgl_inokulasi') && $request->has('tgl_pengamatan')) {
            $tgl_inokulasi = Carbon::parse($request->tgl_inokulasi)->toDateTimeString();
            $tgl_pengamatan = Carbon::parse($request->tgl_pengamatan)->toDateTimeString();
            $mikrobiologi_alat_mesin->whereBetween('tgl_inokulasi', [$tgl_inokulasi, $tgl_pengamatan]);
        }

        $mikrobiologi_alat_mesin = $mikrobiologi_alat_mesin->orderBy('id', 'asc')->get(); //asc dari awal ke akhir

        return view('mikrobiologi_alat_mesin.operator.history', compact('mikrobiologi_alat_mesin'))->with('no');

    }

    public function mikrobiologi_alat_mesin_restore($id)
    {
        $mikrobiologi = Mikrobiologi_alat_mesin::onlyTrashed()->findOrFail($id); // Cari data yang dihapus
        $mikrobiologi->restore(); // Pulihkan data

        return redirect()->route('mikrobiologi_alat_mesin_history')->with('success', 'Data berhasil dikembalikan.');
    }

    public function mikrobiologi_alat_mesin_delete_permanent($id)
    {
        $mikrobiologi = Mikrobiologi_alat_mesin::onlyTrashed()->find($id); // Cari data yang sudah dihapus (soft delete)
        if ($mikrobiologi) {
            $mikrobiologi->forceDelete(); // Hapus permanen data
            return redirect()->route('mikrobiologi_alat_mesin_history')->with('success', 'Data berhasil dihapus permanen.');
        }
        return redirect()->route('mikrobiologi_alat_mesin_history')->with('failed', 'Data tidak ditemukan.');
    }

    public function mikrobiologi_alat_mesin_sampel(Request $request, $id)
    {
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::Where('id', $id)->first();
        $sampel_mikrobiologi_alat_mesin = Sampel_mikrobiologi_alat_mesin::where('id_alat_mesin', '=', $id)->get();

        return view('mikrobiologi_alat_mesin.operator.dataSampel_mikrobiologi_alat_mesin', compact('mikrobiologi_alat_mesin', 'sampel_mikrobiologi_alat_mesin'))->with('no');
    }

    public function sampel_mikrobiologi_alat_mesin_Destroy(Request $request, $id)
    {
        Sampel_mikrobiologi_alat_mesin::where('id', '=', $id)->delete();
        return redirect()->back()->with('successDelete', 'Berhasil menghapus data mikrobiologi alat dan mesin!');
    }

    public function edit_mikrobiologi_alat_mesin($id)
    {
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::Where('id', $id)->first();
        $sampel_mikrobiologi_alat_mesin = Sampel_mikrobiologi_alat_mesin::where('id_alat_mesin', '=', $id)->get();

        return view('mikrobiologi_alat_mesin.operator.edit_mikrobiologi_alat_mesin', compact('mikrobiologi_alat_mesin', 'sampel_mikrobiologi_alat_mesin'));
    }

    public function update_mikrobiologi_alat_mesin(Request $request, $id)
    {
        //validasi
        $request->validate([
            'nama_produk' => 'required',
            'tgl_inokulasi' => 'required',
            'tgl_pengamatan' => 'required',
        ],[
            'nama_produk.required' => 'Kolom nama produk harus di isi',
            'tgl_inokulasi.required' => 'Kolom tanggal inokulasi harus di isi',
            'tgl_pengamatan.required' => 'Kolom tanggal pengamatan harus di isi',
        ]);
        $validasiData = Mikrobiologi_alat_mesin::where('id', $id)->update([
            'nama_produk' => $request->nama_produk,
            'tgl_inokulasi' => $request->tgl_inokulasi,
            'tgl_pengamatan' => $request->tgl_pengamatan,
            'satuan_tpc' => $request->satuan_tpc,
            'satuan_yeast_mold' => $request->satuan_yeast_mold,
            'satuan_coliform' => $request->satuan_coliform,
        ]);


        //Validasi edit sampel kimia
        $validasiSampel = $request->validate([
            'inputSampel.*.nama_objek' => 'required',
            'inputSampel.*.jam_sampling' => 'required',
            'inputSampel.*.tpc' => 'required',
            'inputSampel.*.yeast_mold' => 'required',
            'inputSampel.*.coliform' => 'required',
        ],[
            'inputSampel.*.nama_objek.required' => 'Kolom Nama Objek harus di isi',
            'inputSampel.*.jam_sampling.required' => 'Kolom Jam Sampling harus di isi',
            'inputSampel.*.tpc.required' => 'Kolom TPC harus di isi',
            'inputSampel.*.yeast_mold.required' => 'Kolom Yeast & Mold harus di isi',
            'inputSampel.*.coliform.required' => 'Kolom Coliform harus di isi',
            // 'inputSampel.*.keterangan.required' => 'Kolom keterangan harus di isi',
            // 'inputSampel.*.keterangan.min' => 'Kolom keterangan harus memiliki panjang minimal 5 karakter',
        ]);

        $sampel_data = [];
        foreach ($request->inputSampel as $input) {
            $sampel = new Sampel_mikrobiologi_alat_mesin();
            $sampel->nama_objek = $input['nama_objek'];
            $sampel->jam_sampling = $input['jam_sampling'];
            $sampel->tpc = $input['tpc'];
            $sampel->yeast_mold = $input['yeast_mold'];
            $sampel->coliform = $input['coliform'];
            $sampel->keterangan = $input['keterangan'];
            $sampel_data[] = $sampel;
        }
        // dd($sampel_data);

        Mikrobiologi_alat_mesin::find($id)->Sampel_mikrobiologi_alat_mesin()->delete();
        Mikrobiologi_alat_mesin::find($id)->Sampel_mikrobiologi_alat_mesin()->saveMany($sampel_data);

        return redirect('/operator/mikrobiologi_alat_mesin')->with('successUpdate','Berhasil mengupdate data Dokumen!');
    }

    public function OP_mikrobiologi_alat_mesin_pdf($id)
    {
        $sampel_mikrobiologi_alat_mesin = Sampel_mikrobiologi_alat_mesin::where('id_alat_mesin', $id)->get();
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.mikrobiologi_alat_mesin_pdf', array('mikrobiologi_alat_mesin' => $mikrobiologi_alat_mesin, 'sampel_mikrobiologi_alat_mesin'=>$sampel_mikrobiologi_alat_mesin))->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream();
        $filename = 'Laporan Analisa Mikrobiologi Alat Dan Mesin ' . $mikrobiologi_alat_mesin->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }



    // excel
    public function mikrobiologi_alat_mesin_excel($id)
    {
        $sampel_mikrobiologi_alat_mesin = Sampel_mikrobiologi_alat_mesin::where('id_alat_mesin', $id)->get();
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('id', $id)->first();

        return view('Excel.mikrobiologi_alat_mesin.show_mikrobiologi_alat_mesin', compact('mikrobiologi_alat_mesin', 'sampel_mikrobiologi_alat_mesin'));
    }
    public function mikrobiologi_alat_mesin_excel_show($id)
    {
        $sampel_mikrobiologi_alat_mesin = Sampel_mikrobiologi_alat_mesin::where('id_alat_mesin', $id)->get();
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('id', $id)->first();

        return view('Excel.mikrobiologi_alat_mesin.show_mikrobiologi_alat_mesin', compact('mikrobiologi_alat_mesin', 'sampel_mikrobiologi_alat_mesin'));
    }
    public function mikrobiologi_alat_mesin_exportExcel($id)
    {
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('id', $id)->first();
        $nodokumen = explode('/', $mikrobiologi_alat_mesin->nodokumen);
        $dokumen = implode('_', $nodokumen);

        $filename = $dokumen . '.xlsx';
        $path = storage_path('app/public/exports/' . $filename);

        // Simpan file ke server
        Excel::store(new MikrobiologiAlatMesinExport($id), 'public/exports/' . $filename);

        // Simpan data ke database
        ExportedFile::create([
            'filename' => $filename,
            'path' => '/storage/exports/' . $filename,
            'type' => 'Mikrobiologi Alat Mesin',
        ]);

        // Download file ke pengguna
        return response()->download($path);
    }












    ///////Function Staff
    public function staff_mikrobiologi_alat_mesin(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('delete', 0);

        if ($request->has('tgl_inokulasi') && $request->has('tgl_pengamatan')) {
            $tgl_inokulasi = Carbon::parse($request->tgl_inokulasi)->toDateTimeString();
            $tgl_pengamatan = Carbon::parse($request->tgl_pengamatan)->toDateTimeString();
            $mikrobiologi_alat_mesin->whereBetween('tgl_inokulasi', [$tgl_inokulasi, $tgl_pengamatan]);
        }

        $mikrobiologi_alat_mesin = $mikrobiologi_alat_mesin->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('mikrobiologi_alat_mesin.staff.mikrobiologi_alat_mesin', compact('mikrobiologi_alat_mesin'))->with('no', ($mikrobiologi_alat_mesin->currentPage() - 1) * $mikrobiologi_alat_mesin->perPage() + 1);

        // return view('mikrobiologi_alat_mesin.staff.mikrobiologi_alat_mesin', compact('mikrobiologi_alat_mesin'))->with('no');
    }

    public function mikrobiologi_alat_mesin_staffttd(Request $request, $id)
    {
        $request->validate([
            'ttd_staff' => 'required',
        ],[
           'ttd_staff' => 'Kolom TTD harus di isi!',
        ]);
        Mikrobiologi_alat_mesin::where('id', $id)->update([
            'statusST' => 1,
            'user_id_ST' => auth::user()->id,
            'name_id_ST' => auth::user()->nama,
            'created_at_ST' => $request->ttd_staff,
            // 'created_at_ST' => Carbon::now()->format('d F Y'),
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang
        ]);
        return redirect()->route('staff_mikrobiologi_alat_mesin')->with('staffttd', 'Data Mikrobiologi Alat Dan Mesin telah ditandatangani oleh Staff!');
    }

    public function mikrobiologi_alat_mesin_declinettd($id)
    {
        Mikrobiologi_alat_mesin::where('id', $id)->update([
            'statusST' => 2,
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang
        ]);
        return redirect()->route('staff_mikrobiologi_alat_mesin')->with('declinettd', 'Data Mikrobiologi Alat Dan Mesin telah ditolak oleh Staff!');
    }


    public function ST_mikrobiologi_alat_mesin_pdf($id)
    {
        $sampel_mikrobiologi_alat_mesin = Sampel_mikrobiologi_alat_mesin::where('id_alat_mesin', $id)->get();
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.mikrobiologi_alat_mesin_pdf', array('mikrobiologi_alat_mesin' => $mikrobiologi_alat_mesin, 'sampel_mikrobiologi_alat_mesin'=>$sampel_mikrobiologi_alat_mesin))->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream();
        $filename = 'Laporan Analisa Mikrobiologi Alat Dan Mesin ' . $mikrobiologi_alat_mesin->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }











     ////Function Supervisor
    public function supervisor_mikrobiologi_alat_mesin(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_produk::all();
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('delete', 0);

        if ($request->has('tgl_inokulasi') && $request->has('tgl_pengamatan')) {
            $tgl_inokulasi = Carbon::parse($request->tgl_inokulasi)->toDateTimeString();
            $tgl_pengamatan = Carbon::parse($request->tgl_pengamatan)->toDateTimeString();
            $mikrobiologi_alat_mesin->whereBetween('tgl_inokulasi', [$tgl_inokulasi, $tgl_pengamatan]);
        }

        $mikrobiologi_alat_mesin = $mikrobiologi_alat_mesin->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('mikrobiologi_alat_mesin.supervisor.mikrobiologi_alat_mesin', compact('mikrobiologi_alat_mesin'))->with('no', ($mikrobiologi_alat_mesin->currentPage() - 1) * $mikrobiologi_alat_mesin->perPage() + 1);

        // return view('mikrobiologi_alat_mesin.supervisor.mikrobiologi_alat_mesin', compact('mikrobiologi_alat_mesin'))->with('no');
    }
    public function mikrobiologi_alat_mesin_supervisorttd(Request $request, $id)
    {
        $request->validate([
            'ttd_supervisor' => 'required',
        ],[
           'ttd_supervisor' => 'Kolom TTD harus di isi!',
        ]);
        Mikrobiologi_alat_mesin::where('id', $id)->update([
            'statusSP' => 1,
            'user_id_SP' => auth::user()->id,
            'name_id_SP' => auth::user()->nama,
            'created_at_SP' => $request->ttd_supervisor,
            // 'created_at_SP' => Carbon::now()->format('d F Y'),
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang
        ]);
        return redirect()->route('supervisor_mikrobiologi_alat_mesin')->with('supervisorttd', 'Data Mikrobiologi Alat Dan Mesin telah ditandatangani oleh Supervisor!');
    }

    public function SP_mikrobiologi_alat_mesin_pdf($id)
    {
        $sampel_mikrobiologi_alat_mesin = Sampel_mikrobiologi_alat_mesin::where('id_alat_mesin', $id)->get();
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.mikrobiologi_alat_mesin_pdf', array('mikrobiologi_alat_mesin' => $mikrobiologi_alat_mesin, 'sampel_mikrobiologi_alat_mesin'=>$sampel_mikrobiologi_alat_mesin))->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream();
        $filename = 'Laporan Analisa Mikrobiologi Alat Dan Mesin ' . $mikrobiologi_alat_mesin->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }












    ////Function Superadmin
    public function superadmin_mikrobiologi_alat_mesin(Request $request)
    {
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('delete', 0)->get();
        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
        //     $mikrobiologi_airs->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->paginate(5)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir
        // return view('operator.data', compact('mikrobiologi_airs'))->with('no', ($mikrobiologi_airs->currentPage() - 1) * $mikrobiologi_airs->perPage() + 1);

        return view('mikrobiologi_alat_mesin.superadmin.mikrobiologi_alat_mesin_info', compact('mikrobiologi_alat_mesin'))->with('no');
    }

    public function superadmin_mikrobiologi_alat_mesin_sampel(Request $request, $id)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('id', $id)->first();
        $sampel_mikrobiologi_alat_mesin = Sampel_mikrobiologi_alat_mesin::all();
        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
        //     $mikrobiologi_airs->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->paginate(5)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir
        // return view('operator.data', compact('mikrobiologi_airs'))->with('no', ($mikrobiologi_airs->currentPage() - 1) * $mikrobiologi_airs->perPage() + 1);

        return view('mikrobiologi_alat_mesin.superadmin.mikrobiologi_alat_mesin_sampel', compact('sampel_mikrobiologi_alat_mesin', 'mikrobiologi_alat_mesin'))->with('no');
    }


    public function superadmin_mikrobiologi_alat_mesin_history(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('delete', 1)->get();
        $sampel_mikrobiologi_alat_mesin = Sampel_mikrobiologi_alat_mesin::all();
        return view('mikrobiologi_alat_mesin.superadmin.history', compact('mikrobiologi_alat_mesin'))->with('no');
    }




    public function SA_mikrobiologi_alat_mesin_pdf($id)
    {
        $sampel_mikrobiologi_alat_mesin = Sampel_mikrobiologi_alat_mesin::where('id_alat_mesin', $id)->get();
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.mikrobiologi_alat_mesin_pdf', array('mikrobiologi_alat_mesin' => $mikrobiologi_alat_mesin, 'sampel_mikrobiologi_alat_mesin'=>$sampel_mikrobiologi_alat_mesin))->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream();
        $filename = 'Laporan Analisa Mikrobiologi Alat Dan Mesin ' . $mikrobiologi_alat_mesin->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }



























    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mikrobiologi_alat_mesin  $mikrobiologi_alat_mesin
     * @return \Illuminate\Http\Response
     */
    public function show(Mikrobiologi_alat_mesin $mikrobiologi_alat_mesin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mikrobiologi_alat_mesin  $mikrobiologi_alat_mesin
     * @return \Illuminate\Http\Response
     */
    public function edit(Mikrobiologi_alat_mesin $mikrobiologi_alat_mesin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mikrobiologi_alat_mesin  $mikrobiologi_alat_mesin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mikrobiologi_alat_mesin $mikrobiologi_alat_mesin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mikrobiologi_alat_mesin  $mikrobiologi_alat_mesin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mikrobiologi_alat_mesin $mikrobiologi_alat_mesin)
    {
        //
    }
}
