<?php

namespace App\Http\Controllers;

use App\Models\Futami;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Futami_sampel_kimia;
use App\Models\Mikrobiologi_air;
use App\Models\Mikrobiologi_produk;
use App\Models\Mikrobiologi_proses_produksi;
use App\Models\Mikrobiologi_produk_percobaan;
use App\Models\Mikrobiologi_bahan_baku;
use App\Models\Mikrobiologi_bahan_kemas;
use App\Models\Mikrobiologi_ruangan;
use App\Models\Mikrobiologi_personil;
use App\Models\Mikrobiologi_alat_mesin;
use App\Models\Mikrobiologi_kimia_sensori;
use App\Models\Laporan_analisa_air;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Operator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnalisaKimiaExport;


class SuperadminController extends Controller
{
    //Controller Admin
    public function admin()
    {
        $futamis = Futami::all();
        $mikrobiologi_airs = Mikrobiologi_air::all();
        $mikrobiologi_produks = Mikrobiologi_produk::all();
        $mikrobiologi_proses_produksi = Mikrobiologi_proses_produksi::all();
        $mikrobiologi_produk_percobaan = Mikrobiologi_produk_percobaan::all();
        $mikrobiologi_bahan_baku = Mikrobiologi_bahan_baku::all();
        $mikrobiologi_bahan_kemas = Mikrobiologi_bahan_kemas::all();
        $mikrobiologi_ruangan = Mikrobiologi_ruangan::all();
        $mikrobiologi_personil = Mikrobiologi_personil::all();
        $mikrobiologi_alat_mesin = Mikrobiologi_alat_mesin::all();
        $mikrobiologi_kimia_sensori = Mikrobiologi_kimia_sensori::all();
        $laporan_analisa_air = Laporan_analisa_air::all();

        return view('admin.admin', compact('futamis', 'mikrobiologi_airs', 'mikrobiologi_produks', 'mikrobiologi_proses_produksi', 'mikrobiologi_produk_percobaan', 'mikrobiologi_bahan_baku', 'mikrobiologi_bahan_kemas', 'mikrobiologi_ruangan', 'mikrobiologi_personil', 'mikrobiologi_alat_mesin', 'mikrobiologi_kimia_sensori', 'laporan_analisa_air'));
    }

    public function role()
    {
        return view('admin.role');
    }

