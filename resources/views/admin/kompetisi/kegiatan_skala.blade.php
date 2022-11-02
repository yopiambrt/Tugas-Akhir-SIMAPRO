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
                                <h5>Tambah Skala Kegiatan</h5><span>Input Skala Kegiatan</span>
                            </div>
                            <form class="theme-form" action="{{ route('admin.KegiatanSkala.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <div class="card-body">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Skala Kegiatan</label>
                                        <input class="form-control" id="exampleInputEmail1" type="text"
                                            placeholder="Input Skala Kegiatan" name="skala">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary">Submit</button>
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
                        <h5>Data Skala Kegiatan</h5><span> Skala Kegiatan</span>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="responsive">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Skala Kegiatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($kegiatanSkala as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->skala }}</td>
                                            <td>
                                                <a class="btn  btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal-{{ $item->id }}">Edit</a>
                                                <a href="{{ route('admin.KegiatanSkala.delete', $item->id) }}"
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
    @foreach ($kegiatanSkala as $it)
        <div class="modal fade" id="exampleModal-{{ $it->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Skala</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="theme-form" action="{{ route('admin.KegiatanSkala.update', $it->id) }}"
                            method="post">
                            <div class="card-body">
                                @csrf
                                @method('patch')
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="exampleInputEmail1">Nama Skala</label>
                                    <input class="form-control" id="exampleInputEmail1" type="text" name="skala"
                                        placeholder="Input Label" value="{{ $it->skala }}">
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