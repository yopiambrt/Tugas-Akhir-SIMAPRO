<?php

namespace App\Http\Controllers;

use App\Models\kompetisi;
use Illuminate\Http\Request;
use App\Models\kegiatanSkala;
use App\Models\KompetisiLabel;
use App\Models\KompetisiPoster;
use App\Models\KompetisiPanduan;
use App\Models\KompetisiKategori;
use App\Models\KompetisiDaftarLabel;
use App\Models\kompetisiPenyelenggara;
use App\Models\KompetisiDaftarKategori;
use App\Models\KompetisiDana;
use App\Models\KompetisiMahasiswa;
use App\Models\kompetisiPenyelenggaraJenis;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Null_;

class KompetisiController extends Controller
{
    //KompetisiMahasiswa
    public function indexKompetisiMahasiswa()
    {
        $KompetisiMahasiswa = Kompetisi::all();
        return view('admin.kompetisi.Kompetisi', compact('KompetisiMahasiswa'));
    }
    public function createKompetisiMahasiswa()
    {
        $kompetisiPenyelenggara = kompetisiPenyelenggara::all();
        $kegiatanSkala = kegiatanSkala::all();
        $kompetisilabel = KompetisiLabel::all();
        $kompetisikategori = KompetisiKategori::all();
        return view('admin.kompetisi.CreateKompetisiMahasiswa', compact('kegiatanSkala', 'kompetisiPenyelenggara', 'kompetisilabel', 'kompetisikategori'));
    }
    public function showKompetisiMahasiswa($id)
    {
        $kompetisiPenyelenggara = kompetisiPenyelenggara::all();
        $kegiatanSkala = kegiatanSkala::all();
        $kompetisi = Kompetisi::find($id);
        return view('admin.kompetisi.ShowKompetisiMahasiswa', compact('kompetisi', 'kegiatanSkala', 'kompetisiPenyelenggara'));
    }
    public function detailKompetisiMahasiswa($id)
    {
   
        $kompetisi = Kompetisi::find($id);
        $idkompetisipenyelenggara = $kompetisi['id_kompetisi_penyelenggara'];
        $kompetisiPenyelenggara = kompetisiPenyelenggara::where('id', $idkompetisipenyelenggara)->get();
        $idkompetisipenyelanggara_jenis = $kompetisiPenyelenggara[0]['id_kompetisi_penyelenggara_jenis'];
        $kompetisiPenyelenggara_jenis = kompetisiPenyelenggaraJenis::where('id', $idkompetisipenyelanggara_jenis)->get();
        $datapenyelanggara_jenis = $kompetisiPenyelenggara_jenis[0];
    
        $idkegiatanskala = $kompetisi['id_kegiatan_skala'];
        $kegiatanSkala = kegiatanSkala::where('id', $idkegiatanskala)->get();
        $datakegiatanskala = $kegiatanSkala[0];
       

        $idlabelkompetisi = $kompetisi['id_kompetisi_label'];
        $labelkompetisi = KompetisiLabel::where('id', $idlabelkompetisi)->get();
        $datalabelkompetisi = $labelkompetisi[0];
        
        $idkategorikompetisi = $kompetisi['id_kompetisi_kategori'];
        $kategorikompetisi = KompetisiKategori::where('id', $idkategorikompetisi)->get();
        $datakategorikompetisi = $kategorikompetisi[0];

        $poster = KompetisiPoster::where('id_kompetisi', $id)->get();
        if($poster == NULL){
            $dataposter = '#';
        }else{
            $dataposter = $poster[0]['poster'];
        }

        $panduan = KompetisiPanduan::where('id_kompetisi', $id)->get();
        if($panduan == NULL){
            $datapanduan = 'Panduan Kosong';
        }else{
            $datapanduan = $panduan[0]['panduan'];
           
        }
        
       
        return view('admin.kompetisi.detail_kompetisi', compact('kompetisi', 'kegiatanSkala', 'kompetisiPenyelenggara', 'datapenyelanggara_jenis', 'datakegiatanskala',
        'datalabelkompetisi', 'datakategorikompetisi',
    ), ['dataposter'=>$dataposter, 'datapanduan'=>$datapanduan]);
    }
    public function deleteKompetisiMahasiswa($id)
    {
        $kompetisi = Kompetisi::find($id);
        $kompetisi->delete();
        return redirect()->route('admin.KompetisiMahasiswa.index');
    }
    public function storeKompetisiMahasiswa(Request $request)
    {

        $kompetisi = new kompetisi;
        $kompetisi->id_kegiatan_skala = $request->id_kegiatan_skala;
        $kompetisi->id_kompetisi_label = $request->id_kompetisi_label ;
        $kompetisi->id_kompetisi_kategori = $request->id_kompetisi_kategori;
        $kompetisi->kepanjangan = $request->kepanjangan;
        $kompetisi->deskripsi = $request->deskripsi;
        $kompetisi->periode = $request->periode;
        $kompetisi->akun_update = Carbon::now();
        $kompetisi->akun_create = Carbon::now();
        $kompetisi->keterangan = $request->keterangan;
        $kompetisi->id_kompetisi_penyelenggara = $request->id_kompetisi_penyelenggara;
        $kompetisi->nama = $request->nama;
        $kompetisi->kota_kabupaten = $request->kota_kabupaten;
        $kompetisi->register_buka = $request->register_buka;
        $kompetisi->pelaksanaan_awal = $request->pelaksanaan_awal;
        $kompetisi->pelaksanaan_akhir = $request->pelaksanaan_akhir;
        $kompetisi->register_tutup = $request->register_tutup;
        $kompetisi->hadiah = $request->hadiah;
        $kompetisi->biaya = $request->biaya;
        $kompetisi->tautan = $request->tautan;
        $kompetisi->save();
        
            

 
        return redirect()->route('admin.KompetisiMahasiswa.index');
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
        return redirect()->route('admin.KompetisiMahasiswa.index');
    }
    // KompetisiPenyelenggaraJenis
    public function indexKompetisiPenyelenggaraJenis()
    {
        $kompetisiPenyelenggaraJenis = kompetisiPenyelenggaraJenis::all();
        return view('admin.kompetisi.kompetisi_penyelenggara_jenis', compact('kompetisiPenyelenggaraJenis'));
    }

