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
                            Tambah Jenjang
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="#example" class="table table-bordered" style="width:100%">
                            <thead>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($jenjang as $item)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->nama_jenjang }}</td>
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}"
                                                class="btn btn-warning btn-sm">edit</a>
                                            <form action="{{ route('admin.jenjang.delete', $item->id) }}" method="post"
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jenjang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.jenjang.store') }}" method="post">
                        @csrf
                        <div class="form-control">
                            <label>Nama Jenjang</label>
                            <input type="text" name="nama_jenjang" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($jenjang as $jnjng)
        <!-- Modal -->
        <div class="modal fade" id="exampleModal-{{ $jnjng->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenjang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.jenjang.update', $jnjng->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-control">
                                <label>Nama Jenjang</label>
                                <input type="text" name="nama_jenjang" value="{{ $jnjng->nama_jenjang }}"
                                    class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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
