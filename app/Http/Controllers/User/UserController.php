<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\prestasi;
use App\Models\AlamatMhs;
use App\Models\kompetisi;
use App\Models\MhsSekolah;
use App\Models\DataKeluarga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\KompetisiMahasiswaHasil;
use App\Models\Mhs_status_alumni;
use App\Models\AlumniStatus;
use App\Models\MhsBiodata;
use App\Models\Alumni;
use App\Models\Alumni\AlumniBekerjaHistori;
use App\Models\Alumni\AlumniWirausahaHistori;
use App\Models\Alumni\AlumniStudiLanjutHistori;
use App\Models\Master\StatusPekerjaan;
use App\Helpers\DateHelper;

class UserController extends Controller
{
    public function __construct(){
        $this->mhs_biodata = new MhsBiodata();
        $this->data_keluarga = new DataKeluarga();
        $this->alumni_bekerja_histori = new AlumniBekerjaHistori();
        $this->alumni_wirausaha_histori = new AlumniWirausahaHistori();
        $this->alumni_studi_lanjut_histori = new AlumniStudiLanjutHistori();
    }

    public function biodata()
    {
        // $status = AlumniStatus::all();
        // dd(Auth::user()->MhsPekerjaanModel);
        $result = $this->mhs_biodata;
        $result = $result->where("user_id",Auth::user()->id);
        $result = $result->first();

        $pendataan_alumni = false;

        if(!empty($result->tahun_masuk)){
            $year_now = date("Y");
            
            if(($result->tahun_masuk + 3) <= $year_now){
                $pendataan_alumni = true;
            }
        }

        $waktu_tunggu = "";
        $waktu_tunggu_detail = "";

        if(!empty($result->user->alumni->status_pekerjaan_id) && !empty($result->user->alumni->tanggal_terbit_ijasah) && $result->user->alumni->status_verifikasi == Alumni::STATUS_VERIFIKASI_YES){
            if($result->user->alumni->status_pekerjaan_id == StatusPekerjaan::BEKERJA){
                if(!empty($result->user->alumni_bekerja->tanggal_mulai)){
                    $tanggal_akhir = $result->user->alumni_bekerja->tanggal_mulai;
                    $tanggal_awal = $result->user->alumni->tanggal_terbit_ijasah;

                    $diff = DateHelper::different_date($tanggal_akhir,$tanggal_awal);

                    $bulan = $diff["months"];

                    if($diff["years"] >= 1){
                        $bulan = (int)$diff["years"]*12;
                    }
                    
                    $waktu_tunggu = "Masa tunggu untuk bekerja sejak diterbitkannya ijasah yaitu".(($bulan <= 6) ? " < " : " > ")."6 bulan";

                    $waktu_tunggu_detail = "Waktu tunggu = ".$diff["years"]." tahun ".$diff["months"]." bulan ".$diff["days"]." hari";
                } 
            }

            else if($result->user->alumni->status_pekerjaan_id == StatusPekerjaan::MEMBUKA_USAHA){
                if(!empty($result->user->alumni_wirausaha->tanggal_mulai)){
                    $tanggal_akhir = $result->user->alumni_wirausaha->tanggal_mulai;
                    $tanggal_awal = $result->user->alumni->tanggal_terbit_ijasah;

                    $diff = DateHelper::different_date($tanggal_akhir,$tanggal_awal);

                    $bulan = $diff["months"];

                    if($diff["years"] >= 1){
                        $bulan = (int)$diff["years"]*12;
                    }
                    
                    $waktu_tunggu = "Masa tunggu untuk membuka usaha sejak diterbitkannya ijasah yaitu".(($bulan <= 6) ? " < " : " > ")."6 bulan";

                    $waktu_tunggu_detail = "Waktu tunggu = ".$diff["years"]." tahun ".$diff["months"]." bulan ".$diff["days"]." hari";
                } 
            }

            else if($result->user->alumni->status_pekerjaan_id == StatusPekerjaan::STUDI_LANJUT){
                if(!empty($result->user->alumni_studi_lanjut->tanggal_mulai)){
                    $tanggal_akhir = $result->user->alumni_studi_lanjut->tanggal_mulai;
                    $tanggal_awal = $result->user->alumni->tanggal_terbit_ijasah;

                    $diff = DateHelper::different_date($tanggal_akhir,$tanggal_awal);

                    $bulan = $diff["months"];

                    if($diff["years"] >= 1){
                        $bulan = (int)$diff["years"]*12;
                    }
                    
                    $waktu_tunggu = "Masa tunggu untuk studi lanjut sejak diterbitkannya ijasah yaitu".(($bulan <= 6) ? " < " : " > ")."6 bulan";

                    $waktu_tunggu_detail = "Waktu tunggu = ".$diff["years"]." tahun ".$diff["months"]." bulan ".$diff["days"]." hari";
                } 
            }
        }

        $bekerja = $this->alumni_bekerja_histori;
        $bekerja = $bekerja->where("user_id",Auth::user()->id);
        $bekerja = $bekerja->orderBy("created_at","DESC");
        $bekerja = $bekerja->get();

        $wirausaha = $this->alumni_wirausaha_histori;
        $wirausaha = $wirausaha->where("user_id",Auth::user()->id);
        $wirausaha = $wirausaha->orderBy("created_at","DESC");
        $wirausaha = $wirausaha->get();

        $studi_lanjut = $this->alumni_studi_lanjut_histori;
        $studi_lanjut = $studi_lanjut->where("user_id",Auth::user()->id);
        $studi_lanjut = $studi_lanjut->orderBy("created_at","DESC");
        $studi_lanjut = $studi_lanjut->get();

        if((Auth::user()->alumni_bekerja_histori->count() >= 1 && Auth::user()->alumni_wirausaha_histori->count() >= 1 ) || (Auth::user()->alumni_bekerja_histori->count() >= 1 && Auth::user()->alumni_studi_lanjut_histori->count() >= 1 ) || (Auth::user()->alumni_wirausaha_histori->count() >= 1 && Auth::user()->alumni_studi_lanjut_histori->count() >= 1 ) || (Auth::user()->alumni_bekerja_histori->count() >= 1 && Auth::user()->alumni_wirausaha_histori->count() >= 1 && Auth::user()->alumni_studi_lanjut_histori->count() >= 1) || Auth::user()->alumni_bekerja_histori->count() >= 2 || Auth::user()->alumni_wirausaha_histori->count() >= 2 || Auth::user()->alumni_studi_lanjut_histori->count() >= 2){
            $waktu_tunggu = null;
            $waktu_tunggu_detail = null;
        }

        $data = [
            'result' => $result,
            'pendataan_alumni' => $pendataan_alumni,
            'waktu_tunggu' => $waktu_tunggu,
            'waktu_tunggu_detail' => $waktu_tunggu_detail,
            'bekerja' => $bekerja,
            'wirausaha' => $wirausaha,
            'studi_lanjut' => $studi_lanjut,
        ];

        return view('user.biodata', $data);
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
        return redirect()->route('mhs.biodata', $id);
    }

    public function prestasi()
    {
        $users = prestasi::all();
        $mhs = user::all();
        $kompetisi = kompetisi::all();
        $hasil = KompetisiMahasiswaHasil::all();
        return view('user.prestasi.index', compact('users', 'mhs', 'kompetisi', 'hasil'));
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
        return redirect()->route('mhs.prestasi.index');
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
        return redirect()->route('mhs.prestasi.index');
    }

    public function delete($id)
    {
        $del = prestasi::find($id);
        $del->delete();
        return redirect()->route('mhs.prestasi.index');
    }

    public function storeAlumniStatus(Request $request){
        Mhs_status_alumni::create([
            'user_id' => Auth::user()->id,
            'status_alumni' => 0
        ]);
        return redirect()->back();
    }

    public function Permintaan_alumni_update(Request $request, $status, $id){
        $data = [
            'status_alumni' => 0,
        ];
        $alumni = Mhs_status_alumni::whereId($id)->update($data);
        return redirect()->back()->withInput();
    }
}
