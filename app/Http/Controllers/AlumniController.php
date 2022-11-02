<?php

namespace App\Http\Controllers;

use Whoops\Run;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Alumni;
use App\Models\prestasi;
use App\Models\AlamatMhs;
use App\Models\kompetisi;
use App\Models\AlumniAkun;
use App\Models\MhsSekolah;
use App\Models\AlumniKerja;
use App\Models\AlumniKuliah;
use App\Models\AlumniStatus;
use App\Models\DataKeluarga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\KompetisiMahasiswaHasil;
use App\Models\Mhs_status_alumni;

class AlumniController extends Controller
{

    public function index()
    {
        $user = User::all();
        $status = AlumniStatus::all();
        $sts = Alumni::all();
        return view('alumni.tambah_alumni', compact('sts', 'user', 'status'));
    }


    public function storeAlumni(Request $request)
    {

        $data = $request->all();
        $data = request()->except(['_token']);
        if ($request->hasFile('foto') != null) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileNameToStore = $request->name . '_' . time() . '.' . $extension;
            $path = $request->file('foto')->move('foto', $fileNameToStore);

            $data['foto'] = $path;
        }
        AlumniAkun::Create($data);

        return redirect()->route('mawa.index');
    }
    public function storeAlumniKerja(Request $request, $id)
    {

        // if (AlumniKerja::whereUserId($id)->get()) {
        //     $kerja = AlumniKerja::whereUserId($id)->Update([
        //         'user_id' => Auth::user()->id,
        //         'nama_instansi' => $request->nama_instansi,
        //         'alamat_kerja' => $request->alamat_kerja,
        //         'jabatan' => $request->jabatan,
        //         'tahun_masuk' => $request->tahun_masuk,
        //     ]);
        // } else {
        $kerja =   AlumniKerja::Create([
            'user_id' => Auth::user()->id,
            'nama_instansi' => $request->nama_instansi,
            'alamat_kerja' => $request->alamat_kerja,
            'jabatan' => $request->jabatan,
            'tahun_masuk' => $request->tahun_masuk,
        ]);
        // }

        return redirect()->route('mawa.index');
    }
    public function updateAlumniKerja(Request $request, $id)
    {

        // if (AlumniKerja::whereUserId($id)->get()) {
        $kerja = AlumniKerja::whereUserId($id)->Update([
            'user_id' => Auth::user()->id,
            'nama_instansi' => $request->nama_instansi,
            'alamat_kerja' => $request->alamat_kerja,
            'jabatan' => $request->jabatan,
            'tahun_masuk' => $request->tahun_masuk,
        ]);
        // } else {

        return redirect()->route('mawa.index');
    }

    public function storeAlumniKuliah(Request $request, $id)
    {

        $alumni =   AlumniKuliah::Create([
            'user_id' => Auth::user()->id,
            'nama_univ' => $request->nama_univ,
            'alamat_instansi' => $request->alamat_instansi,
            'jurusan' => $request->jurusan,
        ]);
        // }

        return redirect()->route('mawa.index');
    }
    public function updateAlumniKuliah(Request $request, $id)
    {
        // if (AlumniKuliah::whereUserId($id)->get()) {
        $alumni =   AlumniKuliah::whereUserId(Auth::user()->id)->Update([
            'user_id' => Auth::user()->id,
            'nama_univ' => $request->nama_univ,
            'alamat_instansi' => $request->alamat_instansi,
            'jurusan' => $request->jurusan,
        ]);


        return redirect()->route('mawa.index');
    }
    public function biodata()
    {
        return view('alumni.biodata');
    }
    public function mhsStore(Request $request, $id)
    {


        if (AlamatMhs::whereUserId(!$id)->get()) {
            AlamatMhs::whereUserId($id)->update([
                'nim' => $request->nim,
                'alamat_status' => $request->alamat_status,
                'alamat_tinggal' => $request->alamat_tinggal,
            ]);
            MhsSekolah::whereUserId($id)->update([
                'nim' => $request->nim,
                'jenis_sekolah_atas' => $request->jenis_sekolah_atas,
                'nama_sekolah_atas' => $request->nama_sekolah_atas,
                'nama_smp' => $request->nama_smp,
                'nama_sd' => $request->nama_sd,
            ]);
            DataKeluarga::whereUserId($id)->update([
                'nim' => $request->nim,
                'ibu_nama' => $request->ibu_nama,
                'ibu_alamat' => $request->ibu_alamat,
                'ibu_gaji' => $request->ibu_gaji,
                'ibu_telepon' => $request->ibu_telepon,
                'ibu_pendidikan_terakhir' => $request->ibu_pendidikan_terakhir,
                'ibu_pekerjaan' => $request->ibu_pekerjaan,
                'ibu_gaji' => $request->ibu_gaji,
                'ayah_nama' => $request->ayah_nama,
                'ayah_alamat' => $request->ayah_alamat,
                'ayah_telepon' => $request->ayah_telepon,
                'ayah_pendidikan_terakhir' => $request->ayah_pendidikan_terakhir,
                'ayah_pekerjaan' => $request->ayah_pekerjaan,
                'ayah_gaji' => $request->ayah_gaji,
                'kakak_jumlah' => $request->kakak_jumlah,
                'adik_jumlah' => $request->adik_jumlah
            ]);
        }

        if (AlamatMhs::whereUserId($id)->get()) {
            AlamatMhs::UpdateOrCreate([
                'user_id' => $id,
                'nim' => $request->nim,
                'alamat_status' => $request->alamat_status,
                'alamat_tinggal' => $request->alamat_tinggal,
            ]);
            MhsSekolah::UpdateOrCreate([
                'user_id' => $id,
                'nim' => $request->nim,
                'jenis_sekolah_atas' => $request->jenis_sekolah_atas,
                'nama_sekolah_atas' => $request->nama_sekolah_atas,
                'nama_smp' => $request->nama_smp,
                'nama_sd' => $request->nama_sd,
            ]);
            DataKeluarga::UpdateOrCreate([
                'user_id' => $id,
                'nim' => $request->nim,
                'ibu_nama' => $request->ibu_nama,
                'ibu_alamat' => $request->ibu_alamat,
                'ibu_gaji' => $request->ibu_gaji,
                'ibu_telepon' => $request->ibu_telepon,
                'ibu_pendidikan_terakhir' => $request->ibu_pendidikan_terakhir,
                'ibu_pekerjaan' => $request->ibu_pekerjaan,
                'ibu_gaji' => $request->ibu_gaji,
                'ayah_nama' => $request->ayah_nama,
                'ayah_alamat' => $request->ayah_alamat,
                'ayah_telepon' => $request->ayah_telepon,
                'ayah_pendidikan_terakhir' => $request->ayah_pendidikan_terakhir,
                'ayah_pekerjaan' => $request->ayah_pekerjaan,
                'ayah_gaji' => $request->ayah_gaji,
                'kakak_jumlah' => $request->kakak_jumlah,
                'adik_jumlah' => $request->adik_jumlah
            ]);
        }
        return redirect()->route('mawa.biodata', $id);
    }

    public function prestasi()
    {
        $users = prestasi::all();
        $mhs = user::all();
        $kompetisi = kompetisi::all();
        $hasil = KompetisiMahasiswaHasil::all();
        return view('alumni.prestasi.index', compact('users', 'mhs', 'kompetisi', 'hasil'));
    }
    public function store(Request $request)
    {
        prestasi::create([
            'user_id' => Auth::user()->id,
            'id_kompetisi' => $request->id_kompetisi,
            'team' => $request->team,
            'id_kompetisi_hasil' => $request->id_kompetisi_hasil,
            'status' => true,
            'tanggal_upload' => Carbon::now()
        ]);
        return redirect()->route('mawa.prestasi.index');
    }
    public function update(Request $request, $id)
    {
        prestasi::whereUserId(Auth::user()->id)->update([
            'user_id' => Auth::user()->id,
            'id_kompetisi' => $request->id_kompetisi,
            'team' => $request->team,
            'id_kompetisi_hasil' => $request->id_kompetisi_hasil,
            'status' => true,
            'tanggal_upload' => Carbon::now()
        ]);
        return redirect()->route('mawa.prestasi.index');
    }

    public function delete($id)
    {
        $del = prestasi::find($id);
        $del->delete();
        return redirect()->route('mawa.prestasi.index');
    }

}
