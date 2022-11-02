@extends('layouts.app')
@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 col-xl-6">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h5>Tambah Peran</h5><span>Input Data Peran</span>
                      </div>
                      <div class="card-body">
                        <form class="theme-form">
                          <div class="mb-3">
                            <label class="col-form-label pt-0" for="exampleInputEmail1">Nama Peran </label>
                            <input class="form-control" id="exampleInputEmail1" type="text"  placeholder="Input Peran">
                          </div>
                        </form>
                      </div>
                      <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                        <button class="btn btn-secondary">Cancel</button>
                      </div>
                    </div>
                  </div>
              
                </div>
              </div>
              <div class="col-sm-12 col-xl-6">
              <div class="card">
                  <div class="card-header">
                    <h5>Data Peran</h5><span>Jenis Peran</span>
                  </div>
                  <div class="card-body">
                    <div class="dt-ext table-responsive">
                      <table class="display" id="responsive">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Peran</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Individu</td>
                            <td>
                                                <a href="#"
                                                    class="btn  btn-warning btn-sm">Edit</a>
                                                    <a href="#"
                                                    class="btn  btn-danger btn-sm">Hapus</a>
                                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Ketua</td>
                            <td>
                                                <a href="#"
                                                    class="btn  btn-warning btn-sm">Edit</a>
                                                    <a href="#"
                                                    class="btn  btn-danger btn-sm">Hapus</a>
                                            </td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Anggota</td>
                            <td>
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
          <!-- Container-fluid Ends-->
@endsection