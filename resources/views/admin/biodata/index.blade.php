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
                        <a href="{{route("admin.biodata.create")}}" class="btn btn-primary">
                            <i class="fa fa-plus">Tambah Biodata</i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tahun Masuk</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($table as $index => $row)
                                        <tr>
                                            <td>{{$row->user->biodata->nama ?? null}}</td>
                                            <td>{{$row->user->biodata->nim ?? null}}</td>
                                            <td>{{$row->jk() ?? null}}</td>
                                            <td>{{$row->tahun_masuk}}</td>
                                            <td>
                                                <a href="{{route("admin.biodata.show",$row->id)}}" class="btn btn-warning btn-sm mb-1"><i class="fa fa-eye"></i></a>
                                                <a href="{{route("admin.biodata.edit",$row->id)}}" class="btn btn-warning btn-sm mb-1"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm btn-delete mb-1" data-id="{{$row->id}}"><i class="fa fa-trash"></i></a>
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

<form class="d-none" method="post" action="{{route("admin.biodata.destroy")}}" id="frmDestroy">
    @csrf
    <input type="hidden" name="id"/>
</form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();

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
