@extends('layouts.app')
@section('title')
    User
@endsection

@section('content')
    <div class="container-fluid">


        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <a href="{{ route('admin.KompetisiMahasiswa.create') }}" class="btn btn-primary">
                            Tambah Kompetisi
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12 table-responsive">
                            <table id="example" class="table table-striped table-bordered " style="width:100%">
                                <thead>
                                    <tr>
                                        {{-- <th>id kegiatan skala</th> --}}
                                        {{-- <th>kepanjangan</th> --}}
                                        {{-- <th>deskripsi</th> --}}
                                        <th>periode</th>
                                        {{-- <th>id kompetisi</th> --}}
                                        {{-- <th>akun update</th> --}}
                                        {{-- <th>akun create</th> --}}
                                        {{-- <th>keterangan</th> --}}
                                        <th>kompetisi penyelenggara</th>
                                        <th>nama</th>
                                        <th>kota_kabupaten</th>
                                        {{-- <th>register buka</th> --}}
                                        <th>pelaksanaan awal</th>
                                        <th>pelaksanaan akhir</th>
                                        {{-- <th>register tutup</th> --}}
                                        <th>hadiah</th>
                                        <th>biaya</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($KompetisiMahasiswa as $item)
                                        <tr>
                                            {{-- <td>{{ $item->id_kegiatan_skala }}</td> --}}
                                            {{-- <td>{{ $item->kepanjangan }}</td> --}}
                                            {{-- <td>{{ $item->deskripsi }}</td> --}}
                                            <td>{{ $item->periode }}</td>
                                            {{-- <td>{{ $item->id_kompetisi }}</td> --}}
                                            {{-- <td>{{ $item->akun_update }}</td> --}}
                                            {{-- <td>{{ $item->akun_create }}</td> --}}
                                            {{-- <td>{{ $item->keterangan }}</td> --}}
                                            <td>{{ $item->id_kompetisi_penyelenggara }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->kota_kabupaten }}</td>
                                            {{-- <td>{{ $item->register_buka }}</td> --}}
                                            <td>{{ $item->pelaksanaan_awal }}</td>
                                            <td>{{ $item->pelaksanaan_akhir }}</td>
                                            {{-- <td>{{ $item->register_tutup }}</td> --}}
                                            <td>{{ $item->hadiah }}</td>
                                            <td>Rp. {{ number_format($item->biaya, 0, ',', '.') }}</td>
                                            {{-- <td>{{ $item->tautan }}</td> --}}
                                            <td>
                                                <a href="{{ route('admin.KompetisiMahasiswa.show', $item->id) }}"
                                                    class="btn  btn-warning btn-sm">Update</a>
                                                <a href="{{ route('admin.KompetisiMahasiswa.delete', $item->id) }}"
                                                    class="btn  btn-danger btn-sm">Delete</a>
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
