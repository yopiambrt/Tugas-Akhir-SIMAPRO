<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AlumniController as AdminAlumniController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\KompetisiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MawaController;
use App\Http\Controllers\Pegawai\PegawaiController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\User\UserController as UserUserController;
use App\Http\Controllers\MhsTambahController;  
use App\Http\Controllers\DataAlumniController;  
use App\Http\Controllers\MhsKategoriPekerjaan;  
use App\Http\Controllers\MhsJabatan;  
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/portofolio', function () {
    return view('portofolio');
});

//ALUMNI

//untuk menampilkan form data alumni berdasarkan status nya (ada 4 : tidak bekerja, bekerja, usaha, studi lanjut)
Route::get('/alumni', function () {
    return view('alumni');
});

// menampilkan form data2 alumni dan inputan status alumni (tidak bekerja, bekerja, usaha, studi lanjut)
Route::get('/tambah_alumni', function () {
    return view('tambah_alumni');
});

//untuk melihat detail biodata alumni
Route::get('/detail_alumni', function () {
    return view('detail_alumni');
});

//untuk mengedit data alumni (sama kayak form tambah alumni)
Route::get('/edit_alumni', function () {
    return view('edit_alumni');
});

// untuk manajemen data pekerjaan alumni (jenis pekerjaan, kategori, jabatan, instansi)
Route::get('/pekerjaan', function () {
    return view('pekerjaan');
});

// form untuk menambah data pekerjaan 
Route::get('/tambah_pekerjaan', function () { return view('tambah_pekerjaan');});

// tabel jenis pekerjaan (nama profesi)
Route::get('/jenis_pekerjaan', function () { return view('jenis_pekerjaan');});

// tabel kategori pekerjaan
Route::get('/kategori_pekerjaan', function () {
    return view('kategori_pekerjaan');
});


// tabel data jabatan pekerjaan
Route::get('/data/jabatan', [AdminController::class, 'datajabatan']);
Route::get('/hapus/jabatan/{id}',[AdminController::class, 'hapusjabatan']);
Route::get('/edit/jabatan/{id}',[AdminController::class, 'vieweditjabatan']);
Route::post('/edit/jabatan/{id}',[AdminController::class, 'storeeditjabatan']);

Route::get('/data/instansi', [InstansiController::class, 'datainstansi']);
Route::get('/hapus/instansi/{id}', [InstansiController::class, 'hapusinstansi']);
Route::post('/edit/instansi/{id}',[AdminController::class, 'storeeditinstansi']);
Route::post('/tambahdata/instansi',[InstansiController::class, 'store']);

// tabel instansi pekerjaan
// Route::get('/instansi', function () {
//     return view('instansi');
// });

// tabel instansi pekerjaan
Route::get('/tambah_instansi', function () {
    return view('tambah_instansi');
});

// tabel bidang instansi  (manajemen bidangnya ex:keuangan, kesehatan dll)
Route::get('/bidang_instansi', function () {
    return view('bidang_instansi');
});

// tabel jenis instansi (manajemen bidang instansi ex: swasta, negri dll)
Route::get('/jenis_instansi', function () {
    return view('jenis_instansi');
});

// tabel level instansi (manajemen level instansi ex: nasional, internasional)
Route::get('/level_instansi', function () {
    return view('level_instansi');
});

// form data pekerjaan alumni
Route::get('/data_kerja_alumni', function () {
    return view('data_kerja_alumni');
});

// ini utk menambahkan data pekerjan alumni berdasarkan status
Route::get('/tambah_kerja_alumni', function () {
    return view('tambah_kerja_alumni');
});

// tampilan detail kerja alumni
Route::get('/detail_kerja_alumni', function () {
    return view('detail_kerja_alumni');
});

// tabel mahasiswa yang membuka usaha (wirausaha)
Route::get('/wirausaha', function () {
    return view('wirausaha');
});

// form tambah data mahasiswa wirausaha
Route::get('/tambah_usaha', function () {
    return view('tambah_usaha');
});

// form tambah data mahasiswa wirausaha
Route::get('/studi_lanjut', function () {
    return view('studi_lanjut');
});

// form tambah data mahasiswa wirausaha
Route::get('/tambah_studi', function () {
    return view('tambah_studi');
});

//KOMPETISI
Route::get('/kompetisi', function () {
    return view('kompetisi');
});

Route::get('/tambah_kompetisi', function () {
    return view('tambah_kompetisi');
});

Route::get('/detail_kompetisi', function () {
    return view('detail_kompetisi');
});

Route::get('/edit_kompetisi', function () {
    return view('edit_kompetisi');
});

Route::get('/kompetisi_daftar_label', function () {
    return view('kompetisi_daftar_label');
});

Route::get('/kompetisi_daftar_kategori', function () {
    return view('kompetisi_daftar_kategori');
});

Route::get('/kegiatan_skala', function () {
    return view('kegiatan_skala');
});

Route::get('/kategori_kompetisi', function () {
    return view('kategori_kompetisi');
});

Route::get('/label_kompetisi', function () {
    return view('label_kompetisi');
});

Route::get('/kompetisi_panduan', function () {
    return view('kompetisi_panduan');
});

Route::get('/detail_kompetisi_panduan', function () {
    return view('detail_kompetisi_panduan');
});

Route::get('/poster_kompetisi', function () {
    return view('poster_kompetisi');
});

Route::get('/kompetisi_penyelenggara', function () {
    return view('kompetisi_penyelenggara');
});

Route::get('/tambah_kompetisi_penyelenggara', function () {
    return view('tambah_kompetisi_penyelenggara');
});

Route::get('/kompetisi_penyelenggara_jenis', function () {
    return view('kompetisi_penyelenggara_jenis');
});

Route::get('/mahasiswa_tambah_kompetisi', function () {
    return view('mahasiswa_tambah_kompetisi');
});

Route::get('/prestasi', function () {
    return view('prestasi');
});



Route::get('/tambah_prestasi', function () {
    return view('tambah_prestasi');
});
Route::get('/edit_prestasi', function () {
    return view('edit_prestasi');
});

