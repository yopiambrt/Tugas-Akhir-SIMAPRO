@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Daftar Panduan Kompetisi</h5>
                  </div>
                  <div class="card-body">
                    <div class="dt-ext table-responsive">
                      <table class="display" id="custom-button">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Kompetisi</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Gemastik</td>
                            <td>
                                                <a href="#"
                                                    class="btn  btn-warning btn-sm">Detail</a>
                                                    <a href="#"
                                                    class="btn  btn-warning btn-sm">Edit</a>
                                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                          </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
      
            
            </div>
          </div>
@endsection