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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Panduan
                        </button>
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
                                    <?php $i = 0; ?>
                                    @foreach ($KompetisiPoster as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>Gemastik</td>
                                            <td>2022</td>
                                            <td><img src="{{ asset($item->poster) }}" width="175px"></td>
                                            <td>
                                                <a href="#" class="btn  btn-danger btn-sm mt-2">Hapus</a>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Panduan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.KompetisiPoster.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Kompetisi</label>
                            <select name="id_kompetisi" id="" class="form-control">
                                <option value="1">-- PILIH OPSI --</option>
                                @foreach ($KompetisiMahasiswa as $kpt)
                                    <option value="{{ $kpt->id }}">{{ $kpt->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Panduan</label>
                            <input type="file" name="poster" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
