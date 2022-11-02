@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Data Poster Kompetisi</h5>
                  </div>
                  <div class="card-body">
                    <div class="dt-ext table-responsive">
                      <table class="display" id="custom-button">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Kompetisi</th>
                            <th>Tahun</th>
                            <th>Detail Poster</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Gemastik</td>
                            <td>2022</td>
                            <td>Muncul Gambar Poster</td>
                            <td>
                                                    <a href="#"
                                                    class="btn  btn-danger btn-sm mt-2">Hapus</a>
                                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                          </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
      
            
            </div>
          </div>
@endsection