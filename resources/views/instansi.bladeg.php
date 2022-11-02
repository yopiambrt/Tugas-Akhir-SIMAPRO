@@ -0,0 +1,302 @@
@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                  <h5>Tambah Instansi Pekerjaan</h5><span>Input Instansi</span>
                  </div>
                  <div class="card-body">
                  <a href="/tambah_instansi"
                                                    class="btn  btn-primary btn-sm"> Tambah Instansi Pekerjaan</a>                
                    @csrf
                    <div class="dt-ext table-responsive">
                      <table class="display" id="custom-button">
                        <thead>
                        <?php
                           $no = 1;
                           ?>
                                          
                        <tr>
                            <th>No</th>
                            <th>Nama Instansi</th>
                            <th>Alamat Instansi</th>
                            <th>Email Instansi</th>
                            <th>Bidang</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($datainstansi as $itemjabatan )       
                          <tr>
                            <td>{{$no++}}</td>
                            <td>{{$itemjabatan->nama}}</td>
                            <td>{{$itemjabatan->alamat}}</td>
                            <td>{{$itemjabatan->email}}</td>
                            <td>{{$itemjabatan->bidang}}</td>
                            <td>{{$itemjabatan->jabatan}}</td>
                            <td>{{$itemjabatan->jenis}}</td>
                            <td>
                                                <a href="/edit/instansi/{{$itemjabatan->id}}"
                                                    class="btn  btn-warning btn-sm">Edit</a>
                                                    <a href="/hapus/instansi/{{$itemjabatan->id}}" onclick="return confirm('Yakin Untuk Hapus?')"
                                                    class="btn  btn-danger btn-sm mt-2">Hapus</a>
                                            </td>
                          </tr>
                          @endforeach
                          </tr>                         
                      </table>
                    </div>
                  </div>
                </div>
              </div>
      
            
            </div>
          </div>
@endsection