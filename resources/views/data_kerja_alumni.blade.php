@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Data Pekerjaan Alumni</h5>
                    <span>Input Data Pekerjaan Alumni</span>
                  </div>
                  <div class="card-body">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Data Kerja Alumni
                    </button>
                    <div class="dt-ext table-responsive">
                      <table class="display" id="custom-button">
                        <thead>
                          <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Angkatan</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Instansi</th>
                            <th>Tanggal Masuk</th>
                            <th>Jabatan</th>
                            <th>Gaji Pertama</th>
                            <th>UMR</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>V323032413</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                          </tr>
                          <tr>
                            <td>Angelica Ramos</td>
                            <td>R24234</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>2022</td>
                            <td>2022</td>
                            <td>2022</td>
                            <td>$320,800</td>
                            <td>2022</td>
                            <td>2022</td>
                            <td>2009/10/09</td>
                            <td>
                                                <a href="#"
                                                    class="btn  btn-secondary btn-sm mt-2">Detail</a>
                                                    <a href="#"
                                                    class="btn  btn-warning btn-sm mt-2">Edit</a>
                                                    <a href="#"
                                                    class="btn  btn-danger btn-sm mt-2">Hapus</a>
                                            </td>
                          </tr>
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>V323032413</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                          </tr>
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>V323032413</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                          </tr>
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>V323032413</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                            <td>$320,800</td>
                          </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
      
            
            </div>
          </div>
@endsection