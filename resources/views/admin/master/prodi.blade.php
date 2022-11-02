@extends('layouts.app')
@section('title')
    User
@endsection

@section('content')
    <div class="container-fluid">


        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Prodi
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="#example" class="table-responsive table-bordered" style="width:100%">
                            <thead>
                                <th>ID</th>
                                <th>Fakultas</th>
                                <th>Prodi</th>
                                <th>Jenjang</th>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($prodi as $item)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->fakultas->nama_fakultas }}</td>
                                        <td>{{ $item->nama_prodi }}</td>
                                        <td>{{ $item->jenjang->nama_jenjang }}</td>
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}"
                                                class="btn btn-warning btn-sm">edit</a>
                                            <form action="{{ route('admin.prodi.delete', $item->id) }}" method="post"
                                                style="display:inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm" type="Submit">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Prodi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.prodi.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Fakultas</label>
                            <select name="id_fakultas" id="" class="form-control">
                                <option value="">-- Pilih Opsi --</option>
                                @foreach ($fakultas as $fklts)
                                    <option value="{{ $fklts->id }}">{{ $fklts->nama_fakultas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Jenjang</label>
                            <select name="id_jenjang" id="" class="form-control">
                                <option value="">-- Pilih Opsi --</option>
                                @foreach ($jenjang as $jnjng)
                                    <option value="{{ $jnjng->id }}">{{ $jnjng->nama_jenjang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Program Studi</label>
                            <input type="text" name="nama_prodi" class="form-control">
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($prodi as $prd)
        <!-- Modal -->
        <div class="modal fade" id="exampleModal-{{ $prd->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Prodi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.prodi.update', $prd->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="">Fakultas</label>
                                <select name="id_fakultas" id="" class="form-control">
                                    <option value="{{ $prd->id_fakultas }}">{{ $prd->fakultas->nama_fakultas }}
                                    </option>
                                    @foreach ($fakultas as $fklts)
                                        <option value="{{ $fklts->id }}">{{ $fklts->nama_fakultas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Jenjang</label>
                                <select name="id_jenjang" id="" class="form-control">
                                    <option value="{{ $prd->id_jenjang }}">{{ $prd->jenjang->nama_jenjang }}</option>
                                    @foreach ($jenjang as $jnjng)
                                        <option value="{{ $jnjng->id }}">{{ $jnjng->nama_jenjang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Program Studi</label>
                                <input type="text" name="nama_prodi" value="{{ $prd->nama_prodi }}"
                                    class="form-control">
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
