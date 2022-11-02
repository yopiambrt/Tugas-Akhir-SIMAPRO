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
                                                <a href="{{route("pegawai.alumni.bekerja.show",$row->id)}}" class="btn btn-warning btn-sm mb-1"><i class="fa fa-eye"></i></a>
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
            <form method="get" action="{{route("pegawai.alumni.bekerja.index")}}">
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
                $("#frmExport").attr("action","{{route("pegawai.alumni.bekerja.export_excel")}}");
                $("#modalExport").modal("show");
            });

            $(document).on("click",".btn-export-pdf",function(){
                $("#modalExport").find(".export-type").html("PDF");
                $("#frmExport").attr("action","{{route("pegawai.alumni.bekerja.export_pdf")}}");
                $("#modalExport").modal("show");
            });
        });
    </script>
@endsection
