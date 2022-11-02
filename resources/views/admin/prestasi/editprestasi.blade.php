@extends('layouts.app')
@section('title')
    Mahasiswa
@endsection

@section('content')
    <div class="container-fluid">
        <!-- row -->
        <div class="col-sm-12 col-xl-6">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Edit Prestasi</h5>
                  </div>
                  <div class="card-body">
                    <form class="theme-form" action="/admin/dashboard/Prestasi/edit/{{$prestasi->id}}" method="post">
                      <div class="mb-3">
                      @csrf
                      <label class="col-form-label pt-0" for="exampleInputEmail1">Nama Kompetisi</label>
                        <input class="form-control" id="exampleInputEmail1" type="text" name="nama_team" value={{$prestasi->nama_kompetisi}} readonly>
                        <label class="col-form-label pt-0" for="exampleInputEmail1">Team</label>
                        <input class="form-control" id="exampleInputEmail1" type="text" name="nama_team" value={{$prestasi->team}}>
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">Hasil Kompetisi</label>
                        <select name="hasil_kompetisi" id="" class="form-control">
                            <option selected>{{$prestasi->hasil_kompetisi}}</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                      </div>
                  
                  </div>
                  <div class="card-footer">
                    <button class="btn btn-primary">Submit</button>
                    <a href="/admin/dashboard/Prestasi"><button type="button" class="btn btn-secondary">Cancel</button>
                  </div>
                  </form>
                </div>
              </div>
          
            </div>
          </div>
    </div>

    <!-- Modal -->
    

   
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
