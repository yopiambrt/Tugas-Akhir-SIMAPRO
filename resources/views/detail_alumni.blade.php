@extends('layouts.app')
@section('content')
   <!-- Container-fluid starts-->
   <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                  <h3>Detail Alumni</h3>
                  </div>
                  <div class="col card-header text-right">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="">
                    Ubah Data Alumni
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="">
                    Hapus Data Alumni
                </button>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="">
                   Kembali
                </button>
            </div>
                  <div class="card-body">
                    <h5>Foto Alumni</h5>
                    <p>Tampil Gambar Kompetisi yang sudah di upload di form Kompetisi</p>
                    <img src="{{ asset('assets/img/hero-img.png') }}" alt="">
                    
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      
                      <tbody>
                        <tr>
                          <td>Nama</td>
                          <td>: Putri</td>
                        </tr>
                        <tr>
                          <td>NIM</td>
                          <td>: R35335</td>
                        </tr>
                        <tr>
                          <td>NIK</td>
                          <td>: 1234789347348</td>
                        </tr>
                        <tr>
                          <td>Jenis Kelamin</td>
                          <td>: Perempuan</td>
                        </tr>
                        <tr>
                          <td>Temapat Lahir</td>
                          <td>: Bogor</td>
                        </tr>
                        <tr>
                          <td>Tanggal Lahir</td>
                          <td>: 2 Juni 2000</td>
                        </tr>
                        <tr>
                          <td>Alamat</td>
                          <td>: Jawa Barat</td>
                        </tr>
                        <tr>
                          <td>Nomor HP</td>
                          <td>: Pemrograman</td>
                        </tr>
                        <tr>
                          <td>Tahun Masuk</td>
                          <td>: 01-06-2022</td>
                        </tr>
                        <tr>
                          <td>Tahun Lulus</td>
                          <td>: 10-06-2022</td>
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