@extends('layouts.app')
@section('title')
    Mahasiswa
@endsection

@section('content')
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah User
                        </button> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Akses</th>
                                    <th>Avatar</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($mhs as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->role->name }}</td>
                                            <td>
                                                @if(!empty($item->avatar))
                                                <a href="{{asset($item->avatar)}}" target="_blank">
                                                    <img src="{{asset($item->avatar)}}" style="height:50px;width: 50px;">
                                                </a>
                                                @endif
                                            </td>
                                            <td>{{ $item->is_active() ?? null}}</td>
                                            <td>
                                                <a href="# "class="btn btn-warning btn-sm btn-edit" data-id="{{$item->id}}" data-name="{{$item->name}}" data-email="{{$item->email}}"><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('admin.user.destroy', $item->id) }}" method="post"
                                                    style="display:inline;margin-right:2px;">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm" type="Submit"><i class="fa fa fa-trash"></i></button>
                                                </form>
                                                <div class="d-flex mt-2">
                                                    @if($item->is_active == \App\Models\User::IS_ACTIVE_YES)
                                                    <a class="btn btn-danger btn-banned btn-sm" data-id="{{$item->id}}">Disabled</a>
                                                    @endif
                                                    @if($item->is_active == \App\Models\User::IS_ACTIVE_NO)
                                                    <a class="btn btn-primary btn-active btn-sm" data-id="{{$item->id}}">Enabled</a>
                                                    @endif
                                                </div>
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
                        <div class="form-group">
                            <label for="">Avatar</label>
                            <input type="file" name="avatar" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="modalUpdateLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateLabel">Edit Akun Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" id="frmUpdate" method="post">
                        @csrf
                        <input type="hidden" name="id"/>
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Masukan Nama Lengkap...">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control"
                                placeholder="Masukan Email Aktif...">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" name="password" class="form-control"
                                placeholder="Masukan Password Anda...">
                            <p class="text-info"><small>Kosongi jika tidak diubah</small></p>
                        </div>
                        <div class="form-group">
                            <label for="">Avatar</label>
                            <input type="file" name="avatar" class="form-control" accept="image/*">
                             <p class="text-info"><small>Kosongi jika tidak diubah</small></p>
                        </div>
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<form class="d-none" method="post" action="{{route("admin.mhs.active")}}" id="frmActive">
    @csrf
    <input type="hidden" name="id"/>
</form>
<form class="d-none" method="post" action="{{route("admin.mhs.banned")}}" id="frmBanned">
    @csrf
    <input type="hidden" name="id"/>
</form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "ordering": false
            });
            $(document).on("click",".btn-edit",function(){
                let id = $(this).data("id");
                let name = $(this).data("name");
                let email = $(this).data("email");

                $("#frmUpdate").find("input[name='id']").val(id);
                $("#frmUpdate").find("input[name='name']").val(name);
                $("#frmUpdate").find("input[name='email']").val(email);

                $("#modalUpdate").modal("show");
            });

            $(document).on("submit","#frmUpdate",function(e){
                e.preventDefault();
                if(confirm("Apakah anda yakin ingin menyimpan data ini ? ")){
                    $.ajax({
                        url : '{{route('admin.mhs.mhsUpdate')}}',
                        method : "POST",
                        data : new FormData($('#frmUpdate')[0]),
                        contentType : false,
                        cache : false,
                        processData : false,
                        dataType : "JSON",
                        beforeSend : function(){
                            $('#loader').removeClass('show');
                            $('#loader').removeClass('background-grey');
                            $('#loader').addClass('show');
                            $('#loader').addClass('background-grey');
                            $('#loader').css('display','block');
                        },
                        success : function(resp){
                            if(resp.IsError == true){
                                swal_error(
                                    resp.Message,
                                );
                            }
                            else{
                                swal_success(
                                    resp.Message,
                                    '{{route('admin.mhs.index')}}'
                                );
                            }
                        },
                        error : function(){
                            return internalServerError();
                        },
                        complete : function(){
                            $('#loader').removeClass('show');
                            $('#loader').removeClass('background-grey');
                            $('#loader').css('display','none');
                        }
                    })
                }
                else{
                    return false;
                }
            });

            $(document).on("click",".btn-banned",function(){
                let id = $(this).data("id");
                Swal.fire({
                    title :"Peringatan!",
                    text : "Apakah anda yakin ingin menonaktifkan akun ini ?",
                    icon : "warning",
                    showCancelButton : true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if(result.isConfirmed){
                        $('#frmBanned').find('input[name="id"]').val(id);
                        $('#frmBanned').submit();
                    }
                    else{
                        return false;
                    }
                })
            })

            $(document).on("click",".btn-active",function(){
                let id = $(this).data("id");
                Swal.fire({
                    title :"Peringatan!",
                    text : "Apakah anda yakin ingin mengaktifkan akun ini ?",
                    icon : "warning",
                    showCancelButton : true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if(result.isConfirmed){
                        $('#frmActive').find('input[name="id"]').val(id);
                        $('#frmActive').submit();
                    }
                    else{
                        return false;
                    }
                })
            })
        });
    </script>
@endsection