Route::get('/detail_prestasi', function () {
    return view('detail_prestasi');
});

Route::get('/peran_prestasi', function () {
    return view('peran_prestasi');
});

Route::get('/hasil_prestasi', function () {
    return view('hasil_prestasi');
});

//admin

Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware("userActiveOnly");
Route::get('dashboard_bekerja', [HomeController::class, 'bekerja'])->name('dashboard.bekerja')->middleware("userActiveOnly");

Route::middleware(['auth',"userActiveOnly"])->group(function () {

    route::get('profile', [ProfileController::class, 'index'])->name('profile');
    route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::prefix('admin/dashboard')->name('admin.')->middleware('Admin')->group(
        function () {
            Route::group(["namespace" => "Admin"],function(){
                Route::get('/', [AdminController::class, 'index'])->name('dashboard');
                Route::get('/dashboard_bekerja', [AdminController::class, 'bekerja'])->name('dashboard.bekerja');

                Route::get('/user', [UserController::class, 'index'])->name('user.index');
                Route::post('/user', [UserController::class, 'store'])->name('user.store');
                Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
                Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
                Route::post('/user/active', [UserController::class, 'user_active'])->name('user.active');
                Route::post('/user/banned', [UserController::class, 'user_banned'])->name('user.banned');

                Route::get('/Mahasiswa', [UserController::class, 'mhs'])->name('mhs.index');
                Route::get('/Mahasiswa/{id}', [UserController::class, 'mhsRead'])->name('mhs.read');
                Route::post('/Mahasiswa/Update/{id}', [UserController::class, 'mhsStore'])->name('mhs.store');
                Route::post('/Mahasiswa/active', [UserController::class, 'mhsActive'])->name('mhs.active');
                Route::post('/Mahasiswa/banned', [UserController::class, 'mhsBanned'])->name('mhs.banned');
                Route::post('/Mahasiswa/mhsUpdate', [UserController::class, 'mhsUpdate'])->name('mhs.mhsUpdate');

                Route::get('/Fakultas', [MasterController::class, 'indexFakultas'])->name('fakultas.index');
                Route::post('/Fakultas', [MasterController::class, 'storeFakultas'])->name('fakultas.store');
                Route::patch('/Fakultas/{id}', [MasterController::class, 'updateFakultas'])->name('fakultas.update');
                Route::delete('/Fakultas/{id}', [MasterController::class, 'destroyFakultas'])->name('fakultas.delete');

                Route::get('/Jenjang', [MasterController::class, 'indexJenjang'])->name('jenjang.index');
                Route::post('/Jenjang', [MasterController::class, 'storeJenjang'])->name('jenjang.store');
                Route::patch('/Jenjang/{id}', [MasterController::class, 'updateJenjang'])->name('jenjang.update');
                Route::delete('/Jenjang/{id}', [MasterController::class, 'destroyJenjang'])->name('jenjang.delete');

                Route::get('/Prodi', [MasterController::class, 'indexProdi'])->name('prodi.index');
                Route::post('/Prodi', [MasterController::class, 'storeProdi'])->name('prodi.store');
                Route::patch('/Prodi/{id}', [MasterController::class, 'updateProdi'])->name('prodi.update');
                Route::delete('/Prodi/{id}', [MasterController::class, 'destroyProdi'])->name('prodi.delete');

                Route::get('/KompetisiMahasiswa', [KompetisiController::class, 'indexKompetisiMahasiswa'])->name('KompetisiMahasiswa.index');
                Route::get('/CreateKompetisiMahasiswa', [KompetisiController::class, 'createKompetisiMahasiswa'])->name('KompetisiMahasiswa.create');
                Route::post('/storeKompetisiMahasiswa', [KompetisiController::class, 'storeKompetisiMahasiswa'])->name('KompetisiMahasiswa.store');
                Route::get('/ShowKompetisiMahasiswa/{id}', [KompetisiController::class, 'showKompetisiMahasiswa'])->name('KompetisiMahasiswa.show');
                Route::get('/DetailKompetisiMahasiswa/{id}', [KompetisiController::class, 'detailKompetisiMahasiswa'])->name('KompetisiMahasiswa.detail');
                Route::patch('/updateKompetisiMahasiswa/{id}', [KompetisiController::class, 'updateKompetisiMahasiswa'])->name('KompetisiMahasiswa.update');
                Route::get('/deleteKompetisiMahasiswa/{id}', [KompetisiController::class, 'deleteKompetisiMahasiswa'])->name('KompetisiMahasiswa.delete');

                Route::get('/KompetisiPenyelenggaraJenis', [KompetisiController::class, 'indexKompetisiPenyelenggaraJenis'])->name('KompetisiPenyelenggaraJenis.index');
                Route::post('/KompetisiPenyelenggaraJenis', [KompetisiController::class, 'storeKompetisiPenyelenggaraJenis'])->name('KompetisiPenyelenggaraJenis.store');
                Route::patch('/KompetisiPenyelenggaraJenis/{id}', [KompetisiController::class, 'updateKompetisiPenyelenggaraJenis'])->name('KompetisiPenyelenggaraJenis.update');
                Route::get('/KompetisiPenyelenggaraJenis/{id}', [KompetisiController::class, 'deleteKompetisiPenyelenggaraJenis'])->name('KompetisiPenyelenggaraJenis.delete');

                Route::get('/KompetisiPenyelenggara', [KompetisiController::class, 'indexKompetisiPenyelenggara'])->name('KompetisiPenyelenggara.index');
                Route::post('/KompetisiPenyelenggara', [KompetisiController::class, 'storeKompetisiPenyelenggara'])->name('KompetisiPenyelenggara.store');
                Route::patch('/KompetisiPenyelenggara/{id}', [KompetisiController::class, 'updateKompetisiPenyelenggara'])->name('KompetisiPenyelenggara.update');
                Route::get('/KompetisiPenyelenggara/{id}', [KompetisiController::class, 'deleteKompetisiPenyelenggara'])->name('KompetisiPenyelenggara.delete');

                Route::get('/KegiatanSkala', [KompetisiController::class, 'indexKegiatanSkala'])->name('KegiatanSkala.index');
                Route::post('/KegiatanSkala', [KompetisiController::class, 'storeKegiatanSkala'])->name('KegiatanSkala.store');
                Route::patch('/KegiatanSkala/{id}', [KompetisiController::class, 'updateKegiatanSkala'])->name('KegiatanSkala.update');
                Route::get('/KegiatanSkala/{id}', [KompetisiController::class, 'deleteKegiatanSkala'])->name('KegiatanSkala.delete');

                Route::get('/KompetisiDaftarKategori', [KompetisiController::class, 'indexKompetisiDaftarKategori'])->name('KompetisiDaftarKategori.index');
                Route::post('/KompetisiDaftarKategori', [KompetisiController::class, 'storeKompetisiDaftarKategori'])->name('KompetisiDaftarKategori.store');
                Route::patch('/KompetisiDaftarKategori/{id}', [KompetisiController::class, 'updateKompetisiDaftarKategori'])->name('KompetisiDaftarKategori.update');
                Route::get('/KompetisiDaftarKategori/{id}', [KompetisiController::class, 'deleteKompetisiDaftarKategori'])->name('KompetisiDaftarKategori.delete');

                Route::get('/KompetisiKategori', [KompetisiController::class, 'indexKompetisiKategori'])->name('KompetisiKategori.index');
                Route::post('/KompetisiKategori', [KompetisiController::class, 'storeKompetisiKategori'])->name('KompetisiKategori.store');
                Route::patch('/KompetisiKategori/{id}', [KompetisiController::class, 'updateKompetisiKategori'])->name('KompetisiKategori.update');
                Route::get('/KompetisiKategori/{id}', [KompetisiController::class, 'deleteKompetisiKategori'])->name('KompetisiKategori.delete');

                Route::get('/KompetisiDaftarLabel', [KompetisiController::class, 'indexKompetisiDaftarLabel'])->name('KompetisiDaftarLabel.index');
                Route::post('/KompetisiDaftarLabel', [KompetisiController::class, 'storeKompetisiDaftarLabel'])->name('KompetisiDaftarLabel.store');
                Route::patch('/KompetisiDaftarLabel/{id}', [KompetisiController::class, 'updateKompetisiDaftarLabel'])->name('KompetisiDaftarLabel.update');
                Route::delete('/KompetisiDaftarLabel/{id}', [KompetisiController::class, 'deleteKompetisiDaftarLabel'])->name('KompetisiDaftarLabel.delete');

                Route::get('/KompetisiLabel', [KompetisiController::class, 'indexKompetisiLabel'])->name('KompetisiLabel.index');
                Route::post('/KompetisiLabel', [KompetisiController::class, 'storeKompetisiLabel'])->name('KompetisiLabel.store');
                Route::patch('/KompetisiLabel/{id}', [KompetisiController::class, 'updateKompetisiLabel'])->name('KompetisiLabel.update');
                Route::get('/KompetisiLabel/{id}', [KompetisiController::class, 'deleteKompetisiLabel'])->name('KompetisiLabel.delete');

                Route::get('/KompetisiPoster', [KompetisiController::class, 'indexKompetisiPoster'])->name('KompetisiPoster.index');
                Route::post('/KompetisiPoster', [KompetisiController::class, 'storeKompetisiPoster'])->name('KompetisiPoster.store');
                Route::patch('/KompetisiPoster/{id}', [KompetisiController::class, 'updateKompetisiPoster'])->name('KompetisiPoster.update');
                Route::get('/KompetisiPoster/{id}', [KompetisiController::class, 'deleteKompetisiPoster'])->name('KompetisiPoster.delete');

                Route::get('/KompetisiPanduan', [KompetisiController::class, 'indexKompetisiPanduan'])->name('KompetisiPanduan.index');
                Route::post('/KompetisiPanduan', [KompetisiController::class, 'storeKompetisiPanduan'])->name('KompetisiPanduan.store');
                Route::patch('/KompetisiPanduan/{id}', [KompetisiController::class, 'updateKompetisiPanduan'])->name('KompetisiPanduan.update');
                Route::get('/KompetisiPanduan/{id}', [KompetisiController::class, 'deleteKompetisiPanduan'])->name('KompetisiPanduan.delete');

                Route::get('/Prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
                Route::post('/storePrestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
                Route::patch('/storePrestasi/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
                Route::get('/Prestasi/delete/{id}', [PrestasiController::class, 'delete'])->name('prestasi.delete');
                Route::get('/Prestasi/edit/{id}', [PrestasiController::class, 'vieweditprestasi']);
                Route::post('/Prestasi/edit/{id}', [PrestasiController::class, 'storeeditprestasi']);

                // Route::get('/alumni', [AdminAlumniController::class, 'alumni'])->name('alumni.index');
                // Route::get('/alumniCreate', [AdminAlumniController::class, 'alumniCreate'])->name('alumni.create');
                // Route::get('/alumniShow/{id}', [AdminAlumniController::class, 'alumniShow'])->name('alumni.show');
                // Route::post('/alumniStore', [AdminAlumniController::class, 'alumniStore'])->name('alumni.store');
                // Route::patch('/alumniUpdate/{id}', [AdminAlumniController::class, 'alumniUpdate'])->name('alumni.update');
                // Route::get('/alumniDelete/{id}', [AdminAlumniController::class, 'alumniDelete'])->name('alumni.delete');

                // Route::patch('/permintaan_alumni/{status}/{id}', [AdminAlumniController::class, 'Permintaan_alumni_update'])->name('permintaan_alumni.update');
                Route::get('/permintaan_alumni', [AdminAlumniController::class, 'Permintaan_alumni'])->name('permintaan_alumni.index');
                Route::get('/permintaan_alumni/{status}/{id}', [AdminAlumniController::class, 'Permintaan_alumni_update'])->name('permintaan_alumni.update');


                Route::get('/pekerjaan', [AdminAlumniController::class, 'pekerjaan'])->name('pekerjaan.index');
                // Route::get('/tambah_pekerjaan', [AdminAlumniController::class, 'createPekerjaan'])->name('pekerjaan.create');

                Route::get('/wirausaha', [AdminAlumniController::class, 'wirausaha'])->name('wirausaha.index');
                Route::get('/status', [AdminAlumniController::class, 'status'])->name('status.index');
                Route::post('/storeStatus', [AdminAlumniController::class, 'storeStatus'])->name('status.store');
                Route::patch('/updateStatus/{id}', [AdminAlumniController::class, 'updateStatus'])->name('status.update');
                Route::get('/deleteStatus/{id}', [AdminAlumniController::class, 'deleteStatus'])->name('status.delete');

                Route::get('/StudiLanjut', [AdminAlumniController::class, 'studiLanjut'])->name('studi.index');
            });

            Route::group(["namespace" => "App\Http\Controllers\Admin"],function(){
                Route::group(["prefix" => "/alumni","as" => "alumni."], function () {
                    Route::get('/', 'AlumniController@index')->name("index");
                    Route::get('/create', 'AlumniController@create')->name("create");
                    Route::get('/edit/{id}', 'AlumniController@edit')->name("edit");
                    Route::get('/show/{id}', 'AlumniController@show')->name("show");
                    Route::post('/store', 'AlumniController@store')->name("store");
                    Route::post('/update', 'AlumniController@update')->name("update");
                    Route::post('/destroy', 'AlumniController@destroy')->name("destroy");
                    Route::get('/riwayat_pekerjaan/{user_id}', 'AlumniController@riwayat_pekerjaan')->name("riwayat_pekerjaan");
                    
                    Route::group(["prefix" => "/studi_lanjut","as" => "studi_lanjut."], function () {
                        Route::get('/', 'AlumniStudiLanjutController@index')->name("index");
                        Route::get('/create', 'AlumniStudiLanjutController@create')->name("create");
                        Route::get('/edit/{id}', 'AlumniStudiLanjutController@edit')->name("edit");
                        Route::get('/show/{id}', 'AlumniStudiLanjutController@show')->name("show");
                        Route::post('/store', 'AlumniStudiLanjutController@store')->name("store");
                        Route::post('/update', 'AlumniStudiLanjutController@update')->name("update");
                        Route::post('/destroy', 'AlumniStudiLanjutController@destroy')->name("destroy");
                        Route::get('/export_excel', 'AlumniStudiLanjutController@export_excel')->name("export_excel");
                        Route::get('/export_pdf', 'AlumniStudiLanjutController@export_pdf')->name("export_pdf");
                    });

                    Route::group(["prefix" => "/bekerja","as" => "bekerja."], function () {
                        Route::get('/', 'AlumniBekerjaController@index')->name("index");
                        Route::get('/create', 'AlumniBekerjaController@create')->name("create");
                        Route::get('/edit/{id}', 'AlumniBekerjaController@edit')->name("edit");
                        Route::get('/show/{id}', 'AlumniBekerjaController@show')->name("show");
                        Route::post('/update', 'AlumniBekerjaController@update')->name("update");
                        Route::post('/destroy', 'AlumniBekerjaController@destroy')->name("destroy");
                        Route::post('/store_nirlaba', 'AlumniBekerjaController@store_nirlaba')->name("store_nirlaba");
                        Route::post('/store_swasta', 'AlumniBekerjaController@store_swasta')->name("store_swasta");
                        Route::post('/store_lembaga_pemerintah', 'AlumniBekerjaController@store_lembaga_pemerintah')->name("store_lembaga_pemerintah");
                        Route::post('/store_multilateral', 'AlumniBekerjaController@store_multilateral')->name("store_multilateral");
                        Route::post('/store_bumn', 'AlumniBekerjaController@store_bumn')->name("store_bumn");
                        Route::post('/store_bumd', 'AlumniBekerjaController@store_bumd')->name("store_bumd");
                        Route::post('/update_nirlaba', 'AlumniBekerjaController@update_nirlaba')->name("update_nirlaba");
                        Route::post('/update_swasta', 'AlumniBekerjaController@update_swasta')->name("update_swasta");
                        Route::post('/update_lembaga_pemerintah', 'AlumniBekerjaController@update_lembaga_pemerintah')->name("update_lembaga_pemerintah");
                        Route::post('/update_multilateral', 'AlumniBekerjaController@update_multilateral')->name("update_multilateral");
                        Route::post('/update_bumn', 'AlumniBekerjaController@update_bumn')->name("update_bumn");
                        Route::post('/update_bumd', 'AlumniBekerjaController@update_bumd')->name("store_bumd");

                        Route::get('/export_excel', 'AlumniBekerjaController@export_excel')->name("export_excel");
                        Route::get('/export_pdf', 'AlumniBekerjaController@export_pdf')->name("export_pdf");
                    });

                    Route::group(["prefix" => "/wirausaha","as" => "wirausaha."], function () {
                        Route::get('/', 'AlumniWirausahaController@index')->name("index");
                        Route::get('/create', 'AlumniWirausahaController@create')->name("create");
                        Route::get('/edit/{id}', 'AlumniWirausahaController@edit')->name("edit");
                        Route::get('/show/{id}', 'AlumniWirausahaController@show')->name("show");
                        Route::post('/store', 'AlumniWirausahaController@store')->name("store");
                        Route::post('/update', 'AlumniWirausahaController@update')->name("update");
                        Route::post('/destroy', 'AlumniWirausahaController@destroy')->name("destroy");
                        Route::get('/export_excel', 'AlumniWirausahaController@export_excel')->name("export_excel");
                        Route::get('/export_pdf', 'AlumniWirausahaController@export_pdf')->name("export_pdf");
                    });
                });

                Route::group(["prefix" => "/biodata","as" => "biodata."], function () {
                    Route::get('/', 'BiodataController@index')->name("index");
                    Route::get('/create', 'BiodataController@create')->name("create");
                    Route::get('/edit/{id}', 'BiodataController@edit')->name("edit");
                    Route::get('/show/{id}', 'BiodataController@show')->name("show");
                    Route::post('/store', 'BiodataController@store')->name("store");
                    Route::post('/update', 'BiodataController@update')->name("update");
                    Route::post('/destroy', 'BiodataController@destroy')->name("destroy");
                });

                Route::group(["prefix" => "/verifikasi_alumni","as" => "verifikasi_alumni."], function () {
                    Route::get('/', 'VerifikasiAlumniController@index')->name("index");
                    Route::post('/verifikasi', 'VerifikasiAlumniController@verifikasi')->name("verifikasi");
                    Route::post('/tolak', 'VerifikasiAlumniController@tolak')->name("tolak");
                });

                Route::group(["prefix" => "/master","as" => "master."], function () {

                    Route::group(["namespace" => "Master"],function(){
                        Route::group(["prefix" => "/jenis_usaha","as" => "jenis_usaha."], function () {
                            Route::get('/', 'JenisUsahaController@index')->name("index");
                            Route::post('/store', 'JenisUsahaController@store')->name("store");
                            Route::post('/update', 'JenisUsahaController@update')->name("update");
                            Route::post('/destroy', 'JenisUsahaController@destroy')->name("destroy");
                        });
                        Route::group(["prefix" => "/level_usaha","as" => "level_usaha."], function () {
                            Route::get('/', 'LevelUsahaController@index')->name("index");
                            Route::post('/store', 'LevelUsahaController@store')->name("store");
                            Route::post('/update', 'LevelUsahaController@update')->name("update");
                            Route::post('/destroy', 'LevelUsahaController@destroy')->name("destroy");
                        });
                        Route::group(["prefix" => "/jenis_perusahaan","as" => "jenis_perusahaan."], function () {
                            Route::get('/', 'JenisPerusahaanController@index')->name("index");
                        });
                        Route::group(["prefix" => "/kategori_pekerjaan","as" => "kategori_pekerjaan."], function () {
                            Route::get('/', 'KategoriPekerjaanController@index')->name("index");
                            Route::post('/store', 'KategoriPekerjaanController@store')->name("store");
                            Route::post('/update', 'KategoriPekerjaanController@update')->name("update");
                            Route::post('/destroy', 'KategoriPekerjaanController@destroy')->name("destroy");
                        });
                        Route::group(["prefix" => "/kriteria_pekerja_lepas","as" => "kriteria_pekerja_lepas."], function () {
                            Route::get('/', 'KriteriaPekerjaLepasController@index')->name("index");
                            Route::post('/store', 'KriteriaPekerjaLepasController@store')->name("store");
                            Route::post('/update', 'KriteriaPekerjaLepasController@update')->name("update");
                            Route::post('/destroy', 'KriteriaPekerjaLepasController@destroy')->name("destroy");
                        });
                        Route::group(["prefix" => "/kriteria_usaha","as" => "kriteria_usaha."], function () {
                            Route::get('/', 'KriteriaUsahaController@index')->name("index");
                            Route::post('/store', 'KriteriaUsahaController@store')->name("store");
                            Route::post('/update', 'KriteriaUsahaController@update')->name("update");
                            Route::post('/destroy', 'KriteriaUsahaController@destroy')->name("destroy");
                        });
                        Route::group(["prefix" => "/level_instansi","as" => "level_instansi."], function () {
                            Route::get('/', 'LevelInstansiController@index')->name("index");
                            Route::post('/store', 'LevelInstansiController@store')->name("store");
                            Route::post('/update', 'LevelInstansiController@update')->name("update");
                            Route::post('/destroy', 'LevelInstansiController@destroy')->name("destroy");
                        });
                        Route::group(["prefix" => "/status_pekerjaan","as" => "status_pekerjaan."], function () {
                            Route::get('/', 'StatusPekerjaanController@index')->name("index");
                        });
                        Route::group(["prefix" => "/universitas_jenjang","as" => "universitas_jenjang."], function () {
                            Route::get('/', 'UniversitasJenjangController@index')->name("index");
                            Route::post('/store', 'UniversitasJenjangController@store')->name("store");
                            Route::post('/update', 'UniversitasJenjangController@update')->name("update");
                            Route::post('/destroy', 'UniversitasJenjangController@destroy')->name("destroy");
                        });
                        Route::group(["prefix" => "/universitas_kategori","as" => "universitas_kategori."], function () {
                            Route::get('/', 'UniversitasKategoriController@index')->name("index");
                            Route::post('/store', 'UniversitasKategoriController@store')->name("store");
                            Route::post('/update', 'UniversitasKategoriController@update')->name("update");
                            Route::post('/destroy', 'UniversitasKategoriController@destroy')->name("destroy");
                        });
                        Route::group(["prefix" => "/universitas_level","as" => "universitas_level."], function () {
                            Route::get('/', 'UniversitasLevelController@index')->name("index");
                            Route::post('/store', 'UniversitasLevelController@store')->name("store");
                            Route::post('/update', 'UniversitasLevelController@update')->name("update");
                            Route::post('/destroy', 'UniversitasLevelController@destroy')->name("destroy");
                        });
                        Route::group(["prefix" => "/pendidikan","as" => "pendidikan."], function () {
                            Route::get('/', 'PendidikanController@index')->name("index");
                            Route::post('/store', 'PendidikanController@store')->name("store");
                            Route::post('/update', 'PendidikanController@update')->name("update");
                            Route::post('/destroy', 'PendidikanController@destroy')->name("destroy");
                        });
                    });
                    
                });
                
            });
        }
    );

    Route::prefix('mawa/dashboard')->namespace('Mawa')->name('mawa.')->middleware('mawa')->group(
        function () {
            Route::get('/', [MawaController::class, 'index'])->name('dashboard');
            Route::get('/Alumni', [AlumniController::class, 'index'])->name('index');
            Route::post('/storeAlumni', [AlumniController::class, 'storeAlumni'])->name('store');
            Route::post('/kerja/{id}', [AlumniController::class, 'storeAlumniKerja'])->name('store.kerja');
            Route::post('/kuliah/{id}', [AlumniController::class, 'storeAlumniKuliah'])->name('store.kuliah');

            Route::get('/biodata', [AlumniController::class, 'biodata'])->name('biodata');
            Route::post('/biodata/{id}', [AlumniController::class, 'mhsStore'])->name('biodata.store');

            Route::get('/Prestasi', [AlumniController::class, 'prestasi'])->name('prestasi.index');
            Route::post('/storePrestasi', [AlumniController::class, 'store'])->name('prestasi.store');
            Route::patch('/storePrestasi/{id}', [AlumniController::class, 'update'])->name('prestasi.update');
            Route::get('/Prestasi/delete/{id}', [AlumniController::class, 'delete'])->name('prestasi.delete');
        }
    );

    Route::prefix('Pegawai/dashboard')->name('pegawai.')->middleware('Pegawai')->group(
        function () {
            
            Route::group(["namespace" => "Pegawai"],function(){
                Route::get('/', [AdminController::class, 'index'])->name('dashboard');

                Route::get('/dashboard_bekerja', [AdminController::class, 'bekerja'])->name('dashboard.bekerja');

                Route::get('/user', [PegawaiController::class, 'index'])->name('user.index');
                Route::post('/user', [PegawaiController::class, 'store'])->name('user.store');
                Route::patch('/user/{id}', [PegawaiController::class, 'update'])->name('user.update');
                Route::delete('/user/{id}', [PegawaiController::class, 'destroy'])->name('user.destroy');

                Route::get('/Mahasiswa', [PegawaiController::class, 'mhs'])->name('mhs.index');
                Route::get('/Mahasiswa/{id}', [PegawaiController::class, 'mhsRead'])->name('mhs.read');
                Route::post('/Mahasiswa/Update/{id}', [PegawaiController::class, 'mhsStore'])->name('mhs.store');

                Route::get('/Fakultas', [PegawaiController::class, 'indexFakultas'])->name('fakultas.index');
                Route::post('/Fakultas', [PegawaiController::class, 'storeFakultas'])->name('fakultas.store');
                Route::patch('/Fakultas/{id}', [PegawaiController::class, 'updateFakultas'])->name('fakultas.update');
                Route::delete('/Fakultas/{id}', [PegawaiController::class, 'destroyFakultas'])->name('fakultas.delete');

                Route::get('/Jenjang', [PegawaiController::class, 'indexJenjang'])->name('jenjang.index');
                Route::post('/Jenjang', [PegawaiController::class, 'storeJenjang'])->name('jenjang.store');
                Route::patch('/Jenjang/{id}', [PegawaiController::class, 'updateJenjang'])->name('jenjang.update');
                Route::delete('/Jenjang/{id}', [PegawaiController::class, 'destroyJenjang'])->name('jenjang.delete');

                Route::get('/Prodi', [PegawaiController::class, 'indexProdi'])->name('prodi.index');
                Route::post('/Prodi', [PegawaiController::class, 'storeProdi'])->name('prodi.store');
                Route::patch('/Prodi/{id}', [PegawaiController::class, 'updateProdi'])->name('prodi.update');
                Route::delete('/Prodi/{id}', [PegawaiController::class, 'destroyProdi'])->name('prodi.delete');

                Route::get('/KompetisiMahasiswa', [PegawaiController::class, 'indexKompetisiMahasiswa'])->name('KompetisiMahasiswa.index');
                Route::get('/CreateKompetisiMahasiswa', [PegawaiController::class, 'createKompetisiMahasiswa'])->name('KompetisiMahasiswa.create');
                Route::post('/storeKompetisiMahasiswa', [PegawaiController::class, 'storeKompetisiMahasiswa'])->name('KompetisiMahasiswa.store');
                Route::get('/ShowKompetisiMahasiswa/{id}', [PegawaiController::class, 'showKompetisiMahasiswa'])->name('KompetisiMahasiswa.show');
                Route::get('/DetailKompetisiMahasiswa/{id}', [PegawaiController::class, 'detailKompetisiMahasiswa'])->name('KompetisiMahasiswa.detail');
                Route::patch('/updateKompetisiMahasiswa/{id}', [PegawaiController::class, 'updateKompetisiMahasiswa'])->name('KompetisiMahasiswa.update');
                Route::get('/deleteKompetisiMahasiswa/{id}', [PegawaiController::class, 'deleteKompetisiMahasiswa'])->name('KompetisiMahasiswa.delete');

                Route::get('/KompetisiPenyelenggaraJenis', [PegawaiController::class, 'indexKompetisiPenyelenggaraJenis'])->name('KompetisiPenyelenggaraJenis.index');
                Route::post('/KompetisiPenyelenggaraJenis', [PegawaiController::class, 'storeKompetisiPenyelenggaraJenis'])->name('KompetisiPenyelenggaraJenis.store');
                Route::patch('/KompetisiPenyelenggaraJenis/{id}', [PegawaiController::class, 'updateKompetisiPenyelenggaraJenis'])->name('KompetisiPenyelenggaraJenis.update');
                Route::get('/KompetisiPenyelenggaraJenis/{id}', [PegawaiController::class, 'deleteKompetisiPenyelenggaraJenis'])->name('KompetisiPenyelenggaraJenis.delete');

                Route::get('/KompetisiPenyelenggara', [PegawaiController::class, 'indexKompetisiPenyelenggara'])->name('KompetisiPenyelenggara.index');
                Route::post('/KompetisiPenyelenggara', [PegawaiController::class, 'storeKompetisiPenyelenggara'])->name('KompetisiPenyelenggara.store');
                Route::patch('/KompetisiPenyelenggara/{id}', [PegawaiController::class, 'updateKompetisiPenyelenggara'])->name('KompetisiPenyelenggara.update');
                Route::get('/KompetisiPenyelenggara/{id}', [PegawaiController::class, 'deleteKompetisiPenyelenggara'])->name('KompetisiPenyelenggara.delete');

                Route::get('/KegiatanSkala', [PegawaiController::class, 'indexKegiatanSkala'])->name('KegiatanSkala.index');
                Route::post('/KegiatanSkala', [PegawaiController::class, 'storeKegiatanSkala'])->name('KegiatanSkala.store');
                Route::patch('/KegiatanSkala/{id}', [PegawaiController::class, 'updateKegiatanSkala'])->name('KegiatanSkala.update');
                Route::get('/KegiatanSkala/{id}', [PegawaiController::class, 'deleteKegiatanSkala'])->name('KegiatanSkala.delete');

                Route::get('/KompetisiDaftarKategori', [PegawaiController::class, 'indexKompetisiDaftarKategori'])->name('KompetisiDaftarKategori.index');
                Route::post('/KompetisiDaftarKategori', [PegawaiController::class, 'storeKompetisiDaftarKategori'])->name('KompetisiDaftarKategori.store');
                Route::patch('/KompetisiDaftarKategori/{id}', [PegawaiController::class, 'updateKompetisiDaftarKategori'])->name('KompetisiDaftarKategori.update');
                Route::get('/KompetisiDaftarKategori/{id}', [PegawaiController::class, 'deleteKompetisiDaftarKategori'])->name('KompetisiDaftarKategori.delete');

                Route::get('/KompetisiKategori', [PegawaiController::class, 'indexKompetisiKategori'])->name('KompetisiKategori.index');
                Route::post('/KompetisiKategori', [PegawaiController::class, 'storeKompetisiKategori'])->name('KompetisiKategori.store');
                Route::patch('/KompetisiKategori/{id}', [PegawaiController::class, 'updateKompetisiKategori'])->name('KompetisiKategori.update');
                Route::get('/KompetisiKategori/{id}', [PegawaiController::class, 'deleteKompetisiKategori'])->name('KompetisiKategori.delete');

                Route::get('/KompetisiDaftarLabel', [PegawaiController::class, 'indexKompetisiDaftarLabel'])->name('KompetisiDaftarLabel.index');
                Route::post('/KompetisiDaftarLabel', [PegawaiController::class, 'storeKompetisiDaftarLabel'])->name('KompetisiDaftarLabel.store');
                Route::patch('/KompetisiDaftarLabel/{id}', [PegawaiController::class, 'updateKompetisiDaftarLabel'])->name('KompetisiDaftarLabel.update');
                Route::delete('/KompetisiDaftarLabel/{id}', [PegawaiController::class, 'deleteKompetisiDaftarLabel'])->name('KompetisiDaftarLabel.delete');

                Route::get('/KompetisiLabel', [PegawaiController::class, 'indexKompetisiLabel'])->name('KompetisiLabel.index');
                Route::post('/KompetisiLabel', [PegawaiController::class, 'storeKompetisiLabel'])->name('KompetisiLabel.store');
                Route::patch('/KompetisiLabel/{id}', [PegawaiController::class, 'updateKompetisiLabel'])->name('KompetisiLabel.update');
                Route::get('/KompetisiLabel/{id}', [PegawaiController::class, 'deleteKompetisiLabel'])->name('KompetisiLabel.delete');

                Route::get('/KompetisiPoster', [PegawaiController::class, 'indexKompetisiPoster'])->name('KompetisiPoster.index');
                Route::post('/KompetisiPoster', [PegawaiController::class, 'storeKompetisiPoster'])->name('KompetisiPoster.store');
                Route::patch('/KompetisiPoster/{id}', [PegawaiController::class, 'updateKompetisiPoster'])->name('KompetisiPoster.update');
                Route::get('/KompetisiPoster/{id}', [PegawaiController::class, 'deleteKompetisiPoster'])->name('KompetisiPoster.delete');

                Route::get('/KompetisiPanduan', [PegawaiController::class, 'indexKompetisiPanduan'])->name('KompetisiPanduan.index');
                Route::post('/KompetisiPanduan', [PegawaiController::class, 'storeKompetisiPanduan'])->name('KompetisiPanduan.store');
                Route::patch('/KompetisiPanduan/{id}', [PegawaiController::class, 'updateKompetisiPanduan'])->name('KompetisiPanduan.update');
                Route::get('/KompetisiPanduan/{id}', [PegawaiController::class, 'deleteKompetisiPanduan'])->name('KompetisiPanduan.delete');

                Route::get('/Prestasi', [PegawaiController::class, 'index'])->name('prestasi.index');
                Route::post('/storePrestasi', [PegawaiController::class, 'store'])->name('prestasi.store');
                Route::patch('/storePrestasi/{id}', [PegawaiController::class, 'update'])->name('prestasi.update');
                Route::get('/Prestasi/delete/{id}', [PegawaiController::class, 'delete'])->name('prestasi.delete');

                Route::get('/alumni', [PegawaiController::class, 'alumni'])->name('alumni.index');
                Route::get('/alumniCreate', [PegawaiController::class, 'alumniCreate'])->name('alumni.create');
                Route::get('/alumniShow/{id}', [PegawaiController::class, 'alumniShow'])->name('alumni.show');
                Route::post('/alumniStore', [PegawaiController::class, 'alumniStore'])->name('alumni.store');
                Route::patch('/alumniUpdate/{id}', [PegawaiController::class, 'alumniUpdate'])->name('alumni.update');
                Route::get('/alumniDelete/{id}', [PegawaiController::class, 'alumniDelete'])->name('alumni.delete');


                Route::get('/pekerjaan', [PegawaiController::class, 'pekerjaan'])->name('pekerjaan.index');


                Route::get('/wirausaha', [PegawaiController::class, 'wirausaha'])->name('wirausaha.index');
                Route::get('/status', [PegawaiController::class, 'status'])->name('status.index');
                Route::post('/storeStatus', [PegawaiController::class, 'storeStatus'])->name('status.store');
                Route::patch('/updateStatus/{id}', [PegawaiController::class, 'updateStatus'])->name('status.update');
                Route::get('/deleteStatus/{id}', [PegawaiController::class, 'deleteStatus'])->name('status.delete');
            });

            Route::group(["namespace" => "App\Http\Controllers\Pegawai"],function(){
                Route::group(["prefix" => "/alumni","as" => "alumni."], function () {
                    Route::get('/', 'AlumniController@index')->name("index");
                    Route::get('/show/{id}', 'AlumniController@show')->name("show");
                    Route::get('/riwayat_pekerjaan/{user_id}', 'AlumniController@riwayat_pekerjaan')->name("riwayat_pekerjaan");
                    
                    Route::group(["prefix" => "/studi_lanjut","as" => "studi_lanjut."], function () {
                        Route::get('/', 'AlumniStudiLanjutController@index')->name("index");
                        Route::get('/show/{id}', 'AlumniStudiLanjutController@show')->name("show");
                        Route::get('/export_excel', 'AlumniStudiLanjutController@export_excel')->name("export_excel");
                        Route::get('/export_pdf', 'AlumniStudiLanjutController@export_pdf')->name("export_pdf");
                    });
            
                    Route::group(["prefix" => "/bekerja","as" => "bekerja."], function () {
                        Route::get('/', 'AlumniBekerjaController@index')->name("index");
                        Route::get('/show/{id}', 'AlumniBekerjaController@show')->name("show");
                        Route::get('/export_excel', 'AlumniBekerjaController@export_excel')->name("export_excel");
                        Route::get('/export_pdf', 'AlumniBekerjaController@export_pdf')->name("export_pdf");
                    });
            
                    Route::group(["prefix" => "/wirausaha","as" => "wirausaha."], function () {
                        Route::get('/', 'AlumniWirausahaController@index')->name("index");
                        Route::get('/show/{id}', 'AlumniWirausahaController@show')->name("show");
                        Route::get('/export_excel', 'AlumniWirausahaController@export_excel')->name("export_excel");
                        Route::get('/export_pdf', 'AlumniWirausahaController@export_pdf')->name("export_pdf");
                    });
                });

                Route::group(["prefix" => "/biodata","as" => "biodata."], function () {
                    Route::get('/', 'BiodataController@index')->name("index");
                    Route::get('/show/{id}', 'BiodataController@show')->name("show");
                });
            });
        }
    );
    Route::prefix('mahasiswa/dashboard')->name('mhs.')->middleware('mahasiswa')->group(
        function () {
            Route::group(["namespace" => "Mahasiswa"],function(){
                Route::get('/', [MahasiswaController::class, 'index'])->name('dashboard');
                Route::get('/dashboard_bekerja', [MahasiswaController::class, 'bekerja'])->name('dashboard.bekerja');

                Route::get('/biodata', [UserUserController::class, 'biodata'])->name('biodata');
                Route::post('/biodata/{id}', [UserUserController::class, 'mhsStore'])->name('biodata.store');

                Route::get('/Prestasi', [UserUserController::class, 'prestasi'])->name('prestasi.index');
                Route::post('/storePrestasi', [UserUserController::class, 'store'])->name('prestasi.store');            
                Route::patch('/storePrestasi/{id}', [UserUserController::class, 'update'])->name('prestasi.update');
                Route::get('/Prestasi/delete/{id}', [UserUserController::class, 'delete'])->name('prestasi.delete');

                // Route::get('/tambah_pekerjaan', [MhsTambahController::class, 'index'])->name('tambah_pekerjaan.index');          

                Route::post('/status_alumni', [UserUserController::class, 'storeAlumniStatus'])->name('statusalumni.store');
                Route::get('/permintaan_alumni/{status}/{id}', [UserUserController::class, 'Permintaan_alumni_update'])->name('permintaan_alumni.update');
            });
            
            Route::group(["namespace" => "App\Http\Controllers\User"],function(){
                Route::group(["prefix" => "/biodatas","as" => "biodatas."], function () {
                    Route::post('/store', 'BiodataController@store')->name("store");
                });

                Route::group(["prefix" => "/pendataan_alumni","as" => "pendataan_alumni."], function () {
                    Route::get('/create', 'AlumniController@create')->name("create");
                    Route::post('/store', 'AlumniController@store')->name("store");

                    Route::group(["prefix" => "/setelah_lulus","as" => "setelah_lulus."], function () {
                        Route::get('/', 'AlumniController@setelah_lulus')->name("create");
                        Route::post('/store', 'AlumniController@store_setelah_lulus')->name("store");
                        Route::get('/pilihan', 'AlumniController@setelah_lulus_pilihan')->name("pilihan");
                    });

                    Route::group(["prefix" => "/membuka_usaha","as" => "membuka_usaha."], function () {
                        Route::get('/', 'AlumniController@membuka_usaha')->name("create");
                        Route::post('/store', 'AlumniController@store_membuka_usaha')->name("store");
                    });

                    Route::group(["prefix" => "/bekerja","as" => "bekerja."], function () {
                        Route::get('/', 'AlumniController@bekerja')->name("create");
                        Route::get('/jenis_perusahaan', 'AlumniController@jenis_perusahaan')->name("jenis_perusahaan");
                        Route::post('/store_nirlaba', 'AlumniController@store_nirlaba')->name("store_nirlaba");
                        Route::post('/store_swasta', 'AlumniController@store_swasta')->name("store_swasta");
                        Route::post('/store_lembaga_pemerintah', 'AlumniController@store_lembaga_pemerintah')->name("store_lembaga_pemerintah");
                        Route::post('/store_multilateral', 'AlumniController@store_multilateral')->name("store_multilateral");
                        Route::post('/store_bumn', 'AlumniController@store_bumn')->name("store_bumn");
                        Route::post('/store_bumd', 'AlumniController@store_bumd')->name("store_bumd");
                    });

                    Route::group(["prefix" => "/studi_lanjut","as" => "studi_lanjut."], function () {
                        Route::get('/', 'AlumniController@studi_lanjut')->name("create");
                        Route::post('/store', 'AlumniController@store_studi_lanjut')->name("store");
                    });
                });
            });
        }
    );
    
    Route::resource('pekerjaan', App\Http\Controllers\MhsPekerjaanController::class);
    Route::resource('tambahpekerjaan', App\Http\Controllers\MhsTambahController::class);
    Route::resource('dataalumni', App\Http\Controllers\DataAlumniController::class);
    Route::resource('tambahalumni', App\Http\Controllers\AlumniTambahController::class);
    Route::resource('mhskategoripekerjaan', App\Http\Controllers\MhsKategoriPekerjaanController::class);  

    Route::resource('mhsjabatan', App\Http\Controllers\MhsJabatanController::class); 
    Route::resource('mhsinstansi', App\Http\Controllers\InstansiController::class); 

   
});
require __DIR__ . '/auth.php';
