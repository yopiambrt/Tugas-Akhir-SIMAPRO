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
                            Tambah User
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="#example" class="table table-bordered" style="width:100%">
                            <thead>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Akses</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role->name }}</td>
                                        <td>

                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}"
                                                class="btn btn-warning btn-sm">edit</a>
                                            <form action="{{ route('admin.user.destroy', $item->id) }}" method="post"
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.user.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Lengkap...">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Masukan Email Aktif...">
                        </div>
                        <div class="form-group">
                            <label for="">Akses</label>
                            <select name="is_admin" class="form-control">
                                <option value="">-- Pilih Akses --</option>
                                @foreach ($role as $roles)
                                    <option value="{{ $roles->is_admin }}">{{ $roles->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" name="password" class="form-control"
                                placeholder="Masukan Password Anda...">
                        </div>
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($users as $usr)
        <!-- Modal -->
        <div class="modal fade" id="exampleModal-{{ $usr->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.user.update', $usr->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $usr->name }}" class="form-control"
                                    placeholder="Masukan Nama Lengkap...">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" value="{{ $usr->email }}" class="form-control"
                                    placeholder="Masukan Email Aktif...">
                            </div>
                            <div class="form-group">
                                <label for="">Akses</label>
                                <select name="is_admin" class="form-control">
                                    <option value="{{ $usr->is_admin }}">{{ $usr->role->name }}</option>
                                    @foreach ($role as $roles)
                                        <option value="{{ $roles->is_admin }}">{{ $roles->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="text" name="password" class="form-control"
                                    placeholder="Masukan Password Anda...">
                            </div>
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
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
