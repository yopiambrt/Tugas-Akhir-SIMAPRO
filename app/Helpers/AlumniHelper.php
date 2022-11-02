<?php
    namespace App\Helpers;
    use Illuminate\Support\Str;
    use Storage;
    use App\Models\Alumni\AlumniBekerja;
    use App\Models\Alumni\AlumniWirausaha;
    use App\Models\Alumni\AlumniStudiLanjut;
    use App\Models\Alumni\AlumniBekerjaHistori;
    use App\Models\Alumni\AlumniWirausahaHistori;
    use App\Models\Alumni\AlumniStudiLanjutHistori;

    class AlumniHelper {
        public static function alumni_bekerja_histori($id){
            $result = new AlumniBekerja();
            $result = $result->where("id",$id);
            $result = $result->first();

            $create = new AlumniBekerjaHistori();
            $create = $create->create([
                'user_id' => $result->user_id,
                'jenis_perusahaan_id' => $result->jenis_perusahaan_id, 
                'nama' => $result->nama,
                'tanggal_mulai' => $result->tanggal_mulai,
                'nama_instansi' => $result->nama_instansi,
                'city_id' => $result->city_id,
                'gaji_pertama' => $result->gaji_pertama,
                'umr' => $result->umr,
                'jenis_pekerjaan' => $result->jenis_pekerjaan,
                'jabatan' => $result->jabatan,
                'kategori_pekerjaan_id' => $result->kategori_pekerjaan_id,
                'level_instansi_id' => $result->level_instansi_id,
                'contact' => $result->contact,
                'pkwt' => $result->pkwt,
                'pkwtt' => $result->pkwtt,
                'yayasan' => $result->yayasan,
                'pbh' => $result->pbh,
                'lsm' => $result->lsm,
                'pns' => $result->pns,
                'pppk' => $result->pppk,
            ]);
        }
        public static function alumni_wirausaha_histori($id){
            $result = new AlumniWirausaha();
            $result = $result->where("id",$id);
            $result = $result->first();

            $create = new AlumniWirausahaHistori();
            $create = $create->create([
                'user_id' => $result->user_id,
                'nama_pemilik' => $result->nama_pemilik,
                'tanggal_mulai' => $result->tanggal_mulai,
                'nama_usaha' => $result->nama_usaha,
                'city_id' => $result->city_id,
                'penghasilan' => $result->penghasilan,
                'umr' => $result->umr,
                'jenis_usaha_id' => $result->jenis_usaha_id,
                'level_usaha_id' => $result->level_usaha_id,
                'kriteria_usaha_id' => $result->kriteria_usaha_id,
                'kriteria_pekerja_lepas_id' => $result->kriteria_pekerja_lepas_id,
                'tipe' => $result->tipe,
                'dijalankan_oleh' => $result->dijalankan_oleh,
            ]);
        }
        public static function alumni_studi_lanjut_histori($id){
            $result = new AlumniStudiLanjut();
            $result = $result->where("id",$id);
            $result = $result->first();

            $create = new AlumniStudiLanjutHistori();
            $create = $create->create([
                'user_id' => $result->user_id,
                'nama' => $result->nama,
                'tanggal_mulai' => $result->tanggal_mulai,
                'nama_universitas' => $result->nama_universitas,
                'univ_jenjang_id' => $result->univ_jenjang_id,
                'univ_kategori_id' => $result->univ_kategori_id,
                'univ_level_id' => $result->univ_level_id,
                'program_studi' => $result->program_studi,
                'fakultas' => $result->fakultas,
            ]);
        }
    }
?>