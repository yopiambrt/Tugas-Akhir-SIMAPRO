<?php

namespace App\Http\Controllers\Pegawai;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Alumni;
use App\Models\Jenjang;
use App\Models\Fakultas;
use App\Models\prestasi;
use App\Models\AlamatMhs;
use App\Models\kompetisi;
use App\Models\MhsSekolah;
use App\Models\AlumniKerja;
use App\Models\AlumniKuliah;
use App\Models\DataKeluarga;
use Illuminate\Http\Request;
use App\Models\kegiatanSkala;
use App\Models\KompetisiDana;
use App\Models\KompetisiLabel;
use App\Models\KompetisiPoster;
use App\Models\KompetisiPanduan;
use App\Models\KompetisiKategori;
use App\Models\KompetisiMahasiswa;
use App\Http\Controllers\Controller;
use App\Models\KompetisiDaftarLabel;
use Illuminate\Support\Facades\Auth;
use App\Models\kompetisiPenyelenggara;
use App\Models\KompetisiDaftarKategori;
use App\Models\KompetisiMahasiswaHasil;
use App\Models\kompetisiPenyelenggaraJenis;

class PegawaiController extends Controller
{
    public function indexAlumni()
    {
        $sts = Alumni::all();
        return view('alumni.alumni', compact('sts'));
    }

