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
                        <h5>Tambah Jabatan</h5><span>Input Jabatan</span>
                      </div>
                      <div class="card-body">
                        <form class="theme-form" action="{{ route('mhsjabatan.store') }}" method="post">
                          <div class="mb-3">
                          @csrf
                            <label class="col-form-label pt-0" for="exampleInputEmail1">Jabatan Pekerjaan</label>
                            <input class="form-control" id="exampleInputEmail1" type="text" name="jabatan" placeholder="Input Jabatan">
                          </div>
                          <div class="mb-3">
                            <label class="col-form-label pt-0" for="exampleInputEmail1">Golongan</label>
                            <input class="form-control" id="exampleInputEmail1" type="text" name="golongan" placeholder="Input Golongan">
                          </div>
                      
                      </div>
                      <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                        <button class="btn btn-secondary">Cancel</button>
                      </div>
                      </form>
                    </div>
                  </div>
              
                </div>
              </div>
              <div class="col-sm-12 col-xl-6">
              <div class="card">
                  <div class="card-header">
                    <h5>Data Jabatan</h5><span> Jabatan Pekerjaan </span>
                  </div>
                  <div class="card-body">
                    <div class="dt-ext table-responsive">
                      <table class="display" id="responsive">
                        <thead>
                          <?php
                           $no = 1;
                           ?>
                          @foreach ($datajabatan as $itemjabatan )

                          <tr>
                            <th>No</th>
                            <th>Jabatan</th>
                            <th>Golongan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <td>{{$no++}}</td>
                            <td>{{$itemjabatan->jabatan}}</td>
                            <td>{{$itemjabatan->golongan}}</td>
                            <td>
                                                <a href="/edit/jabatan/{{$itemjabatan->id}}"
                                                    class="btn  btn-warning btn-sm">Edit</a>
                                                    <a href="/hapus/jabatan/{{$itemjabatan->id}}" onclick="return confirm('Yakin Untuk Hapus?')"
                                                    class="btn  btn-danger btn-sm mt-2">Hapus</a>
                                            </td>
                          </tr>
                          @endforeach
                          
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
@endsection