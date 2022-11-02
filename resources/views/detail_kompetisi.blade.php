@extends('layouts.app')
@section('content')
   <!-- Container-fluid starts-->
   <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                  <h3>Detail Kompetisi</h3>
                  </div>
                  <div class="col card-header text-right">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="">
                    Ubah Data Kompetisi
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="">
                    Hapus Data Kompetisi
                </button>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="">
                   Kembali
                </button>
            </div>
                  <div class="card-body">
                    <h5>Poster Kompetisi</h5>
                    <p>Tampil Gambar Kompetisi yang sudah di upload di form Kompetisi</p>
                    <img src="{{ asset('assets/img/hero-img.png') }}" alt="">
                    
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      
                      <tbody>
                        <tr>
                          <td>Nama</td>
                          <td>: Gemastik</td>
                        </tr>
                        <tr>
                          <td>Kepanjangan</td>
                          <td>: Pagelaran Mahasiswa Nasional TIK</td>
                        </tr>
                        <tr>
                          <td>Tahun</td>
                          <td>: 2022</td>
                        </tr>
                        <tr>
                          <td>Deskripsi</td>
                          <td>: test</td>
                        </tr>
                        <tr>
                          <td>Penyelenggara</td>
                          <td>: Diskominfo</td>
                        </tr>
                        <tr>
                          <td>Skala Kegiatan</td>
                          <td>: Nasional</td>
                        </tr>
                        <tr>
                          <td>Daftar Label</td>
                          <td>: Web Design</td>
                        </tr>
                        <tr>
                          <td>Daftar Kategori</td>
                          <td>: Pemrograman</td>
                        </tr>
                        <tr>
                          <td>Pelaksanaan Registrasi</td>
                          <td>: 01-06-2022</td>
                        </tr>
                        <tr>
                          <td>Penutupan Registrasi</td>
                          <td>: 10-06-2022</td>
                        </tr>
                        <tr>
                          <td>Pelaksanaan Awal Kegiatan</td>
                          <td>: 12-06-2022</td>
                        </tr>
                        <tr>
                          <td>Pelaksanaan Akhir Kegiatan</td>
                          <td>: 20-06-2022</td>
                        </tr>
                        <tr>
                          <td>Biaya </td>
                          <td>: 1000000</td>
                        </tr>
                        <tr>
                          <td>Hadiah </td>
                          <td>: 2000000</td>
                        </tr>
                        <tr>
                          <td>Tautan / URL </td>
                          <td>: https://afrizatul.com/custom-bootstrap4-modal-detail/</td>
                        </tr>
                        <tr>
                          <td>Panduan</td>
                          <td>: test</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
         
          
        
          
          
            </div>
          </div>
          <!-- Container-fluid Ends-->
@endsection