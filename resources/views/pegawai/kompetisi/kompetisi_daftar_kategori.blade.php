@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Daftar Kategori Kompetisi</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12"><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Tambah Daftar Kategori
                            </button></div>
                        <div class="dt-ext table-responsive">
                            <table class="display" id="custom-button">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kompetisi</th>
                                        <th>Daftar Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($KompetisiDaftarKategori as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->kompetisi->nama }}</td>
                                            <td>{{ $item->Kategori->nama_kategori }}</td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}"
                                                    class="btn  btn-warning btn-sm">Update Kategori</a>
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
                    <form action="{{ route('admin.KompetisiDaftarKategori.store') }}" method="post">
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
                            <select name="id_kompetisi_kategori" id="" class="form-control">
                                <option value="">-- PILIH OPSI --</option>
                                @foreach ($KompetisiKategori as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($KompetisiDaftarKategori as $update)
        <div class="modal fade" id="exampleModal-{{ $update->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Daftar Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.KompetisiDaftarKategori.update', $update->id) }}" method="post">
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
                                <select name="id_kompetisi_kategori" id="" class="form-control">
                                    <option value="{{ $update->id_kompetisi_kategori }}">
                                        {{ $update->kategori->nama_kategori }}</option>
                                    @foreach ($KompetisiKategori as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
