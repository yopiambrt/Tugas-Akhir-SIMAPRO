@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Penyelenggara</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <a class="btn  btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah
                                Penyelenggara</a>
                        </div>
                        <div class="dt-ext table-responsive">
                            <table class="display" id="custom-button">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Penyelenggara Kompetisi</th>
                                        <th>Jenis Penyelenggara</th>
                                        <th>Urutan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($kompetisiPenyelenggara as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->nama_penyelenggara }}</td>
                                            <td>{{ $item->kompetisiPenyelenggaraJenis->jenis_penyelenggara }}</td>
                                            <td>{{ $item->urutan }}</td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}"
                                                    class="btn  btn-warning btn-sm">Edit</a>
                                                <a href="{{ route('admin.KompetisiPenyelenggara.delete', $item->id) }}"
                                                    class="btn  btn-danger btn-sm">Hapus</a>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Jenis Penyelenggara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="theme-form" action="{{ route('admin.KompetisiPenyelenggara.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="col-form-label pt-2" for="exampleInputEmail1">Penyelenggara</label>
                                <input class="form-control" id="exampleInputEmail1" type="text"
                                    placeholder="Input Urutan" name="nama_penyelenggara">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Jenis Penyelenggara
                                </label>
                                <select name="id_kompetisi_penyelenggara_jenis" class="form-control">
                                    <option value="">-- PILIH PENYELENGGARA --</option>
                                    @foreach ($kompetisiPenyelenggaraJenis as $pyg)
                                        <option value="{{ $pyg->id }}">{{ $pyg->jenis_penyelenggara }}</option>
                                    @endforeach
                                </select>
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Urutan
                                </label>
                                <input class="form-control" id="exampleInputEmail1" type="text"
                                    placeholder="Input Penyeenggara" name="urutan">
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

    @foreach ($kompetisiPenyelenggara as $it)
        <div class="modal fade" id="exampleModal-{{ $it->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Penyelenggara</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="theme-form" action="{{ route('admin.KompetisiPenyelenggara.update', $it->id) }}"
                            method="post">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="col-form-label pt-2" for="exampleInputEmail1">Penyelenggara</label>
                                    <input class="form-control" id="exampleInputEmail1" type="text"
                                        placeholder="Input Urutan" name="nama_penyelenggara"
                                        value="{{ $it->nama_penyelenggara }}">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Jenis Penyelenggara
                                    </label>
                                    <select name="id_kompetisi_penyelenggara_jenis" class="form-control">
                                        <option value="{{ $it->id_kompetisi_penyelenggara_jenis }}">
                                            {{ $it->kompetisiPenyelenggaraJenis->jenis_penyelenggara }}</option>
                                        @foreach ($kompetisiPenyelenggaraJenis as $pyga)
                                            <option value="{{ $pyga->id }}">{{ $pyga->jenis_penyelenggara }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Urutan
                                    </label>
                                    <input class="form-control" id="exampleInputEmail1" type="text"
                                        placeholder="Input Penyeenggara" name="urutan" value="{{ $it->urutan }}">
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
