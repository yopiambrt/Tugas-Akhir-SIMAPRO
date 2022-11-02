@extends('layouts.app')
@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3>Detail Kompetisi</h3>
                    </div>
                    <div class="col card-header text-right">
                        <a href="{{ route('admin.KompetisiMahasiswa.show', $kompetisi->id) }}" class="btn btn-primary">
                            Ubah Data Kompetisi
                        </a>
                        <a href="{{ route('admin.KompetisiMahasiswa.delete', $kompetisi->id) }}" class="btn btn-danger">
                            Hapus Data Kompetisi
                        </a>
                        <a href="{{ route('admin.KompetisiMahasiswa.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <h5>Poster Kompetisi</h5>
                        <p>Tampil Gambar Kompetisi yang sudah di upload di form Kompetisi ( Jika Tidak Ada Mohon Dicek Terlebih dahulu dimenu poster )</p>
                        <img src="/{{$dataposter}}" alt="">

                    </div>
                    <div class="table-responsive">
                        <table class="table">

                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{$kompetisi->nama}}</td>
                                </tr>
                                <tr>
                                    <td>Kepanjangan</td>
                                    <td>: {{$kompetisi->kepanjangan}}</td>
                                </tr>
                                <tr>
                                    <td>Tahun</td>
                                    <td>:{{$kompetisi->periode}}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>: {{ $kompetisi->deskripsi }}</td>
                                </tr>
                                <tr>
                                    <td>Penyelenggara</td>
                                    <td>:{{$datapenyelanggara_jenis->jenis_penyelenggara}}</td>
                                </tr>
                                <tr>
                                    <td>Skala Kegiatan</td>
                                    <td>:{{$datakegiatanskala->skala}}</td>
                                </tr>
                                <tr>
                                    <td>Daftar Label</td>
                                    <td>:{{$datalabelkompetisi->nama_label}}</td>
                                </tr>
                                <tr>
                                    <td>Daftar Kategori</td>
                                    <td>:{{$datakategorikompetisi->nama_kategori}}</td>
                                </tr>
                                <tr>
                                    <td>Pelaksanaan Registrasi</td>
                                    <td>:{{ $kompetisi->register_buka }} </td>
                                </tr>
                                <tr>
                                    <td>Penutupan Registrasi</td>
                                    <td>: {{ $kompetisi->register_tutup }}</td>
                                </tr>
                                <tr>
                                    <td>Pelaksanaan Awal Kegiatan</td>
                                    <td>: {{ $kompetisi->pelaksanaan_awal }}</td>
                                </tr>
                                <tr>
                                    <td>Pelaksanaan Akhir Kegiatan</td>
                                    <td>: {{ $kompetisi->pelaksanaan_akhir }}</td>
                                </tr>
                                <tr>
                                    <td>Biaya </td>
                                    <td>:  Rp.{{ number_format($kompetisi->biaya) }}</td>
                                </tr>
                                <tr>
                                    <td>Hadiah </td>
                                    <td>: Rp.{{ number_format($kompetisi->hadiah) }}</td>
                                </tr>
                                <tr>
                                    <td>Tautan / URL </td>
                                    <td>: <a href="{{ $kompetisi->tautan }}">{{ $kompetisi->tautan }}</a></td>
                                </tr>
                                <tr>
                                    <td>Panduan</td>
                                    <td>: {{$datapanduan}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>





        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
