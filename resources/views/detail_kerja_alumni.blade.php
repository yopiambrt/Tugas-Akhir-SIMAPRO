@extends('layouts.app')
@section('content')
   <!-- Container-fluid starts-->
   <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                  <h3>Detail Data Kerja Alumni</h3>
                  <span>Data Pekerjaan Alumni</span>
                  </div>
                  <div class="col card-header text-right">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="">
                    Ubah Data Pekerjaan
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="">
                    Hapus Data Pekerjaan
                </button>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="">
                   Kembali
                </button>
            </div>
                  <div class="card-body">
                    <h5>Foto Tempat Kerja</h5>
                    <p>Tampil Foto yang sudah di upload di form Pekerjaan Alumni</p>
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
                          <td>Angkatan</td>
                          <td>: 1234789347348</td>
                        </tr>
                        <tr>
                          <td>Jenis Pekerjaan</td>
                          <td>Admin</td>
                        </tr>
                        <tr>
                          <td>Instansi</td>
                          <td>Dana</td>
                        </tr>
                        <tr>
                          <td>Tanggal Masuk</td>
                          <td>10-08-2022</td>
                        </tr>
                        <tr>
                          <td>Jabatan</td>
                          <td>Staff</td>
                        </tr>
                        <tr>
                          <td>Gaji Pertama</td>
                          <td>2000000</td>
                        </tr>
                        <tr>
                          <td>UMR Kota/Kabupaten</td>
                          <td>1500000</td>
                        </tr>
                        <tr>
                          <td>Kategori Pekerjaan</td>
                          <td>Keuangan</td>
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