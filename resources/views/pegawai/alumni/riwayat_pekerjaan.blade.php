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
                        <div class="row">
                            <div class="col-12">
                                <!-- Nav tabs -->
                                <h5 class="mb-2">RIWAYAT PEKERJAAN</h5>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="riwayat-bekerja-tab" data-bs-toggle="tab" data-bs-target="#riwayat-bekerja" type="button" role="tab" aria-controls="riwayat-bekerja" aria-selected="true">Riwayat Bekerja</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="wirausaha-tab" data-bs-toggle="tab" data-bs-target="#wirausaha" type="button" role="tab" aria-controls="wirausaha" aria-selected="false">Riwayat Wirausaha</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="studi-lanjut-tab" data-bs-toggle="tab" data-bs-target="#studi-lanjut" type="button" role="tab" aria-controls="studi-lanjut" aria-selected="false">Studi Lanjut</button>
                                        </li>
                                </ul>
                                
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="riwayat-bekerja" role="tabpanel" aria-labelledby="riwayat-bekerja-tab">
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="example" class="table table-striped" style="width:100%">
                                                        <thead>
                                                            <th>Nama</th>
                                                            <th>NIM</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Nama Instansi</th>
                                                            <th>Jenis Pekerjaan</th>
                                                            <th>Jenis Perusahaan</th>
                                                            <th>Created At</th>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($bekerja as $index => $row)
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
                                                                    <td>{{date("d-m-Y H:i:s",strtotime($row->created_at))}}</td>
                                                                </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="10" class="text-center">Data tidak ditemukan</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="wirausaha" role="tabpanel" aria-labelledby="wirausaha-tab">
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="example" class="table table-striped" style="width:100%">
                                                        <thead>
                                                            <th>Nama</th>
                                                            <th>NIM</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Nama Usaha</th>
                                                            <th>Jenis Usaha</th>
                                                            <th>Level Usaha</th>
                                                            <th>Created At</th>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($wirausaha as $index => $row)
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
                                                                    <td>{{date("d-m-Y H:i:s",strtotime($row->created_at))}}</td>
                                                                </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="10" class="text-center">Data tidak ditemukan</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="studi-lanjut" role="tabpanel" aria-labelledby="studi-lanjut-tab">
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="example" class="table table-striped" style="width:100%">
                                                        <thead>
                                                            <th>Nama</th>
                                                            <th>NIM</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Nama Universitas</th>
                                                            <th>Program Studi</th>
                                                            <th>Fakultas</th>
                                                            <th>Created At</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($studi_lanjut as $index => $row)
                                                                <tr>
                                                                    <td>{{$row->user->biodata->nama ?? null}}</td>
                                                                    <td>{{$row->user->biodata->nim ?? null}}</td>
                                                                    <td>
                                                                        @if(!empty($row->tanggal_mulai))
                                                                        <?= date("d-m-Y",strtotime($row->tanggal_mulai)) ?>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{$row->nama_universitas}}</td>
                                                                    <td>{{$row->program_studi}}</td>
                                                                    <td>{{$row->fakultas}}</td>
                                                                    <td>{{date("d-m-Y H:i:s",strtotime($row->created_at))}}</td>
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
        });
    </script>
@endsection
