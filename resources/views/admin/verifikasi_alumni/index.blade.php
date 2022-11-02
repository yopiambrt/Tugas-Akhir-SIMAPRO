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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Tanggal Terbit Ijasah</th>
                                    <th>Bukti Ijasah</th>
                                    <th>Status Kelulusan</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($table as $index => $row)
                                        <tr>
                                            <td>{{$row->user->biodata->nama ?? null}}</td>
                                            <td>{{$row->user->biodata->nim ?? null}}</td>
                                            <td>
                                                @if(!empty($row->tanggal_terbit_ijasah))
                                                <?= date("d-m-Y",strtotime($row->tanggal_terbit_ijasah)) ?>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($row->upload_foto_ijasah))
                                                <a target="_blank" href="{{asset($row->upload_foto_ijasah)}}" class="btn btn-info btn-sm">Lihat</a>
                                                @endif
                                            </td>
                                            <td>
                                                {{$row->status_kelulusan() ?? null}}
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-sm btn-terima" data-id="{{$row->id}}">Terima</a>
                                                <a class="btn btn-danger btn-sm btn-tolak" data-id="{{$row->id}}">Tolak</a>
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
<form class="d-none" method="post" action="{{route("admin.verifikasi_alumni.verifikasi")}}" id="frmTerima">
    @csrf
    <input type="hidden" name="id"/>
</form>
<form class="d-none" method="post" action="{{route("admin.verifikasi_alumni.tolak")}}" id="frmTolak">
    @csrf
    <input type="hidden" name="id"/>
</form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();

            $(document).on("click",".btn-terima",function(){
                let id = $(this).data("id");
                Swal.fire({
                    title :"Peringatan!",
                    text : "Apakah anda yakin ingin menerima pengajuan data ini?",
                    icon : "warning",
                    showCancelButton : true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if(result.isConfirmed){
                        $('#frmTerima').find('input[name="id"]').val(id);
                        $('#frmTerima').submit();
                    }
                    else{
                        return false;
                    }
                })
            })

            $(document).on("click",".btn-tolak",function(){
                let id = $(this).data("id");
                Swal.fire({
                    title :"Peringatan!",
                    text : "Apakah anda yakin ingin menolak pengajuan data ini?",
                    icon : "warning",
                    showCancelButton : true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if(result.isConfirmed){
                        $('#frmTolak').find('input[name="id"]').val(id);
                        $('#frmTolak').submit();
                    }
                    else{
                        return false;
                    }
                })
            })
        });
    </script>
@endsection
