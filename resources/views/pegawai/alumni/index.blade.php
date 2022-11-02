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
                                    <th>Tahun Masuk</th>
                                    <th>Tanggal Lulus</th>
                                    <th>Status Kelulusan</th>
                                    <th>Pekerjaan</th>
                                    <th>Status Verifikasi</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($table as $index => $row)
                                        <tr>
                                            <td>{{$row->user->biodata->nama ?? null}}</td>
                                            <td>{{$row->user->biodata->nim ?? null}}</td>
                                            <td>{{$row->user->biodata->tahun_masuk ?? null}}</td>
                                            <td>
                                                @if(!empty($row->tanggal_lulus))
                                                <?= date("d-m-Y",strtotime($row->tanggal_lulus)) ?>
                                                @endif
                                            </td>
                                            <td>
                                                {{$row->status_kelulusan() ?? null}}
                                            </td>
                                            <td>
                                                {{$row->status_pekerjaan->nama ?? null}}
                                                <a href="{{route("pegawai.alumni.riwayat_pekerjaan",$row->user->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-history"></i> Riwayat</a>
                                            </td>
                                            <td>
                                                <span class="bg bg-{{$row->status_verifikasi()->class ?? null}}">
                                                    {{$row->status_verifikasi()->msg ?? null}}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{route("pegawai.alumni.show",$row->id)}}" class="btn btn-warning btn-sm mb-1"><i class="fa fa-eye"></i></a>
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
