@extends('layouts.app')
@section('title')
    User
@endsection
@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 col-xl-6">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h5>Tambah Kategori Pekerjaan</h5><span>Input Kategori Pekerjaan</span>
                      </div>
                      <div class="card-body">
                        <form class="theme-form" action="{{ route('mhskategoripekerjaan.store') }}" method="post">
                          <div class="mb-3">
                          @csrf
                            <label class="col-form-label pt-0" for="exampleInputEmail1">Kategori Pekerjaan</label>
                            <input class="form-control" id="exampleInputEmail1" name="kategori" type="text"  placeholder="Input Kategori Pekerjaan">
                          </div>
                       
                      </div>
                      <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                        <button class="btn btn-secondary" onclick="document.getElementById('kategori').value = ''">Cancel</button>
                      </div>
                    </div> </form>
                  </div>
              
                </div>
              </div>
              <div class="col-sm-12 col-xl-6">
              <div class="card">
                  <div class="card-header">
                    <h5>Data Kategori Pekerjaan</h5><span> Kategori Pekerjaan </span>
                  </div>
                  <div class="card-body">
                    <div class="dt-ext table-responsive">
                      <table class="display" id="responsive">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Kategori Pekerjaan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>  
                          <tr>
                            <td>1</td>
                            <td></td>
                            <td>                           
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
@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection


