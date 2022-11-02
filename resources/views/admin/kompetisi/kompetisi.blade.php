@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Kompetisi</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <a href="{{ route('admin.KompetisiMahasiswa.create') }}" class="btn btn-primary">Tambah
                                Kompetisi</a>
                        </div>
                        <div class="dt-ext table-responsive">
                            <table class="display" id="custom-button">
                                <thead>
                                    <tr>
                                        <th>Nama Kompetisi</th>
                                        <th>Label</th>
                                        <th>Tahun</th>
                                        <th>Penyelenggara</th>
                                        <th>Skala</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($KompetisiMahasiswa as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $item->nama }}</td>
                                            
                                                <td>{{$item->id_kompetisi_label}}</td>
                                     
                                               
                                        
                                            <td>{{$item->pelaksanaan_awal}}</td>
                                            <td>{{ $item->kompetisiPenyelenggara->nama_penyelenggara }}</td>
                                            <td>{{ $item->kegiatanSkala->skala }}</td>
                                            <td>
                                                <a href="{{ route('admin.KompetisiMahasiswa.detail', $item->id) }}"
                                                    class="btn  btn-secondary btn-sm">Detail</a>
                                                <a href="{{ route('admin.KompetisiMahasiswa.show', $item->id) }}"
                                                    class="btn  btn-warning btn-sm">Edit</a>
                                                <a href="{{ route('admin.KompetisiMahasiswa.delete', $item->id) }}"
                                                    class="btn  btn-danger btn-sm mt-2">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach



                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