    public function storeKompetisiPenyelenggaraJenis(Request $request)
    {
        kompetisiPenyelenggaraJenis::create([
            'jenis_penyelenggara' => $request->jenis_penyelenggara,
            'urutan' => $request->urutan,
        ]);

        return redirect()->route('admin.KompetisiPenyelenggaraJenis.index');
    }

    public function updateKompetisiPenyelenggaraJenis(Request $request, $id)
    {
        kompetisiPenyelenggaraJenis::whereId($id)->update([
            'jenis_penyelenggara' => $request->jenis_penyelenggara,
            'urutan' => $request->urutan,
        ]);
        return redirect()->route('admin.KompetisiPenyelenggaraJenis.index');
    }
    public function deleteKompetisiPenyelenggaraJenis($id)
    {
        $kpj = kompetisiPenyelenggaraJenis::find($id);
        $kpj->delete();

        return redirect()->route('admin.KompetisiPenyelenggaraJenis.index');
    }

    // KompetisiPenyelenggara
    public function indexKompetisiPenyelenggara()
    {
        $kompetisiPenyelenggara = kompetisiPenyelenggara::all();
        $kompetisiPenyelenggaraJenis = kompetisiPenyelenggaraJenis::all();
        return view('admin.kompetisi.kompetisi_penyelenggara', compact('kompetisiPenyelenggara', 'kompetisiPenyelenggaraJenis'));
    }
    public function storeKompetisiPenyelenggara(Request $request)
    {
        kompetisiPenyelenggara::create([
            'id_kompetisi_penyelenggara_jenis' => $request->id_kompetisi_penyelenggara_jenis,
            'nama_penyelenggara' => $request->nama_penyelenggara,
            'urutan' => $request->urutan,
        ]);
        return redirect()->route('admin.KompetisiPenyelenggara.index');
    }
    public function updateKompetisiPenyelenggara(Request $request, $id)
    {
        kompetisiPenyelenggara::whereId($id)->update([
            'id_kompetisi_penyelenggara_jenis' => $request->id_kompetisi_penyelenggara_jenis,
            'nama_penyelenggara' => $request->nama_penyelenggara,
            'urutan' => $request->urutan,
        ]);
        return redirect()->route('admin.KompetisiPenyelenggara.index');
    }
    public function deleteKompetisiPenyelenggara($id)
    {
        $kp = kompetisiPenyelenggara::find($id);
        $kp->delete();

        return redirect()->route('admin.KompetisiPenyelenggara.index');
    }

