@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Data Studi Lanjutan Mahasiswa</h5>
                    <span>Input Studi Lanjutan Mahasiswa</span>
                  </div>
                  <div class="card-body">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Data Studi Lanjutan Mahasiswa
                    </button>
                    <div class="dt-ext table-responsive">
                      <table class="display" id="custom-button">
                        <thead>
                          <tr>
                            <th>Nama Univerisitas</th>
                            <th>Kategori Universitas</th>
                            <th>Program Studi</th>
                            <th>Fakultas </th>
                            <th>Jenjang</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Angelica Ramos</td>
                            <td>R24234</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>2009/10/09</td>
                            <td>
                                                <a href="#"
                                                    class="btn  btn-secondary btn-sm mt-1">Detail</a>
                                                    <a href="#"
                                                    class="btn  btn-warning btn-sm mt-1">Edit</a>
                                                    <a href="#"
                                                    class="btn  btn-danger btn-sm mt-1">Hapus</a>
                                            </td>
                          </tr>
                          <tr>
                            <td>Angelica Ramos</td>
                            <td>R24234</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>2009/10/09</td>
                            <td>
                                                <a href="#"
                                                    class="btn  btn-secondary btn-sm mt-1">Detail</a>
                                                    <a href="#"
                                                    class="btn  btn-warning btn-sm mt-1">Edit</a>
                                                    <a href="#"
                                                    class="btn  btn-danger btn-sm mt-1">Hapus</a>
                                            </td>
                          </tr>
                          <tr>
                            <td>Angelica Ramos</td>
                            <td>R24234</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>2009/10/09</td>
                            <td>
                                                <a href="#"
                                                    class="btn  btn-secondary btn-sm mt-1">Detail</a>
                                                    <a href="#"
                                                    class="btn  btn-warning btn-sm mt-1">Edit</a>
                                                    <a href="#"
                                                    class="btn  btn-danger btn-sm mt-1">Hapus</a>
                                            </td>
                          </tr>
                          <tr>
                            <td>Angelica Ramos</td>
                            <td>R24234</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>2009/10/09</td>
                            <td>
                                                <a href="#"
                                                    class="btn  btn-secondary btn-sm mt-1">Detail</a>
                                                    <a href="#"
                                                    class="btn  btn-warning btn-sm mt-1">Edit</a>
                                                    <a href="#"
                                                    class="btn  btn-danger btn-sm mt-1">Hapus</a>
                                            </td>
                          </tr>
                          <tr>
                            <td>Angelica Ramos</td>
                            <td>R24234</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>2009/10/09</td>
                            <td>
                                                <a href="#"
                                                    class="btn  btn-secondary btn-sm mt-1">Detail</a>
                                                    <a href="#"
                                                    class="btn  btn-warning btn-sm mt-1">Edit</a>
                                                    <a href="#"
                                                    class="btn  btn-danger btn-sm mt-1">Hapus</a>
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