    public function adduser()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.adduser', compact('users', 'roles'));
    }

    public function inputUser(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:25',
            'nohp' => 'required|min:5|max:13|unique:users,nohp',
            'email' => 'required',
            // 'password' => 'required|min:3|max:13',
            'jabatan' => 'required',
            'alamat' => 'required',
        ],[
            'nama.required' => 'Kolom nama harus di isi',
            'nohp.unique' => 'no handphone ini telah ada!',
            'nohp.required' => 'no handphone ini harus di isi!',
            'email.unique' => 'enail ini telah ada!',
            'email.required' => 'enail ini harus di isi!',
            // 'password.required' => 'Kolom password harus di isi',
            'jabatan.required' => 'Kolom jabatan harus di isi',
            'alamat.required' => 'Kolom alamat harus di isi',
        ]);
        // tambah data ke db bagian table users
        User::create([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'email' => $request->email,
            // 'password' => Hash::make($request->password), //request password itu adalah password
            'password' => Hash::make(1234567890),
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'status' => 0,
            'role_id' => $request->jabatan,
        ]);
        return redirect('/admin/adduser')->with('createUser', 'Anda berhasil membuat akun User!'); //mereturn / lewat / , bukan lewat name yang diberikan

        //return redirect('/cetakpdf')->with('success', 'Anda berhasil membuat akun!');
        // $ppdbs = User::latest()->first();
        // return view('dashboardStudent.cetakpdf', compact('ppdbs'));
    }

    public function userDestroy($id)
    {
        User::where('id', '=', $id)->delete();
        return redirect()->route('adduser')->with('successDelete', 'Berhasil menghapus data user!');
    }

    public function userEdit($id)
    {
        //menampilkan form edit data
        //ambil data dari db yang idnya sama dengan id yang dikirim dari routenya
        $users = User::Where('id', $id)->first();
        $roles = Role::all();
        // lalu tampilkan halaman dari view edit dengan mengirim data yang ada di variable todo
        return view('admin.editUser', compact('users', 'roles'));
    }

    public function userUpdate(Request $request, $id)
    {
        //validasi
        $request->validate([
            'nama' => 'required|min:3|max:25',
            'nohp' => 'required|min:5|max:13',
            'email' => 'required',
            // 'password' => 'required|min:6|max:13',
            'jabatan' => 'required',
            'alamat' => 'required',
        ]);
        User::where('id', $id)->update([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'email' => $request->email,
            // 'password' => Hash::make($request->password), //request password itu adalah password
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'role_id' => $request->jabatan,
            'status' => 0,
        ]);
        //redirect apabila berhasil bersama dengan alert-nya
        return redirect()->route('adduser')->with('successUpdate','Berhasil mengupdate data user!');
    }

    public function userReset(Request $request, $id)
    {
        User::where('id', $id)->update([
            'password' => Hash::make(1234567890), //request password itu adalah password
        ]);
        //redirect apabila berhasil bersama dengan alert-nya
        return redirect()->route('adduser')->with('successReset','Berhasil Melakukan Reset data user!');
    }

    public function search(Request $request)
    {
        $output="";

        $live_search=User::where('nama','LIKE','%'.$request->input('live_search').'%')
                        ->orWhere('email','LIKE','%'.$request->input('live_search').'%')
                        ->orWhere('nohp','LIKE','%'.$request->input('live_search').'%')
                        ->get();

                        if($live_search->count() > 0){
                            foreach($live_search as $user)
                            {
                                $jabatan = '';
                                if($user->jabatan == 1){
                                    $jabatan = 'Operator';
                                } else if($user->jabatan == 2){
                                    $jabatan = 'Staff';
                                } else if($user->jabatan == 3){
                                    $jabatan = 'Supervisor';
                                } else if($user->jabatan == 4){
                                    $jabatan = 'Superadmin';
                                }

                                $output.=

                                '<tr>

                                    <td>'. $user->nama .'</td>
                                    <td>'. $user->nohp .'</td>
                                    <td>'. $user->email .'</td>
                                    <td>'. $jabatan .'</td>
                                    <td>'. $user->alamat .'</td>
                                    <td>
                                        <form id="deleteForm'.$user->id.'" action="'.route('user.delete', $user->id).'" method="POST" class="delete-form">
                                            ' .csrf_field(). '
                                            ' .method_field('DELETE'). '
                                            <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>
                                        </form>

                                        <form id="editForm'.$user->id.'" action="'.route('user.edit', $user->id).'" method="GET">
                                            <button class="fa-solid fa-pen-to-square text-success btn"></button>
                                        </form>

                                        <form id="resetForm'.$user->id.'" action="'.route('user.reset', $user['id']).'" method="POST">
                                            '. @csrf_field() .'
                                            '. @method_field('PATCH') .'
                                            <button class="text-danger btn"><i class="ri-shield-keyhole-fill"></i></button>
                                        </form>
                                    </td>


                                </tr>';
                            }
                        } else {
                            $output = '<tr><td colspan="6" class="text-center">Not found</td></tr>';
                        }

                        return response($output);

        // foreach($live_search as $user)
        // {
        //     $output.=

        //     '<tr>

        //         <td>' .$user->nama. '</td>
        //         <td>' .$user->nohp. '</td>
        //         <td>' .$user->email. '</td>
        //         <td>' .$user->jabatan. '</td>
        //         <td>' .$user->alamat. '</td>


        //     </tr>';
        // }
        // return response($output);
    }

    // public function isActiveUser()
    // {
    //     $user = Auth::user();

    //     if($user->is_active){
    //         return 'Active';
    //     }
    //     else{
    //         return 'Inactive';
    //     }
    // }
    // function isActiveUser($userId)
    // {
    //     $user = User::find($userId);
    //     return $user->isActive() ? 'Active' : 'Not Active';
    // }







    public function info(Request $request)
    {
        $futamis = Futami::where('delete', 0)->get();
        // if ($request->has('tanggal_uji') && $request->has('tanggal_selesai')) {
        //     $tanggal_uji = Carbon::parse($request->tanggal_uji)->toDateTimeString();
        //     $tanggal_selesai = Carbon::parse($request->tanggal_selesai)->toDateTimeString();
        //     $futamis->whereBetween('tanggal_uji', [$tanggal_uji, $tanggal_selesai]);
        // }

        // $futamis = $futamis->orderBy('id', 'desc')->paginate(5)->onEachSide(5); //desc adalah untuk mengurutkan data dari terahkir ke data paling awal
        // $futamis = $futamis->orderBy('id', 'asc')->paginate(5)->onEachSide(5); //asc untuk mengurutkan data paling awal hingga ke data paling akhir
        // return view('operator.history', compact('futamis'))->with('no', ($futamis->currentPage() - 1) * $futamis->perPage() + 1);

        // $futamis = Futami::all();
        // $futami_sampel_kimia = Futami_sampel_kimia::all();
        return view('admin.info', compact('futamis'))->with('no');
    }


    public function history(Request $request)
    {
        $futamis = Futami::where('delete', 1)->get();
        return view('admin.history', compact('futamis'))->with('no');
    }
    public function superadmin_analisakimiapdf($id)
    {
        $futami_sampel_kimia = Futami_sampel_kimia::where('id_analisa_kimia', $id)->get();
        $futami = Futami::where('id', $id)->first();

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
        $pdf = PDF::loadView('pdf.analisa_kimia_pdf', array('futami' => $futami, 'futami_sampel_kimia'=>$futami_sampel_kimia))->setPaper('a5', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream();
        $filename = 'Laporan Analisa Kimia ' . $futami->nodokumen . '.pdf';
        return $pdf->stream($filename);
    }

    public function superadmin_analisakimia_excel($id)
    {
        $futami_sampel_kimia = Futami_sampel_kimia::where('id_analisa_kimia', $id)->get();
        $futami = Futami::where('id', $id)->first();

        return view('Excel.analisakimia', compact('futami', 'futami_sampel_kimia'));
    }

    public function superadmin_analisakimia_excel_show($id)
    {
        $futami_sampel_kimia = Futami_sampel_kimia::where('id_analisa_kimia', $id)->get();
        $futami = Futami::where('id', $id)->first();

        return view('Excel.Show_analisakimia', compact('futami', 'futami_sampel_kimia'));
    }

}
