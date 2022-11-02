@extends('layouts.app')
@section('content')
   <!-- Container-fluid starts-->
   <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                  <h3>Detail Prestasi</h3>
                  </div>
                  <div class="col card-header text-right">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="">
                    Ubah Prestasi
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="">
                    Hapus Prestasi
                </button>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="">
                   Kembali
                </button>
            </div>
                  <div class="card-body">
                    <h5>Bukti Prestasi</h5>
                    <p>Upload Bukti Prestasi pada Form</p>
                    <img src="{{ asset('assets/img/hero-img.png') }}" alt="">
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      
                      <tbody>
                      <tr>
                          <td>Nama </td>
                          <td>: Budi</td>
                        </tr>
                        <tr>
                          <td>NIM</td>
                          <td>: 001</td>
                        </tr>
                        <tr>
                          <td>Dosbing</td>
                          <td>: 1</td>
                        </tr>

                        <td><b>Detail Kompetisi</b></td>
                        <tr>
                          <td>Nama Kompetisi</td>
                          <td>: Gemastik</td>
                        </tr>
                        <tr>
                          <td>Kepanjanagn</td>
                          <td>: Gelarr seni </td>
                        </tr>
                        <tr>
                          <td>Kategori</td>
                          <td>: TI</td>
                        </tr>
                        <tr>
                          <td>Skala</td>
                          <td>: Nasional</td>
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
                          <td>Tautan </td>
                          <td>: https://www.google.com/search?</td>
                        </tr>

                        <td><b>Detail Prestasi</b></td>
                        <tr>
                          <td>Nama Tim</td>
                          <td>: Tim Bahagia</td>
                        </tr>
                        <tr>
                          <td>Peran</td>
                          <td>: Individu </td>
                        </tr>
                        <tr>
                          <td>Hasil</td>
                          <td>: Juara 1 </td>
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