@@ -0,0 +1,302 @@
@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Data Alumni</h5>
                    <span>Input Data Alumni</span>
                  </div>
                  @csrf
                  <div class="card-body">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Data Alumni
                    </button>
                    <div class="dt-ext table-responsive">
                    {{Auth::user()->DataAlumni}}
                      <table class="display" id="custom-button">
                        <thead>
                          <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Tahun Masuk</th>
                            <th>Tahun Lulus</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($user as $item)
                          <tr>
                            <td>{{$item->jenis}}</td>
                            <td>{{$item->kategori}}</td>
                            <td>{{$item->jabatan}}</td>
                            <td>{{$item->instansi}}</td>
                            <td>{{$item->kontak}}</td>
                            <td>{{$item->ppkwt}}</td>
                            <td>
                                <a href="#" class="btn  btn-secondary btn-sm mt-1">Detail</a>
                                <a href="#" class="btn  btn-warning btn-sm mt-1">Edit</a>
                                <a href="#" class="btn  btn-danger btn-sm mt-1">Hapus</a>
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
@endsection