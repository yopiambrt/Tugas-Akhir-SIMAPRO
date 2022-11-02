@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Data Prestasi</h5>
                  </div>
                  <div class="card-body">
                    <div class="dt-ext table-responsive">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Data Prestasi
                    </button>
                      <table class="display" id="custom-button">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Kompetisi</th>
                            <th>Nama Tim</th>
                            <th>Dosbing</th>
                            <th>Hasil</th>
                            <th>Tanggal Unggah</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>001</td>
                            <td>Angelica Ramos</td>
                            <td>GEMASTIK</td>
                            <td>London</td>
                            <td>Bayu</td>
                            <td>Juara 1</td>
                            <td>02/03/2022/td>
                            <td>
                                                <a href="#"
                                                    class="btn  btn-secondary btn-sm">Detail</a>
                                                    <a href="#"
                                                    class="btn  btn-warning btn-sm">Edit</a>
                                                    <a href="#"
                                                    class="btn  btn-danger btn-sm">Hapus</a>
                                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>013</td>
                            <td>Angelica Ramos</td>
                            <td>GEMASTIK</td>
                            <td>London</td>
                            <td>Bayu</td>
                            <td>Juara 1</td>
                            <td>02/03/2022/td>
                            <td>
                                                <a href="#"
                                                    class="btn  btn-secondary btn-sm">Detail</a>
                                                    <a href="#"
                                                    class="btn  btn-warning btn-sm">Edit</a>
                                                    <a href="#"
                                                    class="btn  btn-danger btn-sm">Hapus</a>
                                            </td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>003</td>
                            <td>Angelica Ramos</td>
                            <td>GEMASTIK</td>
                            <td>London</td>
                            <td>Bayu</td>
                            <td>Juara 2</td>
                            <td>02/03/2022/td>
                            <td>
                                                <a href="#"
                                                    class="btn  btn-secondary btn-sm">Detail</a>
                                                    <a href="#"
                                                    class="btn  btn-warning btn-sm">Edit</a>
                                                    <a href="#"
                                                    class="btn  btn-danger btn-sm">Hapus</a>
                                            </td>
                          </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
      
            
            </div>
          </div>
@endsection