@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Daftar Label Kompetisi</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Daftar Label
                        </button>
                        <div class="dt-ext table-responsive">
                            <table class="display" id="custom-button">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kompetisi</th>
                                        <th>Daftar Label</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($KompetisiDaftarLabel as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->kompetisi->nama }}</td>
                                            <td>{{ $item->KompetisiLabel->nama_label }}</td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}"
                                                    class="btn  btn-warning btn-sm">Tambah Label</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Label</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.KompetisiDaftarLabel.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Kompetisi</label>
                            <select name="id_kompetisi" id="" class="form-control">
                                <option value="">-- PILIH OPSI --</option>
                                @foreach ($KompetisiMahasiswa as $kpt)
                                    <option value="{{ $kpt->id }}">{{ $kpt->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Label</label>
                            <select name="id_kompetisi_label" id="" class="form-control">
                                <option value="">-- PILIH OPSI --</option>
                                @foreach ($KompetisiLabel as $label)
                                    <option value="{{ $label->id }}">{{ $label->nama_label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($KompetisiDaftarLabel as $update)
        <div class="modal fade" id="exampleModal-{{ $update->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Daftar Label</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.KompetisiDaftarLabel.update', $update->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="">Nama Kompetisi</label>
                                <select name="id_kompetisi" id="" class="form-control">
                                    <option value="{{ $update->id_kompetisi }}">{{ $update->kompetisi->nama }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Label</label>
                                <select name="id_kompetisi_label" id="" class="form-control">
                                    <option value="{{ $update->id_kompetisi_label }}">
                                        {{ $update->kompetisiLabel->nama_label }}</option>
                                    @foreach ($KompetisiLabel as $updatelabel)
                                        <option value="{{ $updatelabel->id }}">{{ $updatelabel->nama_label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
