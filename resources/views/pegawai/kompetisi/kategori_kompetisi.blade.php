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
                                <h5>Tambah Kategori</h5><span>Input Kategori Kompetisi</span>
                            </div>
                            <form class="theme-form" action="{{ route('admin.KompetisiKategori.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Skala Kegiatan</label>
                                        <input class="form-control" id="exampleInputEmail1" type="text"
                                            placeholder="Input Nama Kegiatan" name="nama_kategori">
                                        <label class="col-form-label pt-2" for="exampleInputEmail1">Urutan</label>
                                        <input class="form-control" id="exampleInputEmail1" type="text"
                                            placeholder="Input Urutan" name="urutan">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <button class="btn btn-secondary" type="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Kategori Kompetisi</h5><span>Kategori Kompetisi</span>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="responsive">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori Kompetisi</th>
                                        <th>Urutan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($KompetisiKategori as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->nama_kategori }}</td>
                                            <td>{{ $item->urutan }}</td>
                                            <td>
                                                <a href="#" class="btn  btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal-{{ $item->id }}">Edit</a>
                                                <a href="{{ route('admin.KompetisiKategori.delete', $item->id) }}"
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
    @foreach ($KompetisiKategori as $it)
        <div class="modal fade" id="exampleModal-{{ $it->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Skala</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="theme-form" action="{{ route('admin.KompetisiKategori.update', $it->id) }}"
                            method="post">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Skala Kegiatan</label>
                                    <input class="form-control" id="exampleInputEmail1" type="text"
                                        placeholder="Input Nama Kegiatan" name="nama_kategori"
                                        value="{{ $it->nama_kategori }}">
                                    <label class="col-form-label pt-2" for="exampleInputEmail1">Urutan</label>
                                    <input class="form-control" id="exampleInputEmail1" type="text"
                                        placeholder="Input Urutan" name="urutan" value="{{ $it->urutan }}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <button class="btn btn-secondary" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
