@@ -0,0 +1,85 @@
@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Data Pekerjaan</h5>
                    <span>Input Data Pekerjaan</span>
                  </div>
                  <div class="card-body">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Data Pekerjaan
                    </button>
                    <div class="dt-ext table-responsive">
                      <table class="display" id="custom-button">
                        <thead>
                          <tr>
                            <th>Jenis Pekerjaan</th>
                            <th>Kategori</th>
                            <th>Jabatan</th>
                            <th>Instansi</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>V323032413</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>$320,800</td>
                          </tr>
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>V323032413</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>$320,800</td>
                          </tr>
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>V323032413</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>$320,800</td>
                          </tr>
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>V323032413</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>$320,800</td>
                          </tr>
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>V323032413</td>
                            <td>2019</td>
                            <td>2022</td>
                            <td>$320,800</td>
                          </tr>
                          <tr>
                            <td>Angelica Ramos</td>
                            <td>R24234</td>
                            <td>2019</td>
                            <td>2009/10/09</td>
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