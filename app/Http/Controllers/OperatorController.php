<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use App\Models\Futami;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\Futami_sampel_kimia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnalisaKimiaExport;

class OperatorController extends Controller
{
     //Route Operator
     public function operator()
     {
         return view('operator.operator');
     }

    public function data(Request $request)
    {

        // if(request()->tanggal_uji || request()->tanggal_selesai){
        //     $tanggal_uji = Carbon::parse(request()->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse(request()->tanggal_selesai)->toDateTimeString();

        //     $futamis = Futami::orderBy('id', 'desc')->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai])->get();
        // }
        // else {
        // //    $futamis = Futami::all();
        //     // $futamis = Futami::paginate(5)->onEachSide(5);
        //     // $futamis = Futami::where([
        //     //     ['delete', '=', 1],
        //     // ])->get();
        //     $futamis = Futami::where([
        //         ['delete', '=', 0],
        //     ])->paginate(5)->onEachSide(5);

        // }

        //membenarkan paginate

        // $ttdoperator = User::where('id', 'user_id')->first();
        $futamis = Futami::where('delete', 0);
        if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
            $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
            $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
            $futamis->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        }

        $futamis = $futamis->orderBy('id', 'asc')->paginate(5)->onEachSide(5)->appends(request()->except('page')); //asc dari awal ke akhir
        return view('operator.data', compact('futamis'))->with('no', ($futamis->currentPage() - 1) * $futamis->perPage() + 1);
    }


     public function tambahData()
     {
         return view('operator.tambahData');
     }

     public function inputData(Request $request)
     {
         $request->validate([
            //  'nodokumen' => 'required|min:5|unique:futamis,nodokumen',
             'nodokumen' => 'required|min:5',
             'pemberi_sampel' => 'required',
             'parameter_pengujian' => 'required|min:5',
             'jumlah_sampel' => 'required',
             'tanggal_terima' => 'required',
             'tanggal_uji' => 'required',
             'tanggal_selesai' => 'required',
         ],[
            'nodokumen.unique' => 'no dokumen ini telah ada!',
            'nodokumen.required' => 'no dokumen ini harus di isi!',
            'pemberi_sampel.required' => 'Kolom pemberi_sampel harus di isi',
            'parameter_pengujian.required' => 'Kolom parameter_pengujian harus di isi',
            'jumlah_sampel.required' => 'Kolom jumlah_sampel harus di isi',
            'tanggal_terima.required' => 'Kolom tanggal_terima harus di isi',
            'tanggal_uji.required' => 'Kolom tanggal_uji harus di isi',
            'tanggal_selesai.required' => 'Kolom tanggal_selesai harus di isi',
         ]);

         $request->validate([
            'sampel' => 'required',
            'parameter_nilaiuji' => 'required',
            'spesifikasi' => 'required|min:5',
            'keterangan' => 'required|min:5',
        ]);

         // tambah data ke db bagian table Futami
         Futami::create([
             'nodokumen' => $request->nodokumen,
             'pemberi_sampel' => $request->pemberi_sampel,
             'parameter_pengujian' => $request->parameter_pengujian,
             'jumlah_sampel' => $request->jumlah_sampel,
             'tanggal_terima' => $request->tanggal_terima,
             'tanggal_uji' => $request->tanggal_uji,
             'tanggal_selesai' => $request->tanggal_selesai,

             'sampel' => $request->sampel,
             'parameter_nilaiuji' => $request->parameter_nilaiuji,
             'spesifikasi' => $request->spesifikasi,
             'keterangan' => $request->keterangan,

             'statusOP' => 0,
             'statusST' => 0,
             'statusSP' => 0,
         ]);

         Futami_sampel_kimia::create([
            'sampel' => $request->sampel,
            'parameter_nilaiuji' => $request->parameter_nilaiuji,
            'spesifikasi' => $request->spesifikasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/operator/data')->with('successAdd', 'Berhasil membuat Data Baru!'); //mereturn / lewat / , bukan lewat name yang diberikan
     }


    public function data_analisa_kimia(Request $request)
    {
        return view('operator.analisaKimia');
    }

    public function input_data_analisa_kimia(Request $request)
    {
        $request->validate([
            // 'nodokumen' => 'required|min:5|unique:futamis,nodokumen',
            'pemberi_sampel' => 'required',
            // 'parameter_pengujian' => 'required|min:3',
            'jumlah_sampel' => 'required',
            'tanggal_terima' => 'required',
            'tanggal_uji' => 'required',
            'tanggal_selesai' => 'required',
        ],[
           'nodokumen.unique' => 'no dokumen ini telah ada!',
           'nodokumen.required' => 'no dokumen ini harus di isi!',
           'pemberi_sampel.required' => 'Kolom pemberi_sampel harus di isi',
        //    'parameter_pengujian.required' => 'Kolom parameter_pengujian harus di isi',
           'jumlah_sampel.required' => 'Kolom jumlah_sampel harus di isi',
           'tanggal_terima.required' => 'Kolom tanggal_terima harus di isi',
           'tanggal_uji.required' => 'Kolom tanggal_uji harus di isi',
           'tanggal_selesai.required' => 'Kolom tanggal_selesai harus di isi',
        ]);
        // $get_now = Carbon::now()->translatedFormat('d-m-y h:i:s');
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

        $get_last_no_dokumen = Futami::latest()->first();
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
        $nodokumen = $nodokumen_get_num."/LAK/".numberToRoman($get_bulan)."/".$get_tahun;

        // dd($nodokumen);

        //get tahun "sudah"
        //get bulan -> setelah get bulan konversi bulan ke romawi ""sudah
        //get nomor dokumen terakhir dengan cara
        //get nomor dokumen dari database dari record paling terakhir,
        // $get_last_no_dokumen = Futami::latest()->first()->nodokumen;
        //setelah dapat nomor dokumen parsing hanya nomor saja
        //setelah dapat nomornya saja + 1
        //setelah dapat semua formatnya gabung jadi 1 variable nodokumen


        $validasiCreate = Futami::create([
            'nodokumen' => $nodokumen,

            // 'nodokumen' => $request->nodokumen,
            'pemberi_sampel' => $request->pemberi_sampel,
            // 'parameter_pengujian' => $request->parameter_pengujian,
            'parameter_pengujian' => $request->parameter_pengujian,
            'parameter_pengujian_c2' => $request->parameter_pengujian_c2,
            'parameter_pengujian_c3' => $request->parameter_pengujian_c3,
            'parameter_pengujian_c4' => $request->parameter_pengujian_c4,


            'jumlah_sampel' => $request->jumlah_sampel,
            'tanggal_terima' => $request->tanggal_terima,
            'tanggal_uji' => $request->tanggal_uji,
            'tanggal_selesai' => $request->tanggal_selesai,

            'statusOP' => 0,
            'statusST' => 0,
            'statusSP' => 0,
            'delete' => 0,
        ]);

        return redirect('/operator/sampelanalisakimia/' .$validasiCreate->id)->with('successAdd', 'Berhasil membuat Dokumen Baru!'); //mereturn / lewat / , bukan lewat name yang diberikan

    }

    public function sampel_analisa_kimia(Request $request, $id)
    {
        $futamis = Futami::Where('id', $id)->first();
        // $futami_sampel_kimia = Futami_sampel_kimia::where('id_analisa_kimia', '=', $id)->get();

        return view('operator.sampelAnalisaKimia', compact('id', 'futamis'));
    }


    public function input_sampel_analisa_kimia(Request $request, $id)
    {
        $request->validate([
            'inputSampel' => 'required|array|min:1',

            'inputSampel.*.sampel' => 'required',
            // 'inputSampel.*.parameter_nilaiuji' => 'required',
            // 'inputSampel.*.parameter_nilaiuji_c2' => 'required',
            // 'inputSampel.*.parameter_nilaiuji_c3' => 'required',
            // 'inputSampel.*.parameter_nilaiuji_c4' => 'required',
            // 'inputSampel.*.spesifikasi' => 'required|min:5',
            // 'inputSampel.*.keterangan' => 'required|min:5',
        ],[
            'inputSampel.required' => 'Kolom sampel harus di isi',
            'inputSampel.array' => 'Kolom sampel harus berupa array',
            'inputSampel.min' => 'Minimal satu sampel harus diisi',

            'inputSampel.*.sampel.required' => 'Kolom sampel harus di isi',
            // 'inputSampel.*.parameter_nilaiuji.required' => 'Kolom parameter_nilaiuji harus di isi',
            // 'inputSampel.*.parameter_nilaiuji_c2.required' => 'Kolom parameter_nilaiuji C2 harus di isi',
            // 'inputSampel.*.parameter_nilaiuji_c3.required' => 'Kolom parameter_nilaiuji C3 harus di isi',
            // 'inputSampel.*.parameter_nilaiuji_c4.required' => 'Kolom parameter_nilaiuji C4 harus di isi',

            'inputSampel.*.spesifikasi.required' => 'Kolom spesifikasi harus di isi',
            'inputSampel.*.spesifikasi.min' => 'Kolom spesifikasi harus memiliki panjang minimal 5 karakter',
            // 'inputSampel.*.keterangan.required' => 'Kolom keterangan harus di isi',
            // 'inputSampel.*.keterangan.min' => 'Kolom keterangan harus memiliki panjang minimal 5 karakter',
        ]);

        foreach($request->inputSampel as $key => $value){
            DB::table('futami_sampel_kimias')->insert([
                'sampel' => $value['sampel'],
                'parameter_nilaiuji' => $value['parameter_nilaiuji'],
                'parameter_nilaiuji_c2' => $value['parameter_nilaiuji_c2'],
                'parameter_nilaiuji_c3' => $value['parameter_nilaiuji_c3'],
                'parameter_nilaiuji_c4' => $value['parameter_nilaiuji_c4'],
                'spesifikasi' => $value['spesifikasi'],
                'keterangan' => $value['keterangan'],
                'id_analisa_kimia' => $id,
            ]);
        }

        return redirect('/operator/data')->with('successAddSampel', 'Berhasil membuat Data Sampel Baru!');
    }

    public function edit_data_analisa_kimia($id)
    {
        $futamis = Futami::Where('id', $id)->first();
        $futami_sampel_kimia = Futami_sampel_kimia::where('id_analisa_kimia', '=', $id)->get();

        return view('operator.editAnalisaKimia', compact('futamis', 'futami_sampel_kimia'));
    }
    public function update_data_analisa_kimia(Request $request, $id)
    {
        //validasi
        $request->validate([
            // 'nodokumen' => 'required|min:5',
            'pemberi_sampel' => 'required',
            // 'parameter_pengujian' => 'required|min:5',
            'jumlah_sampel' => 'required',
            'tanggal_terima' => 'required',
            'tanggal_uji' => 'required',
            'tanggal_selesai' => 'required',
        ],[
            // 'nodokumen.required' => 'no dokumen ini harus di isi!',
            'pemberi_sampel.required' => 'Kolom pemberi_sampel harus di isi',
            // 'parameter_pengujian.required' => 'Kolom parameter_pengujian harus di isi',
            'jumlah_sampel.required' => 'Kolom jumlah_sampel harus di isi',
            'tanggal_terima.required' => 'Kolom tanggal_terima harus di isi',
            'tanggal_uji.required' => 'Kolom tanggal_uji harus di isi',
            'tanggal_selesai.required' => 'Kolom tanggal_selesai harus di isi',
        ]);
        $validasiData = Futami::where('id', $id)->update([
            // 'nodokumen' => $request->nodokumen,
            'pemberi_sampel' => $request->pemberi_sampel,
            'parameter_pengujian' => $request->parameter_pengujian,
            'parameter_pengujian_c2' => $request->parameter_pengujian_c2,
            'parameter_pengujian_c3' => $request->parameter_pengujian_c3,
            'parameter_pengujian_c4' => $request->parameter_pengujian_c4,
            'jumlah_sampel' => $request->jumlah_sampel,
            'tanggal_terima' => $request->tanggal_terima,
            'tanggal_uji' => $request->tanggal_uji,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        //Validasi edit sampel kimia
        $validasiSampel = $request->validate([
            'inputSampel.*.sampel' => 'required',
            // 'inputSampel.*.parameter_nilaiuji' => 'required',
            // 'inputSampel.*.parameter_nilaiuji_c2' => 'required',
            // 'inputSampel.*.parameter_nilaiuji_c3' => 'required',
            // 'inputSampel.*.parameter_nilaiuji_c4' => 'required',
            // 'inputSampel.*.spesifikasi' => 'required|min:5',
            // 'inputSampel.*.keterangan' => 'required|min:5',
        ],[
            'inputSampel.*.sampel.required' => 'Kolom sampel harus di isi',
            // 'inputSampel.*.parameter_nilaiuji.required' => 'Kolom parameter_nilaiuji harus di isi',
            // 'inputSampel.*.parameter_nilaiuji_c2.required' => 'Kolom parameter_nilaiuji harus di isi',
            // 'inputSampel.*.parameter_nilaiuji_c3.required' => 'Kolom parameter_nilaiuji harus di isi',
            // 'inputSampel.*.parameter_nilaiuji_c4.required' => 'Kolom parameter_nilaiuji harus di isi',
            // 'inputSampel.*.spesifikasi.required' => 'Kolom spesifikasi harus di isi',
            // 'inputSampel.*.keterangan.required' => 'Kolom keterangan harus di isi',
        ]);

        $sampel_data = [];
        foreach ($request->inputSampel as $input) {
            $sampel = new Futami_sampel_kimia();
            $sampel->sampel = $input['sampel'];
            $sampel->parameter_nilaiuji = $input['parameter_nilaiuji'];
            $sampel->parameter_nilaiuji_c2 = $input['parameter_nilaiuji_c2'];
            $sampel->parameter_nilaiuji_c3 = $input['parameter_nilaiuji_c3'];
            $sampel->parameter_nilaiuji_c4 = $input['parameter_nilaiuji_c4'];
            $sampel->spesifikasi = $input['spesifikasi'];
            $sampel->keterangan = $input['keterangan'];
            $sampel_data[] = $sampel;
        }
        Futami::find($id)->futami_sampel_kimia()->delete();
        Futami::find($id)->futami_sampel_kimia()->saveMany($sampel_data);


        return redirect('/operator/data')->with('successUpdate','Berhasil mengupdate data Dokumen!');
    }


    public function sampel(Request $request, $id)
    {
        $futamis = Futami::Where('id', $id)->first();
        $futami_sampel_kimia = Futami_sampel_kimia::where('id_analisa_kimia', '=', $id)->get();

        // return view('operator.editAnalisaKimia', compact('futamis', 'futami_sampel_kimia'));
        return view('operator.sampel', compact('futamis', 'futami_sampel_kimia'))->with('no');
    }

    public function sampelDestroy(Request $request, $id)
    {
        Futami_sampel_kimia::where('id', '=', $id)->delete();
        // return redirect()->route('data')->with('successDelete', 'Berhasil menghapus data!');
        return redirect()->back()->with('successDelete', 'Berhasil menghapus data sampel!');

    }

    public function dataDestroy($id)
    {
        // Futami::where('id', '=', $id)->delete();
        // Futami_sampel_kimia::where('id_analisa_kimia', '=', $id)->delete();

        Futami::where('id',$id)->update([
            'delete' => 1,
        ]);
        // Futami_sampel_kimia::where('id_analisa_kimia', '=', $id)->update();

        return redirect()->route('data')->with('successDelete', 'Berhasil menghapus data!');
    }


    public function analisakimia_history(Request $request)
    {
        // $query = Futami::orderBy('id', 'desc');

        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();

        //     $query->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $futamis = $query->paginate(5)->onEachSide(5);
        // $futamis = Futami::where([
        //     ['delete', '=', 1],
        // ])->paginate(5)->onEachSide(5);

        $futamis = Futami::where('delete', 1);
        if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
            $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
            $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
            $futamis->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        }

        // $futamis = $futamis->orderBy('id', 'desc')->paginate(5)->onEachSide(5); //desc ordeyBy untuk mengurutkan data dari paling ahir hingga ke paling awal
        $futamis = $futamis->orderBy('id', 'asc')->paginate(5)->onEachSide(5)->appends(request()->except('page')); ///asc untuk mengurutkan data dari paling awal hingga ke data data paling akhir
        return view('operator.history', compact('futamis'))->with('no', ($futamis->currentPage() - 1) * $futamis->perPage() + 1);
    }

     public function dataEdit($id)
     {
         //menampilkan form edit data
         //ambil data dari db yang idnya sama dengan id yang dikirim dari routenya
         $futamis = Futami::Where('id', $id)->first();
         $futami_sampel_kimia = Futami_sampel_kimia::where('id', '=', $id)->first();

         // lalu tampilkan halaman dari view edit dengan mengirim data yang ada di variable todo
         return view('operator.editData', compact('futamis', 'futami_sampel_kimia'));
     }

    //  public function dataUpdate(Request $request, $id)
    //  {
    //      //validasi
    //      $request->validate([
    //          'nodokumen' => 'required|min:5',
    //          'pemberi_sampel' => 'required',
    //          'parameter_pengujian' => 'required|min:5',
    //          'jumlah_sampel' => 'required',
    //          'tanggal_terima' => 'required',
    //          'tanggal_uji' => 'required',
    //          'tanggal_selesai' => 'required',
    //      ]);
    //      $request->validate([
    //         'sampel' => 'required',
    //         'parameter_nilaiuji' => 'required',
    //         'spesifikasi' => 'required|min:5',
    //         'keterangan' => 'required|min:5',
    //     ]);


    //      Futami::where('id', $id)->update([
    //          'nodokumen' => $request->nodokumen,
    //          'pemberi_sampel' => $request->pemberi_sampel,
    //          'parameter_pengujian' => $request->parameter_pengujian,
    //          'jumlah_sampel' => $request->jumlah_sampel,
    //          'tanggal_terima' => $request->tanggal_terima,
    //          'tanggal_uji' => $request->tanggal_uji,
    //          'tanggal_selesai' => $request->tanggal_selesai,
    //      ]);
    //      Futami_sampel_kimia::create([
    //         'sampel' => $request->sampel,
    //         'parameter_nilaiuji' => $request->parameter_nilaiuji,
    //         'spesifikasi' => $request->spesifikasi,
    //         'keterangan' => $request->keterangan,
    //     ]);
    //      //redirect apabila berhasil bersama dengan alert-nya
    //      return redirect()->route('data')->with('successUpdate','Berhasil mengupdate data!');
    //  }

     public function operatorttd(Request $request, $id)
     {
        $request->validate([
            'ttd_operator' => 'required',
        ],[
           'ttd_operator' => 'Kolom TTD Operator harus di isi!',
        ]);

        $futamis = Futami::all();
        Futami::where('id', $id)->update([
            'statusOP' => 1,
            'user_id_OP' => auth::user()->id,
            'name_id_OP' => auth::user()->nama,
           //  'created_at_OP' => Carbon::now()->format('Y M D'),
            'created_at_OP' => $request->input('ttd_operator'),
        ]);
        // dd($ttdOperator);

        //kalau berhasil akan diarahkan ke halaman list todo yang complated dengan pemberitahuan
         return redirect()->route('data')->with('operatorttd', 'Data telah ditandatangani oleh Operator!');
        // return view('operator.data', compact('futamis'))->with('no');
    }


    public function operator_analisakimiapdf($id)
    {
        $futami_sampel_kimia = Futami_sampel_kimia::where('id_analisa_kimia', $id)->get();
        $futami = Futami::where('id', $id)->first();


        $pdf = PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('pdf.analisa_kimia_pdf', array('futami' => $futami, 'futami_sampel_kimia'=>$futami_sampel_kimia))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream();
        $filename = 'Laporan Analisa Kimia ' . $futami->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }

    public function operator_analisakimia_excel($id)
    {
        $futami_sampel_kimia = Futami_sampel_kimia::where('id_analisa_kimia', $id)->get();
        $futami = Futami::where('id', $id)->first();

        return view('Excel.analisakimia', compact('futami', 'futami_sampel_kimia'));
    }

    public function operator_analisakimia_excel_show($id)
    {
        $futami_sampel_kimia = Futami_sampel_kimia::where('id_analisa_kimia', $id)->get();
        $futami = Futami::where('id', $id)->first();

        return view('Excel.Show_analisakimia', compact('futami', 'futami_sampel_kimia'));
    }

    public function operator_analisakimia_exportExcel($id)
    {
        // Mengatur batas waktu eksekusi menjadi 300 detik (5 menit)
        // set_time_limit(300);

        $futami = Futami::where('id', $id)->first();

        $nodokumen = explode('/', $futami->nodokumen);
        $dokumen = implode('_', $nodokumen);


        return Excel::download(new AnalisaKimiaExport($id), ''.$dokumen.'.xlsx');
    }

}
