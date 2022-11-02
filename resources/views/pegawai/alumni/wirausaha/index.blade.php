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
                        <div class="row">
                            <div class="col-lg-6">
                                
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <a href="{{route("pegawai.alumni.wirausaha.export_excel")}}" class="btn btn-info btn-sm">
                                    Export Excel
                                </a>
                                <a href="{{route("pegawai.alumni.wirausaha.export_pdf")}}" class="btn btn-info btn-sm" style="margin-left: 2px;">
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
                                    <th>Nama Usaha</th>
                                    <th>Jenis Usaha</th>
                                    <th>Level Usaha</th>
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
                                            <td>{{$row->nama_usaha}}</td>
                                            <td>{{$row->jenis_usaha->nama ?? null}}</td>
                                            <td>{{$row->level_usaha->nama ?? null}}</td>
                                            <td>
                                                <a href="{{route("pegawai.alumni.wirausaha.show",$row->id)}}" class="btn btn-warning btn-sm mb-1"><i class="fa fa-eye"></i></a>
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
