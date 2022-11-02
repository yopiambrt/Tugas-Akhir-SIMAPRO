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
                        <a href="#" class="btn btn-primary btn-add">
                            <i class="fa fa-plus">Tambah Jenis Usaha</i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($table as $index => $row)
                                        <tr>
                                            <td>{{$row->nama}}</td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="{{$row->id}}" data-nama="{{$row->nama}}"><i class="fa fa-edit" ></i></a>
                                                <a class="btn btn-danger btn-sm btn-delete" data-id="{{$row->id}}" data-nama="{{$row->nama}}"><i class="fa fa-trash"></i></a>
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


<div class="modal fade" id="modalStore" tabindex="-1" aria-labelledby="modalStoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalStoreLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frmStore" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frmUpdate" method="post" autocomplete="off">
                @csrf
                <input type="hidden" name="id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<form class="d-none" method="post" action="{{route("admin.master.jenis_usaha.destroy")}}" id="frmDestroy">
    @csrf
    <input type="hidden" name="id"/>
</form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();

            $(document).on("click",".btn-add",function(){
                $("#modalStore").modal("show");
            });

            $(document).on("click",".btn-edit",function(){
                let id = $(this).data("id");
                let nama = $(this).data("nama");
                
                $("#frmUpdate").find('input[name="id"]').val(id);
                $("#frmUpdate").find('input[name="nama"]').val(nama);
                $("#modalUpdate").modal("show");
            });

            $(document).on("submit","#frmStore",function(e){
                e.preventDefault();
                if(confirm("Apakah anda yakin ingin menyimpan data ini ? ")){
                    $.ajax({
                        url : '{{route('admin.master.jenis_usaha.store')}}',
                        method : "POST",
                        data : new FormData($('#frmStore')[0]),
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
                                    '{{route('admin.master.jenis_usaha.index')}}'
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

            $(document).on("submit","#frmUpdate",function(e){
                e.preventDefault();
                if(confirm("Apakah anda yakin ingin menyimpan data ini ? ")){
                    $.ajax({
                        url : '{{route('admin.master.jenis_usaha.update')}}',
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
                                    '{{route('admin.master.jenis_usaha.index')}}'
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

            $(document).on("click",".btn-delete",function(){
                let id = $(this).data("id");
                Swal.fire({
                    title :"Peringatan!",
                    text : "Apakah anda yakin ingin menghapus data ini ?",
                    icon : "warning",
                    showCancelButton : true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if(result.isConfirmed){
                        $('#frmDestroy').find('input[name="id"]').val(id);
                        $('#frmDestroy').submit();
                    }
                    else{
                        return false;
                    }
                })
            })
        });
    </script>
@endsection
