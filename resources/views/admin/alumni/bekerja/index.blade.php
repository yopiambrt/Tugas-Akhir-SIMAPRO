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
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="#" class="btn btn-primary btn-add">
                                    <i class="fa fa-plus">Tambah Alumni Bekerja</i>
                                </a>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <a href="#" class="btn btn-info btn-sm btn-filter">
                                    Filter Data
                                </a>
                                <a href="#" class="btn btn-info btn-sm btn-export-excel" style="margin-left: 2px;">
                                    Export Excel
                                </a>
                                <a href="#" class="btn btn-info btn-sm btn-export-pdf" style="margin-left: 2px;">
                                    Export PDF
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Nama Instansi</th>
                                    <th>Jenis Pekerjaan</th>
                                    <th>Jenis Perusahaan</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($table as $index => $row)
                                        <tr>
                                            <td>{{$row->user->biodata->nama ?? null}}</td>
                                            <td>{{$row->user->biodata->nim ?? null}}</td>
                                            <td>
                                                @if(!empty($row->tanggal_mulai))
                                                <?= date("d-m-Y",strtotime($row->tanggal_mulai)) ?>
                                                @endif
                                            </td>
                                            <td>{{$row->nama_instansi}}</td>
                                            <td>{{$row->jenis_pekerjaan}}</td>
                                            <td>{{$row->jenis_perusahaan->nama ?? null}}</td>
                                            <td>
                                                <a href="{{route("admin.alumni.bekerja.show",$row->id)}}" class="btn btn-warning btn-sm mb-1"><i class="fa fa-eye"></i></a>
                                                <a href="{{route("admin.alumni.bekerja.edit",$row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm btn-delete" data-id="{{$row->id}}"><i class="fa fa-trash"></i></a>
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

<div class="modal fade" id="modalJenisPerusahaan" tabindex="-1" aria-labelledby="modalJenisPerusahaanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalJenisPerusahaanLabel">Jenis Perusahaan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                @foreach ($jenis_perusahaan as $index => $row)
                <div class="col-lg-4" style="cursor: pointer">
                    <div class="card pilih-perusahaan" style="min-height: 120px;background-color  :	#DCDCDC	" data-id="{{$row->id}}">
                        <div class="card-body text-center" style="height: 100%;">
                            <p class="d-flex align-items-center justify-content-center"><b>{{$row->nama}}</b></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExport" tabindex="-1" aria-labelledby="modalExportLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalExportLabel">Export <span class="export-type"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="get" action="#" id="frmExport">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Jenis Perusahaan</label>
                                <select class="form-control" name="jenis_perusahaan_id">
                                    <option value="">==Semua jenis perusahaan==</option>
                                    @foreach ($jenis_perusahaan as $index => $row)
                                    <option value="{{$row->id}}">{{$row->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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

<div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="modalFilterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFilterLabel">Filter Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="get" action="{{route("admin.alumni.bekerja.index")}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Jenis Perusahaan</label>
                                <select class="form-control" name="jenis_perusahaan_id">
                                    <option value="">==Semua jenis perusahaan==</option>
                                    @foreach ($jenis_perusahaan as $index => $row)
                                    <option value="{{$row->id}}">{{$row->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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

<form class="d-none" method="post" action="{{route("admin.alumni.bekerja.destroy")}}" id="frmDestroy">
    @csrf
    <input type="hidden" name="id"/>
</form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();

            $(document).on("click",".btn-add",function(){
                $("#modalJenisPerusahaan").modal("show");
            });

            $(document).on("click",".btn-filter",function(){
                $("#modalFilter").modal("show");
            });

            $(document).on("click",".btn-export-excel",function(){
                $("#modalExport").find(".export-type").html("Excel");
                $("#frmExport").attr("action","{{route("admin.alumni.bekerja.export_excel")}}");
                $("#modalExport").modal("show");
            });

            $(document).on("click",".btn-export-pdf",function(){
                $("#modalExport").find(".export-type").html("PDF");
                $("#frmExport").attr("action","{{route("admin.alumni.bekerja.export_pdf")}}");
                $("#modalExport").modal("show");
            });

            $(document).on("click",".pilih-perusahaan",function(){
                let id = $(this).attr("data-id");

                location.href = '{{route("admin.alumni.bekerja.create")}}' + '?perusahaan_id=' + id;
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
