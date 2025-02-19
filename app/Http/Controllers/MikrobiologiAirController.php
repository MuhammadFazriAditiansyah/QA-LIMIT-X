<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Futami_sampel_kimia;
use App\Models\Mikrobiologi_air;
use App\Models\Sampel_mikrobiologi_air;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MikrobiologiAirExport;
use App\Models\ExportedFile;

class MikrobiologiAirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function mikrobiologi(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_airs = Mikrobiologi_air::where('delete', 0);

        // if ($request->has('tgl_inokulasi') && $request->has('tgl_pengamatan')) {
        //     $tgl_inokulasi = Carbon::parse($request->tgl_inokulasi)->toDateTimeString();
        //     $tgl_pengamatan = Carbon::parse($request->tgl_pengamatan)->toDateTimeString();
        //     $mikrobiologi_airs->whereBetween('tgl_inokulasi', [$tgl_inokulasi, $tgl_pengamatan]);
        // }

        if ($request->has('tgl_mulai') && $request->has('tgl_selesai')) {
            $tgl_mulai = Carbon::parse($request->tgl_mulai)->toDateTimeString();
            $tgl_selesai = Carbon::parse($request->tgl_selesai)->toDateTimeString();
            $mikrobiologi_airs->whereBetween('tgl_inokulasi', [$tgl_mulai, $tgl_selesai]);
        }

        // $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->get(); //asc dari awal ke akhir
        // return view('mikrobiologi_air.operator.mikrobiologi_air', compact('mikrobiologi_airs'))->with('no');
        $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('mikrobiologi_air.operator.mikrobiologi_air', compact('mikrobiologi_airs'))->with('no', ($mikrobiologi_airs->currentPage() - 1) * $mikrobiologi_airs->perPage() + 1);
    }

    public function add_mikrobiologi(Request $request)
    {
        return view('mikrobiologi_air.operator.add_mikrobiologi');
    }

    public function input_mikrobiologi(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|min:3',
            'tgl_inokulasi' => 'required',
            'tgl_pengamatan' => 'required',
            'satuan_tpc' => 'required',
            'satuan_yeast_mold' => 'required',
            'satuan_coliform' => 'required',
        ],[
            'nama_produk.required' => 'Kolom nama produk harus di isi',
            'tgl_inokulasi.required' => 'Kolom tanggal inokulasi harus di isi',
            'tgl_pengamatan.required' => 'Kolom tanggal pengamatan harus di isi',
            'satuan_tpc.required' => 'Kolom Satuan Tpc harus di isi',
            'satuan_yeast_mold.required' => 'Kolom Satuan yeast & Mold harus di isi',
            'satuan_coliform.required' => 'Kolom Satuan Coliform harus di isi',
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

        $get_last_no_dokumen = Mikrobiologi_air::latest()->first();
        // if(is_null ($get_last_no_dokumen) ){
        //     $get_last_no_dokumen = 0;
        // }else{
        //     // $get_last_no_dokumen->nodokumen;
        //     $get_last_no_dokumen = Futami::latest()->first()->nodokumen;
        // }

        if(is_null($get_last_no_dokumen) || $get_last_no_dokumen->created_at->format('y') !== $get_tahun) {
            $get_last_no_dokumen = 0;
        } else {
            $get_last_no_dokumen = $get_last_no_dokumen->nodokumen;
        }

        $nodokumen_get_num = explode("/", $get_last_no_dokumen)[0]+1; //membagi angka dengan axplode
        $nodokumen = $nodokumen_get_num."/LAMA/".numberToRoman($get_bulan)."/".$get_tahun;

        // dd($nodokumen);

        //get tahun "sudah"
        //get bulan -> setelah get bulan konversi bulan ke romawi ""sudah
        //get nomor dokumen terakhir dengan cara
        //get nomor dokumen dari database dari record paling terakhir,
        // $get_last_no_dokumen = Futami::latest()->first()->nodokumen;
        //setelah dapat nomor dokumen parsing hanya nomor saja
        //setelah dapat nomornya saja + 1
        //setelah dapat semua formatnya gabung jadi 1 variable nodokumen

        $mikrobiologiCreate = Mikrobiologi_air::create([
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

        // dd($mikrobiologiCreate);
        return redirect('/operator/sampel_mikrobiologi/' .$mikrobiologiCreate->id)->with('successAdd', 'Berhasil membuat Dokumen Baru!'); //mereturn / lewat / , bukan lewat name yang diberikan
    }

    public function sampel_mikrobiologi(Request $request, $id)
    {
        $mikrobiologi = Mikrobiologi_air::Where('id', $id)->first();
        // $futami_sampel_kimia = Futami_sampel_kimia::where('id_analisa_kimia', '=', $id)->get();

        return view('mikrobiologi_air.operator.sampel_mikrobiologi', compact('id', 'mikrobiologi'));
    }

    public function input_sampel_mikrobiologi(Request $request, $id)
    {
        $request->validate([
            'inputSampel' => 'required|array|min:1',

            'inputSampel.*.sampel_air' => 'required',
            'inputSampel.*.tpc' => 'required',
            'inputSampel.*.yeast_mold' => 'required',
            'inputSampel.*.coliform' => 'required',
            // 'inputSampel.*.keterangan' => 'required|min:5',
        ],[
            'inputSampel.required' => 'Kolom sampel_air harus di isi',
            'inputSampel.array' => 'Kolom sampel_air harus berupa array',
            'inputSampel.min' => 'Minimal satu sampel_air harus diisi',

            'inputSampel.*.sampel_air.required' => 'Kolom sampel_air harus di isi',
            'inputSampel.*.tpc.required' => 'Kolom TPC harus di isi',
            'inputSampel.*.yeast_mold.required' => 'Kolom Yeast & Mold harus di isi',
            'inputSampel.*.coliform.required' => 'Kolom Coliform harus di isi',
            // 'inputSampel.*.keterangan.required' => 'Kolom keterangan harus di isi',
            // 'inputSampel.*.keterangan.min' => 'Kolom keterangan harus memiliki panjang minimal 5 karakter',
        ]);

        foreach($request->inputSampel as $key => $value){
            DB::table('sampel_mikrobiologi_airs')->insert([
                'sampel_air' => $value['sampel_air'],
                'tpc' => $value['tpc'],
                'yeast_mold' => $value['yeast_mold'],
                'coliform' => $value['coliform'],
                'keterangan' => $value['keterangan'],
                'id_mikrobiologi' => $id,
            ]);
        }

        return redirect('/operator/mikrobiologi')->with('successAddSampel', 'Berhasil membuat Data Sampel Mikrobiologi Baru!');
    }

    public function mikrobiologi_operatorttd(Request $request, $id)
    {
        $request->validate([
            'ttd_operator' => 'required',
        ],[
           'ttd_operator' => 'Kolom TTD harus di isi!',
        ]);

        $mikrobiologis = Mikrobiologi_air::all();
        Mikrobiologi_air::where('id', $id)->update([
            'statusOP' => 1,
            'user_id_OP' => auth::user()->id,
            'name_id_OP' => auth::user()->nama,
            'created_at_OP' => $request->ttd_operator,
            // 'created_at_OP' => Carbon::now()->format('d F Y'),
        ]);

       //kalau berhasil akan diarahkan ke halaman list todo yang complated dengan pemberitahuan
        return redirect()->route('mikrobiologi')->with('operatorttd', 'Data telah ditandatangani oleh Operator!');
       // return view('operator.data', compact('futamis'))->with('no');
   }


   public function edit_mikrobiologi($id)
   {
       $mikrobiologis = Mikrobiologi_air::Where('id', $id)->first();
       $sampel_mikrobiologis = Sampel_mikrobiologi_air::where('id_mikrobiologi', '=', $id)->get();

       return view('mikrobiologi_air.operator.edit_mikrobiologi', compact('mikrobiologis', 'sampel_mikrobiologis'));
   }
    public function update_mikrobiologi_air(Request $request, $id)
    {
        //validasi
        $request->validate([
            'nama_produk' => 'required',
            'tgl_inokulasi' => 'required',
            'tgl_pengamatan' => 'required',
            'satuan_tpc' => 'required',
            'satuan_yeast_mold' => 'required',
            'satuan_coliform' => 'required',

        ],[
            'nama_produk.required' => 'Kolom nama produk harus di isi',
            'tgl_inokulasi.required' => 'Kolom tanggal inokulasi harus di isi',
            'tgl_pengamatan.required' => 'Kolom tanggal pengamatan harus di isi',
            'satuan_tpc.required' => 'Kolom Satuan Tpc harus di isi',
            'satuan_yeast_mold.required' => 'Kolom Satuan yeast & Mold harus di isi',
            'satuan_coliform.required' => 'Kolom Satuan Coliform harus di isi',
        ]);
        $validasiData = Mikrobiologi_air::where('id', $id)->update([
            'nama_produk' => $request->nama_produk,
            'tgl_inokulasi' => $request->tgl_inokulasi,
            'tgl_pengamatan' => $request->tgl_pengamatan,
            'satuan_tpc' => $request->satuan_tpc,
            'satuan_yeast_mold' => $request->satuan_yeast_mold,
            'satuan_coliform' => $request->satuan_coliform,
        ]);


        //Validasi edit sampel kimia
        $validasiSampel = $request->validate([
            'inputSampel.*.sampel_air' => 'required',
            'inputSampel.*.tpc' => 'required',
            'inputSampel.*.yeast_mold' => 'required',
            'inputSampel.*.coliform' => 'required',
            'inputSampel.*.keterangan' => 'required|min:5',
        ],[
            'inputSampel.*.sampel_air.required' => 'Kolom sampel_air harus di isi',
            'inputSampel.*.tpc.required' => 'Kolom TPC harus di isi',
            'inputSampel.*.yeast_mold.required' => 'Kolom Yeast & Mold harus di isi',
            'inputSampel.*.coliform.required' => 'Kolom Coliform harus di isi',
            'inputSampel.*.keterangan.required' => 'Kolom keterangan harus di isi',
            'inputSampel.*.keterangan.min' => 'Kolom keterangan harus memiliki panjang minimal 5 karakter',
        ]);

        $sampel_data = [];
        foreach ($request->inputSampel as $input) {
            $sampel = new Sampel_mikrobiologi_air();
            $sampel->sampel_air = $input['sampel_air'];
            $sampel->tpc = $input['tpc'];
            $sampel->yeast_mold = $input['yeast_mold'];
            $sampel->coliform = $input['coliform'];
            $sampel->keterangan = $input['keterangan'];
            $sampel_data[] = $sampel;
        }
        Mikrobiologi_air::find($id)->Sampel_mikrobiologi_air()->delete();
        Mikrobiologi_air::find($id)->Sampel_mikrobiologi_air()->saveMany($sampel_data);


        return redirect('/operator/mikrobiologi')->with('successUpdate','Berhasil mengupdate data Dokumen!');
    }


    public function mikrobiologi_sampel(Request $request, $id)
    {
        $mikrobiologi_airs = Mikrobiologi_air::Where('id', $id)->first();
        $sampel_mikrobiologis = Sampel_mikrobiologi_air::where('id_mikrobiologi', '=', $id)->get();

        return view('mikrobiologi_air.operator.sampel_mikrobiologi_air', compact('mikrobiologi_airs', 'sampel_mikrobiologis'))->with('no');
    }

    public function mikrobiologi_Destroy($id)
    {
        Mikrobiologi_air::findOrFail($id)->delete(); // Soft delete data

        return redirect()->route('mikrobiologi')->with('successDelete', 'Data berhasil dihapus. Lihat di History untuk mengembalikan.');
    }


    public function mikrobiologi_history(Request $request)
    {
        $mikrobiologi_airs = Mikrobiologi_air::onlyTrashed();

        if ($request->has('tgl_mulai') && $request->has('tgl_selesai')) {
            $tgl_mulai = Carbon::parse($request->tgl_mulai)->toDateTimeString();
            $tgl_selesai = Carbon::parse($request->tgl_selesai)->toDateTimeString();
            $mikrobiologi_airs->whereBetween('tgl_inokulasi', [$tgl_mulai, $tgl_selesai]);
        }

        $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->get();

        return view('mikrobiologi_air.operator.history', compact('mikrobiologi_airs'))->with('no');
    }

    public function restore($id)
    {
        $mikrobiologi = Mikrobiologi_air::onlyTrashed()->findOrFail($id); // Cari data yang dihapus
        $mikrobiologi->restore(); // Pulihkan data

        return redirect()->route('mikrobiologi_history')->with('success', 'Data berhasil dikembalikan.');
    }

    public function mikrobiologi_delete_permanent($id)
    {
        $mikrobiologi = Mikrobiologi_air::onlyTrashed()->find($id); // Cari data yang sudah dihapus (soft delete)
        if ($mikrobiologi) {
            $mikrobiologi->forceDelete(); // Hapus permanen data
            return redirect()->route('mikrobiologi_history')->with('success', 'Data berhasil dihapus permanen.');
        }
        return redirect()->route('mikrobiologi_history')->with('failed', 'Data tidak ditemukan.');
    }


    public function sampel_mikrobiologi_Destroy(Request $request, $id)
    {
        // Mikrobiologi_air::where('id', '=', $id)->delete();
        Sampel_mikrobiologi_air::where('id_mikrobiologi', '=', $id)->delete();
        return redirect()->back()->with('successDelete', 'Berhasil menghapus data sampel mikrobiologi!');
    }

    public function operator_mikrobiologi_pdf($id)
    {
        $sampel_mikrobiologi_airs = Sampel_mikrobiologi_air::where('id_mikrobiologi', $id)->get();
        $mikrobiologi_airs = Mikrobiologi_air::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream();
        $filename = 'Laporan Analisa Mikrobiologi Air ' . $mikrobiologi_airs->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }

    // excel
    public function mikrobiologi_air_excel($id)
    {
        $sampel_mikrobiologi_airs = Sampel_mikrobiologi_air::where('id_mikrobiologi', $id)->get();
        $mikrobiologi_airs = Mikrobiologi_air::where('id', $id)->first();
        return view('Excel.analisakimia', compact('mikrobiologi_airs', 'sampel_mikrobiologi_airs'));
    }

    public function mikrobiologi_air_excel_show($id)
    {
        $sampel_mikrobiologi_airs = Sampel_mikrobiologi_air::where('id_mikrobiologi', $id)->get();
        $mikrobiologi_airs = Mikrobiologi_air::where('id', $id)->first();

        return view('Excel.mikrobiologi_air.show_mikrobiologi_air', compact('mikrobiologi_airs', 'sampel_mikrobiologi_airs'));
    }

    public function mikrobiologi_air_exportExcel($id)
    {
        $mikrobiologi_airs = Mikrobiologi_air::where('id', $id)->first();
        $nodokumen = explode('/', $mikrobiologi_airs->nodokumen);
        $dokumen = implode('_', $nodokumen);

        $filename = $dokumen . '.xlsx';
        $path = storage_path('app/public/exports/' . $filename);

        // Simpan file ke server
        Excel::store(new MikrobiologiAirExport($id), 'public/exports/' . $filename);

        // Simpan data ke database
        ExportedFile::create([
            'filename' => $filename,
            'path' => '/storage/exports/' . $filename,
            'type' => 'Mikrobiologi Air',
        ]);

        // Download file ke pengguna
        return response()->download($path);
    }













///////Function Staff
    public function staff_mikrobiologi(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_airs = Mikrobiologi_air::where('delete', 0);

        // if ($request->has('tgl_inokulasi') && $request->has('tgl_pengamatan')) {
        //     $tgl_inokulasi = Carbon::parse($request->tgl_inokulasi)->toDateTimeString();
        //     $tgl_pengamatan = Carbon::parse($request->tgl_pengamatan)->toDateTimeString();
        //     $mikrobiologi_airs->whereBetween('tgl_inokulasi', [$tgl_inokulasi, $tgl_pengamatan]);
        // }
        if ($request->has('tgl_mulai') && $request->has('tgl_selesai')) {
            $tgl_mulai = Carbon::parse($request->tgl_mulai)->toDateTimeString();
            $tgl_selesai = Carbon::parse($request->tgl_selesai)->toDateTimeString();
            $mikrobiologi_airs->whereBetween('tgl_inokulasi', [$tgl_mulai, $tgl_selesai]);
        }

        // $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->get(); //asc dari awal ke akhir
        // return view('mikrobiologi_air.staff.mikrobiologi_air', compact('mikrobiologi_airs'))->with('no');

        $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('mikrobiologi_air.staff.mikrobiologi_air', compact('mikrobiologi_airs'))->with('no', ($mikrobiologi_airs->currentPage() - 1) * $mikrobiologi_airs->perPage() + 1);
    }

    public function mikrobiologi_staffttd(Request $request, $id)
    {
        $request->validate([
            'ttd_staff' => 'required',
        ],[
           'ttd_staff' => 'Kolom TTD harus di isi!',
        ]);

        Mikrobiologi_air::where('id', $id)->update([
            'statusST' => 1,
            'user_id_ST' => auth::user()->id,
            'name_id_ST' => auth::user()->nama,
            'created_at_ST' => $request->ttd_staff,
            // 'created_at_ST' => Carbon::now()->format('d F Y'),
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang
        ]);
        //kalau berhasil akan diarahkan ke halaman list todo yang complated dengan pemberitahuan
        return redirect()->route('staff_mikrobiologi')->with('staffttd', 'Data Mikrobiologi telah ditandatangani oleh Staff!');
    }

    public function mikrobiologi_staff_declinettd($id)
    {
        //$id pada paramater mengambil data dari path dinamis {id}
        //cari data yan memiliki value column yang id yang sama dengan data id yang dikirim ke route, maka update baris data tersebut
        Mikrobiologi_air::where('id', $id)->update([
            'statusST' => 2,
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang
        ]);
        //kalau berhasil akan diarahkan ke halaman list todo yang complated dengan pemberitahuan
        return redirect()->route('staff_mikrobiologi')->with('declinettd', 'Data Mikrobiologi telas ditolak oleh Staff!');
    }

    public function staff_mikrobiologi_pdf($id)
    {
        $sampel_mikrobiologi_airs = Sampel_mikrobiologi_air::where('id_mikrobiologi', $id)->get();
        $mikrobiologi_airs = Mikrobiologi_air::where('id', $id)->first();

        // $options = new Options();
        // $options->set('isRemoteEnabled',true);

        // $options = new Options();
        // $options->set('isRemoteEnabled', true);
        // $options->set('chroot', realpath(base_path()));
        // $options->set('enable_font_subsetting', false);
        // $options->set('pdf_backend', 'CPDF');
        // $options->set('default_media_type', 'screen');
        // $dompdf = new Dompdf($options);


        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream();
        $filename = 'Laporan Analisa Mikrobiologi Air ' . $mikrobiologi_airs->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }





















////Function Supervisor
    public function supervisor_mikrobiologi(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_airs = Mikrobiologi_air::where('delete', 0);

        // if ($request->has('tgl_inokulasi') && $request->has('tgl_pengamatan')) {
        //     $tgl_inokulasi = Carbon::parse($request->tgl_inokulasi)->toDateTimeString();
        //     $tgl_pengamatan = Carbon::parse($request->tgl_pengamatan)->toDateTimeString();
        //     $mikrobiologi_airs->whereBetween('tgl_inokulasi', [$tgl_inokulasi, $tgl_pengamatan]);
        // }
        if ($request->has('tgl_mulai') && $request->has('tgl_selesai')) {
            $tgl_mulai = Carbon::parse($request->tgl_mulai)->toDateTimeString();
            $tgl_selesai = Carbon::parse($request->tgl_selesai)->toDateTimeString();
            $mikrobiologi_airs->whereBetween('tgl_inokulasi', [$tgl_mulai, $tgl_selesai]);
        }

        // $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->get(); //asc dari awal ke akhir
        // return view('mikrobiologi_air.supervisor.mikrobiologi_air', compact('mikrobiologi_airs'))->with('no');

        $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->paginate(10)->onEachSide(10)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('mikrobiologi_air.supervisor.mikrobiologi_air', compact('mikrobiologi_airs'))->with('no', ($mikrobiologi_airs->currentPage() - 1) * $mikrobiologi_airs->perPage() + 1);
    }
    public function mikrobiologi_supervisorttd(Request $request, $id)
    {
        $request->validate([
            'ttd_supervisor' => 'required',
        ],[
           'ttd_supervisor' => 'Kolom TTD harus di isi!',
        ]);

        Mikrobiologi_air::where('id', $id)->update([
            'statusSP' => 1,
            'user_id_SP' => auth::user()->id,
            'name_id_SP' => auth::user()->nama,
            'created_at_SP' => $request->ttd_supervisor,
            // 'created_at_SP' => Carbon::now()->format('d F Y'),
            // 'done_time' => Carbon::now(),  //carbon=mengambil data terbaru sekarang
        ]);
        //kalau berhasil akan diarahkan ke halaman list todo yang complated dengan pemberitahuan
        return redirect()->route('supervisor_mikrobiologi')->with('supervisorttd', 'Data Mikrobiologi telah ditandatangani oleh Supervisor!');
    }

    public function supervisor_mikrobiologi_pdf($id)
    {
        $sampel_mikrobiologi_airs = Sampel_mikrobiologi_air::where('id_mikrobiologi', $id)->get();
        $mikrobiologi_airs = Mikrobiologi_air::where('id', $id)->first();

        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream();
        $filename = 'Laporan Analisa Mikrobiologi Air ' . $mikrobiologi_airs->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }












    ////Function Superadmin
    public function superadmin_mikrobiologi(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_airs = Mikrobiologi_air::where('delete', 0)->get();
        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
        //     $mikrobiologi_airs->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->paginate(5)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir
        // return view('operator.data', compact('mikrobiologi_airs'))->with('no', ($mikrobiologi_airs->currentPage() - 1) * $mikrobiologi_airs->perPage() + 1);


        return view('mikrobiologi_air.superadmin.mikrobiologi_info', compact('mikrobiologi_airs'))->with('no');
    }

    public function superadmin_mikrobiologi_sampel(Request $request, $id)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $sampel_mikrobiologi_airs = Sampel_mikrobiologi_air::all();
        $mikrobiologi_airs = Mikrobiologi_air::Where('id', $id)->first();

        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
        //     $mikrobiologi_airs->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $mikrobiologi_airs = $mikrobiologi_airs->orderBy('id', 'asc')->paginate(5)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir
        // return view('operator.data', compact('mikrobiologi_airs'))->with('no', ($mikrobiologi_airs->currentPage() - 1) * $mikrobiologi_airs->perPage() + 1);


        return view('mikrobiologi_air.superadmin.mikrobiologi_sampel', compact('sampel_mikrobiologi_airs', 'mikrobiologi_airs'))->with('no');
    }

    public function superadmin_mikrobiologi_pdf($id)
    {
        $sampel_mikrobiologi_airs = Sampel_mikrobiologi_air::where('id_mikrobiologi', $id)->get();
        $mikrobiologi_airs = Mikrobiologi_air::where('id', $id)->first();

        // $options = new Options();
        // $options->set('isRemoteEnabled',true);

        // $options = new Options();
        // $options->set('isRemoteEnabled', true);
        // $options->set('chroot', realpath(base_path()));
        // $options->set('enable_font_subsetting', false);
        // $options->set('pdf_backend', 'CPDF');
        // $options->set('default_media_type', 'screen');
        // $dompdf = new Dompdf($options);


        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // $pdf = PDF::loadView('pdf.mikrobiologi_air_pdf', array('mikrobiologi_airs' => $mikrobiologi_airs, 'sampel_mikrobiologi_airs'=>$sampel_mikrobiologi_airs))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream();
        $filename = 'Laporan Analisa Mikrobiologi Air ' . $mikrobiologi_airs->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }

    public function superadmin_mikrobiologi_history(Request $request)
    {
        // $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_airs = Mikrobiologi_air::where('delete', 1)->get();
        $sampel_mikrobiologi_airs = Sampel_mikrobiologi_air::all();
        return view('mikrobiologi_air.superadmin.history', compact('mikrobiologi_airs'))->with('no');
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
     * @param  \App\Models\Mikrobiologi_air  $mikrobiologi_air
     * @return \Illuminate\Http\Response
     */
    public function show(Mikrobiologi_air $mikrobiologi_air)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mikrobiologi_air  $mikrobiologi_air
     * @return \Illuminate\Http\Response
     */
    public function edit(Mikrobiologi_air $mikrobiologi_air)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mikrobiologi_air  $mikrobiologi_air
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mikrobiologi_air $mikrobiologi_air)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mikrobiologi_air  $mikrobiologi_air
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mikrobiologi_air $mikrobiologi_air)
    {
        //
    }
}


?>