    public function storeAlumni(Request $request)
    {

        if (Alumni::whereUserId(Auth::user()->id)->get()) {
            Alumni::whereUserId(Auth::user()->id)->Update([
                'user_id' => Auth::user()->id,
                'status' => $request->status
            ]);
        } else {
            Alumni::Create([
                'user_id' => Auth::user()->id,
                'status' => $request->status
            ]);
        }
        if ($request->status == 'kerja') {
            $kerja = AlumniKerja::find(Auth::user()->id);
            return view('alumni.kerja', compact('kerja'));
        }
        if ($request->status == 'kuliah') {
            $kuliah = AlumniKuliah::find(Auth::user()->id);
            return view('alumni.kuliah', compact('kuliah'));
        }
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
    public function mhs()
    {
        $mhs = User::all();
        $users = User::all();
        $role = Role::all();
        return view('admin.mahasiswa.mhs', compact('mhs', 'role', 'users'));
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
    public function storePrestasi(Request $request)
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
    public function updatePrestasi(Request $request, $id)
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

    public function deletePrestasi($id)
    {
        $del = prestasi::find($id);
        $del->delete();
        return redirect()->route('mawa.prestasi.index');
    }
    public function index()
    {
        $users = prestasi::all();
        $mhs = user::all();
        $kompetisi = kompetisi::all();
        $hasil = KompetisiMahasiswaHasil::all();
        return view('pegawai.prestasi.index', compact('users', 'mhs', 'kompetisi', 'hasil'));
    }
    public function store(Request $request)
    {
        prestasi::create([
            'user_id' => $request->user_id,
            'id_kompetisi' => $request->id_kompetisi,
            'team' => $request->team,
            'id_kompetisi_hasil' => $request->id_kompetisi_hasil,
            'status' => true,
            'tanggal_upload' => Carbon::now()
        ]);
        return redirect()->route('pegawai.prestasi.index');
    }
    public function update(Request $request, $id)
    {
        prestasi::whereId($id)->update([
            'user_id' => $request->user_id,
            'id_kompetisi' => $request->id_kompetisi,
            'team' => $request->team,
            'id_kompetisi_hasil' => $request->id_kompetisi_hasil,
            'status' => true,
            'tanggal_upload' => Carbon::now()
        ]);
        return redirect()->route('pegawai.prestasi.index');
    }

    public function delete($id)
    {
        $del = prestasi::find($id);
        $del->delete();
        return redirect()->route('pegawai.prestasi.index');
    }


    //KompetisiMahasiswa
    public function indexKompetisiMahasiswa()
    {
        $KompetisiMahasiswa = kompetisi::all();
        return view('pegawai.kompetisi.Kompetisi', compact('KompetisiMahasiswa'));
    }
    public function createKompetisiMahasiswa()
    {
        $kompetisiPenyelenggara = kompetisiPenyelenggara::all();
        $kegiatanSkala = kegiatanSkala::all();
        return view('pegawai.kompetisi.CreateKompetisiMahasiswa', compact('kegiatanSkala', 'kompetisiPenyelenggara'));
    }
    public function showKompetisiMahasiswa($id)
    {
        $kompetisiPenyelenggara = kompetisiPenyelenggara::all();
        $kegiatanSkala = kegiatanSkala::all();
        $kompetisi = Kompetisi::find($id);
        return view('pegawai.kompetisi.ShowKompetisiMahasiswa', compact('kompetisi', 'kegiatanSkala', 'kompetisiPenyelenggara'));
    }
    public function detailKompetisiMahasiswa($id)
    {
        $kompetisiPenyelenggara = kompetisiPenyelenggara::all();
        $kegiatanSkala = kegiatanSkala::all();
        $kompetisi = Kompetisi::find($id);
        return view('pegawai.kompetisi.detail_kompetisi', compact('kompetisi', 'kegiatanSkala', 'kompetisiPenyelenggara'));
    }
    public function deleteKompetisiMahasiswa($id)
    {
        $kompetisi = Kompetisi::find($id);
        $kompetisi->delete();
        return redirect()->route('pegawai.KompetisiMahasiswa.index');
    }
    public function storeKompetisiMahasiswa(Request $request)
    {
        $Kompetisi = kompetisi::create([
            'id_kegiatan_skala' => $request->id_kegiatan_skala,
            'kepanjangan' => $request->kepanjangan,
            'deskripsi' => $request->deskripsi,
            'periode' => $request->periode,
            'akun_update' => Carbon::now(),
            'akun_create' => Carbon::now(),
            'keterangan' => $request->keterangan,
            'id_kompetisi_penyelenggara' => $request->id_kompetisi_penyelenggara,
            'nama' => $request->nama,
            'kota_kabupaten' => $request->kota_kabupaten,
            'register_buka' => $request->register_buka,
            'pelaksanaan_awal' => $request->pelaksanaan_awal,
            'pelaksanaan_akhir' => $request->pelaksanaan_akhir,
            'register_tutup' => $request->register_tutup,
            'hadiah' => $request->hadiah,
            'biaya' => $request->biaya,
            'tautan' => $request->tautan

        ]);
        return redirect()->route('pegawai.KompetisiMahasiswa.index');
    }
    public function updateKompetisiMahasiswa(Request $request, $id)
    {
        $Kompetisi = kompetisi::whereId($id)->update([
            'id_kegiatan_skala' => $request->id_kegiatan_skala,
            'kepanjangan' => $request->kepanjangan,
            'deskripsi' => $request->deskripsi,
            'periode' => $request->periode,
            'akun_update' => Carbon::now(),
            'keterangan' => $request->keterangan,
            'id_kompetisi_penyelenggara' => $request->id_kompetisi_penyelenggara,
            'nama' => $request->nama,
            'kota_kabupaten' => $request->kota_kabupaten,
            'register_buka' => $request->register_buka,
            'pelaksanaan_awal' => $request->pelaksanaan_awal,
            'pelaksanaan_akhir' => $request->pelaksanaan_akhir,
            'register_tutup' => $request->register_tutup,
            'hadiah' => $request->hadiah,
            'biaya' => $request->biaya,
            'tautan' => $request->tautan

        ]);
        return redirect()->route('pegawai.KompetisiMahasiswa.index');
    }
    // KompetisiPenyelenggaraJenis
    public function indexKompetisiPenyelenggaraJenis()
    {
        $kompetisiPenyelenggaraJenis = kompetisiPenyelenggaraJenis::all();
        return view('pegawai.kompetisi.kompetisi_penyelenggara_jenis', compact('kompetisiPenyelenggaraJenis'));
    }

    public function storeKompetisiPenyelenggaraJenis(Request $request)
    {
        kompetisiPenyelenggaraJenis::create([
            'jenis_penyelenggara' => $request->jenis_penyelenggara,
            'urutan' => $request->urutan,
        ]);

        return redirect()->route('pegawai.KompetisiPenyelenggaraJenis.index');
    }

    public function updateKompetisiPenyelenggaraJenis(Request $request, $id)
    {
        kompetisiPenyelenggaraJenis::whereId($id)->update([
            'jenis_penyelenggara' => $request->jenis_penyelenggara,
            'urutan' => $request->urutan,
        ]);
        return redirect()->route('pegawai.KompetisiPenyelenggaraJenis.index');
    }
    public function deleteKompetisiPenyelenggaraJenis($id)
    {
        $kpj = kompetisiPenyelenggaraJenis::find($id);
        $kpj->delete();

        return redirect()->route('pegawai.KompetisiPenyelenggaraJenis.index');
    }

    // KompetisiPenyelenggara
    public function indexKompetisiPenyelenggara()
    {
        $kompetisiPenyelenggara = kompetisiPenyelenggara::all();
        $kompetisiPenyelenggaraJenis = kompetisiPenyelenggaraJenis::all();
        return view('pegawai.kompetisi.kompetisi_penyelenggara', compact('kompetisiPenyelenggara', 'kompetisiPenyelenggaraJenis'));
    }
    public function storeKompetisiPenyelenggara(Request $request)
    {
        kompetisiPenyelenggara::create([
            'id_kompetisi_penyelenggara_jenis' => $request->id_kompetisi_penyelenggara_jenis,
            'nama_penyelenggara' => $request->nama_penyelenggara,
            'urutan' => $request->urutan,
        ]);
        return redirect()->route('pegawai.KompetisiPenyelenggara.index');
    }
    public function updateKompetisiPenyelenggara(Request $request, $id)
    {
        kompetisiPenyelenggara::whereId($id)->update([
            'id_kompetisi_penyelenggara_jenis' => $request->id_kompetisi_penyelenggara_jenis,
            'nama_penyelenggara' => $request->nama_penyelenggara,
            'urutan' => $request->urutan,
        ]);
        return redirect()->route('pegawai.KompetisiPenyelenggara.index');
    }
    public function deleteKompetisiPenyelenggara($id)
    {
        $kp = kompetisiPenyelenggara::find($id);
        $kp->delete();

        return redirect()->route('pegawai.KompetisiPenyelenggara.index');
    }

    // KegiatanSkala
    public function indexKegiatanSkala()
    {
        $kegiatanSkala = kegiatanSkala::all();
        return view('pegawai.kompetisi.Kegiatan_skala', compact('kegiatanSkala'));
    }
    public function storeKegiatanSkala(Request $request)
    {
        kegiatanSkala::create([
            'skala' => $request->skala,
        ]);

        return redirect()->route('pegawai.KegiatanSkala.index');
    }
    public function updateKegiatanSkala(Request $request, $id)
    {
        kegiatanSkala::whereId($id)->update([
            'skala' => $request->skala,
        ]);
        return redirect()->route('pegawai.KegiatanSkala.index');
    }
    public function deleteKegiatanSkala($id)
    {
        $KegiatanSkala = KegiatanSkala::find($id);
        $KegiatanSkala->delete();
        return redirect()->route('pegawai.KegiatanSkala.index');
    }

    // KompetisiDaftarKategori
    public function indexKompetisiDaftarKategori()
    {
        $KompetisiMahasiswa = kompetisi::all();
        $KompetisiKategori = KompetisiKategori::all();
        $KompetisiDaftarKategori = KompetisiDaftarKategori::all();
        return view('pegawai.kompetisi.kompetisi_daftar_kategori', compact('KompetisiDaftarKategori', 'KompetisiMahasiswa', 'KompetisiKategori'));
    }
    public function storeKompetisiDaftarKategori(Request $request)
    {
        KompetisiDaftarKategori::create([
            'id_kompetisi' => $request->id_kompetisi,
            'id_kompetisi_kategori' => $request->id_kompetisi_kategori,
        ]);

        return redirect()->route('pegawai.KompetisiDaftarKategori.index');
    }
    public function updateKompetisiDaftarKategori(Request $request, $id)
    {
        KompetisiDaftarKategori::whereId($id)->update([
            'id_kompetisi' => $request->id_kompetisi,
            'id_kompetisi_kategori' => $request->id_kompetisi_kategori,
        ]);

        return redirect()->route('pegawai.KompetisiDaftarKategori.index');
    }
    public function deleteKompetisiDaftarKategori($id)
    {
        $KompetisiDaftarKategori = KompetisiDaftarKategori::find($id);
        $KompetisiDaftarKategori->delete();

        return redirect()->route('pegawai.KompetisiDaftarKategori.index');
    }

    // KompetisiKategori
    public function indexKompetisiKategori()
    {
        $KompetisiKategori = KompetisiKategori::all();
        return view('pegawai.kompetisi.kategori_kompetisi', compact('KompetisiKategori'));
    }
    public function storeKompetisiKategori(Request $request)
    {
        KompetisiKategori::create([
            'nama_kategori' => $request->nama_kategori,
            'urutan' => $request->urutan,
        ]);
        return redirect()->route('pegawai.KompetisiKategori.index');
    }
    public function updateKompetisiKategori(Request $request, $id)
    {
        KompetisiKategori::whereId($id)->update([
            'nama_kategori' => $request->nama_kategori,
            'urutan' => $request->urutan,
        ]);
        return redirect()->route('pegawai.KompetisiKategori.index');
    }
    public function deleteKompetisiKategori($id)
    {
        $KompetisiKategori = KompetisiKategori::find($id);
        $KompetisiKategori->delete();
        return redirect()->route('pegawai.KompetisiKategori.index');
    }

    // KompetisiDaftarLabel
    public function indexKompetisiDaftarLabel()
    {
        $KompetisiMahasiswa = Kompetisi::all();
        $KompetisiLabel = KompetisiLabel::all();
        $KompetisiDaftarLabel = KompetisiDaftarLabel::all();
        return view('pegawai.kompetisi.kompetisi_daftar_label', compact('KompetisiDaftarLabel', 'KompetisiLabel', 'KompetisiMahasiswa'));
    }
    public function storeKompetisiDaftarLabel(Request $request)
    {
        KompetisiDaftarLabel::create([
            'id_kompetisi' => $request->id_kompetisi,
            'id_kompetisi_label' => $request->id_kompetisi_label
        ]);
        return redirect()->route('pegawai.KompetisiDaftarLabel.index');
    }
    public function updateKompetisiDaftarLabel(Request $request, $id)
    {
        KompetisiDaftarLabel::whereId($id)->update([
            'id_kompetisi' => $request->id_kompetisi,
            'id_kompetisi_label' => $request->id_kompetisi_label
        ]);
        return redirect()->route('pegawai.KompetisiDaftarLabel.index');
    }
    public function deleteKompetisiDaftarLabel($id)
    {
        $KompetisiDaftarLabel = KompetisiDaftarLabel::find($id);
        $KompetisiDaftarLabel->delete();
        return redirect()->route('pegawai.KompetisiDaftarLabel.index');
    }

    // KompetisiLabel
    public function indexKompetisiLabel()
    {
        $KompetisiLabel = KompetisiLabel::all();
        return view('pegawai.kompetisi.label_kompetisi', compact('KompetisiLabel'));
    }
    public function storeKompetisiLabel(Request $request)
    {
        KompetisiLabel::create([
            'nama_label' => $request->nama_label
        ]);

        return redirect()->route('pegawai.KompetisiLabel.index');
    }
    public function updateKompetisiLabel(Request $request, $id)
    {
        KompetisiLabel::whereId($id)->update([
            'nama_label' => $request->nama_label
        ]);
        return redirect()->route('pegawai.KompetisiLabel.index');
    }
    public function deleteKompetisiLabel($id)
    {
        $KompetisiLabel = KompetisiLabel::find($id);
        $KompetisiLabel->delete();
        return redirect()->route('pegawai.KompetisiLabel.index');
    }

    // KompetisiPoster
    public function indexKompetisiPoster()
    {
        $KompetisiPoster = KompetisiPoster::all();
        $KompetisiMahasiswa = Kompetisi::all();
        return view('pegawai.kompetisi.poster_kompetisi', compact('KompetisiPoster', 'KompetisiMahasiswa'));
    }
    public function storeKompetisiPoster(Request $request)
    {
        $data = $request->all();
        $data = request()->except(['_token']);
        if ($request->hasFile('poster') != null) {
            $extension = $request->file('poster')->getClientOriginalExtension();
            $fileNameToStore = $request->name . '_' . time() . '.' . $extension;
            $path = $request->file('poster')->move('poster', $fileNameToStore);

            $data['poster'] = $path;
        }
        KompetisiPoster::create($data);
        return redirect()->route('pegawai.KompetisiPoster.index');
    }
    public function updateKompetisiPoster(Request $request, $id)
    {
        KompetisiPoster::whereId($id)->update([
            'id_kompetisi' => $request->id_kompetisi,
            'poster' => $request->poster
        ]);

        return redirect()->route('pegawai.KompetisiPoster.index');
    }
    public function deleteKompetisiPoster($id)
    {
        $KompetisiPoster = KompetisiPoster::find($id);
        $KompetisiPoster->delete();
        return redirect()->route('pegawai.KompetisiPoster.index');
    }

    // KompetisiPanduan
    public function indexKompetisiPanduan()
    {
        $KompetisiPanduan = KompetisiPanduan::all();
        $KompetisiMahasiswa = kompetisi::all();
        return view('pegawai.kompetisi.kompetisi_panduan', compact('KompetisiPanduan', 'KompetisiMahasiswa'));
    }
    public function storeKompetisiPanduan(Request $request)
    {
        KompetisiPanduan::create([
            'id_kompetisi' => $request->id_kompetisi,
            'panduan' => $request->panduan,
        ]);

        return redirect()->route('pegawai.KompetisiPanduan.index');
    }
    public function updateKompetisiPanduan(Request $request, $id)
    {
        KompetisiPanduan::whereId($id)->update([
            'id_kompetisi' => $request->id_kompetisi,
            'panduan' => $request->panduan,
        ]);
        return redirect()->route('pegawai.KompetisiPanduan.index');
    }
    public function deleteKompetisiPanduan($id)
    {
        $KompetisiPanduan = KompetisiPanduan::find($id);
        $KompetisiPanduan->delete();
        return redirect()->route('pegawai.KompetisiPanduan.index');
    }

    public function indexFakultas()
    {
        $fakultas = Fakultas::all();
        return view('pegawai.master.fakultas', compact('fakultas'));
    }
    public function storeFakultas(Request $request)
    {
        Fakultas::create(['nama_fakultas' => $request->nama_fakultas]);
        return redirect()->route('pegawai.fakultas.index');
    }
    public function updateFakultas(Request $request, $id)
    {
        Fakultas::whereId($id)->update(['nama_fakultas' => $request->nama_fakultas]);
        return redirect()->route('pegawai.fakultas.index');
    }
    public function destroyFakultas(Request $request, $id)
    {
        $fakultas = Fakultas::find($id);
        $fakultas->delete($fakultas);
        return redirect()->route('pegawai.fakultas.index');
    }

    //Program Studi
    public function indexProdi()
    {
        $fakultas = Fakultas::all();
        $jenjang = Jenjang::all();
        $prodi = Prodi::all();
        return view('pegawai.master.prodi', compact('prodi', 'fakultas', 'jenjang'));
    }
    public function storeProdi(Request $request)
    {
        Prodi::create([
            'id_fakultas' => $request->id_fakultas,
            'id_jenjang' => $request->id_jenjang,
            'nama_prodi' => $request->nama_prodi,
        ]);
        return redirect()->route('pegawai.prodi.index');
    }
    public function updateProdi(Request $request, $id)
    {
        Prodi::whereId($id)->update([
            'id_fakultas' => $request->id_fakultas,
            'id_jenjang' => $request->id_jenjang,
            'nama_prodi' => $request->nama_prodi,
        ]);
        return redirect()->route('pegawai.prodi.index');
    }
    public function destroyProdi(Request $request, $id)
    {
        $prodi = Prodi::find($id);
        $prodi->delete();
        return redirect()->route('pegawai.prodi.index');
    }

    //Jenjang
    public function indexJenjang()
    {
        $jenjang = Jenjang::all();
        return view('pegawai.master.jenjang', compact('jenjang'));
    }
    public function storeJenjang(Request $request)
    {
        Jenjang::create([
            'nama_jenjang' => $request->nama_jenjang,
        ]);
        return redirect()->route('pegawai.jenjang.index');
    }
    public function updateJenjang(Request $request, $id)
    {
        Jenjang::whereId($id)->update([
            'nama_jenjang' => $request->nama_jenjang,
        ]);
        return redirect()->route('pegawai.jenjang.index');
    }
    public function destroyJenjang(Request $request, $id)
    {
        $jenjang = Jenjang::find($id);
        $jenjang->delete();
        return redirect()->route('pegawai.jenjang.index');
    }
}