    // KegiatanSkala
    public function indexKegiatanSkala()
    {
        $kegiatanSkala = kegiatanSkala::all();
        return view('admin.kompetisi.Kegiatan_skala', compact('kegiatanSkala'));
    }
    public function storeKegiatanSkala(Request $request)
    {
        kegiatanSkala::create([
            'skala' => $request->skala,
        ]);

        return redirect()->route('admin.KegiatanSkala.index');
    }
    public function updateKegiatanSkala(Request $request, $id)
    {
        kegiatanSkala::whereId($id)->update([
            'skala' => $request->skala,
        ]);
        return redirect()->route('admin.KegiatanSkala.index');
    }
    public function deleteKegiatanSkala($id)
    {
        $KegiatanSkala = KegiatanSkala::find($id);
        $KegiatanSkala->delete();
        return redirect()->route('admin.KegiatanSkala.index');
    }

    // KompetisiDaftarKategori
    public function indexKompetisiDaftarKategori()
    {
        $KompetisiMahasiswa = kompetisi::all();
        $KompetisiKategori = KompetisiKategori::all();
        $KompetisiDaftarKategori = KompetisiDaftarKategori::all();
        return view('admin.kompetisi.kompetisi_daftar_kategori', compact('KompetisiDaftarKategori', 'KompetisiMahasiswa', 'KompetisiKategori'));
    }
    public function storeKompetisiDaftarKategori(Request $request)
    {
        KompetisiDaftarKategori::create([
            'id_kompetisi' => $request->id_kompetisi,
            'id_kompetisi_kategori' => $request->id_kompetisi_kategori,
        ]);

        return redirect()->route('admin.KompetisiDaftarKategori.index');
    }
    public function updateKompetisiDaftarKategori(Request $request, $id)
    {
        KompetisiDaftarKategori::whereId($id)->update([
            'id_kompetisi' => $request->id_kompetisi,
            'id_kompetisi_kategori' => $request->id_kompetisi_kategori,
        ]);

        return redirect()->route('admin.KompetisiDaftarKategori.index');
    }
    public function deleteKompetisiDaftarKategori($id)
    {
        $KompetisiDaftarKategori = KompetisiDaftarKategori::find($id);
        $KompetisiDaftarKategori->delete();

        return redirect()->route('admin.KompetisiDaftarKategori.index');
    }

    // KompetisiKategori
    public function indexKompetisiKategori()
    {
        $KompetisiKategori = KompetisiKategori::all();
        return view('admin.kompetisi.kategori_kompetisi', compact('KompetisiKategori'));
    }
    public function storeKompetisiKategori(Request $request)
    {
        KompetisiKategori::create([
            'nama_kategori' => $request->nama_kategori,
            'urutan' => $request->urutan,
        ]);
        return redirect()->route('admin.KompetisiKategori.index');
    }
    public function updateKompetisiKategori(Request $request, $id)
    {
        KompetisiKategori::whereId($id)->update([
            'nama_kategori' => $request->nama_kategori,
            'urutan' => $request->urutan,
        ]);
        return redirect()->route('admin.KompetisiKategori.index');
    }
    public function deleteKompetisiKategori($id)
    {
        $KompetisiKategori = KompetisiKategori::find($id);
        $KompetisiKategori->delete();
        return redirect()->route('admin.KompetisiKategori.index');
    }

