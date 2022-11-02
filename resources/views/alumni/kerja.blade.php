@extends('layouts.app')
@section('title')
    KERJA
@endsection

@section('content')
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('mawa.store.kerja', Auth::user()->id) }}" method="post">
                            @csrf

                            <div class="col-12">
                                <h4>DATA ALUMNI</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">Nama Instansi</label>
                                        <input required type="text" name="nama_instansi" class="form-control">
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat_kerja" class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">Jabatan</label>
                                        <input required type="text" name="jabatan" class="form-control">
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">Tahun Masuk</label>
                                        <input required type="date" name="tahun_masuk" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Prestasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