    // KompetisiDaftarLabel
    public function indexKompetisiDaftarLabel()
    {
        $KompetisiMahasiswa = Kompetisi::all();
        $KompetisiLabel = KompetisiLabel::all();
        $KompetisiDaftarLabel = KompetisiDaftarLabel::all();
        return view('admin.kompetisi.kompetisi_daftar_label', compact('KompetisiDaftarLabel', 'KompetisiLabel', 'KompetisiMahasiswa'));
    }
    public function storeKompetisiDaftarLabel(Request $request)
    {
        KompetisiDaftarLabel::create([
            'id_kompetisi' => $request->id_kompetisi,
            'id_kompetisi_label' => $request->id_kompetisi_label
        ]);
        return redirect()->route('admin.KompetisiDaftarLabel.index');
    }
    public function updateKompetisiDaftarLabel(Request $request, $id)
    {
        KompetisiDaftarLabel::whereId($id)->update([
            'id_kompetisi' => $request->id_kompetisi,
            'id_kompetisi_label' => $request->id_kompetisi_label
        ]);
        return redirect()->route('admin.KompetisiDaftarLabel.index');
    }
    public function deleteKompetisiDaftarLabel($id)
    {
        $KompetisiDaftarLabel = KompetisiDaftarLabel::find($id);
        $KompetisiDaftarLabel->delete();
        return redirect()->route('admin.KompetisiDaftarLabel.index');
    }

    // KompetisiLabel
    public function indexKompetisiLabel()
    {
        $KompetisiLabel = KompetisiLabel::all();
        return view('admin.kompetisi.label_kompetisi', compact('KompetisiLabel'));
    }
    public function storeKompetisiLabel(Request $request)
    {
        KompetisiLabel::create([
            'nama_label' => $request->nama_label
        ]);

        return redirect()->route('admin.KompetisiLabel.index');
    }
    public function updateKompetisiLabel(Request $request, $id)
    {
        KompetisiLabel::whereId($id)->update([
            'nama_label' => $request->nama_label
        ]);
        return redirect()->route('admin.KompetisiLabel.index');
    }
    public function deleteKompetisiLabel($id)
    {
        $KompetisiLabel = KompetisiLabel::find($id);
        $KompetisiLabel->delete();
        return redirect()->route('admin.KompetisiLabel.index');
    }

    // KompetisiPoster
    public function indexKompetisiPoster()
    {
        $KompetisiPoster = KompetisiPoster::all();
        $KompetisiMahasiswa = Kompetisi::all();
        return view('admin.kompetisi.poster_kompetisi', compact('KompetisiPoster', 'KompetisiMahasiswa'));
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
        return redirect()->route('admin.KompetisiPoster.index');
    }
    public function updateKompetisiPoster(Request $request, $id)
    {
        KompetisiPoster::whereId($id)->update([
            'id_kompetisi' => $request->id_kompetisi,
            'poster' => $request->poster
        ]);

        return redirect()->route('admin.KompetisiPoster.index');
    }
    public function deleteKompetisiPoster($id)
    {
        $KompetisiPoster = KompetisiPoster::find($id);
        $KompetisiPoster->delete();
        return redirect()->route('admin.KompetisiPoster.index');
    }

    // KompetisiPanduan
    public function indexKompetisiPanduan()
    {
        $KompetisiPanduan = KompetisiPanduan::all();
        $KompetisiMahasiswa = Kompetisi::all();
        return view('admin.kompetisi.kompetisi_panduan', compact('KompetisiPanduan', 'KompetisiMahasiswa'));
    }
    public function storeKompetisiPanduan(Request $request)
    {
        KompetisiPanduan::create([
            'id_kompetisi' => $request->id_kompetisi,
            'panduan' => $request->panduan,
        ]);

        return redirect()->route('admin.KompetisiPanduan.index');
    }
    public function updateKompetisiPanduan(Request $request, $id)
    {
        KompetisiPanduan::whereId($id)->update([
            'id_kompetisi' => $request->id_kompetisi,
            'panduan' => $request->panduan,
        ]);
        return redirect()->route('admin.KompetisiPanduan.index');
    }
    public function deleteKompetisiPanduan($id)
    {
        $KompetisiPanduan = KompetisiPanduan::find($id);
        $KompetisiPanduan->delete();
        return redirect()->route('admin.KompetisiPanduan.index');
    }
}
