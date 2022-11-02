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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Prestasi
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <th>Nama Mahasiswa</th>
                                <th>Kompetisi</th>
                                <th>Hasil</th>
                                <th>Tanggal Upload</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->kompetisi->nama }}</td>
                                        <td>{{ $item->hasil->hasil }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_upload)) }}</td>

                                        <td>

                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}"
                                                class="btn btn-warning btn-sm">edit</a>
                                            <a href="{{ route('admin.prestasi.delete', $item->id) }}"
                                                class="btn btn-danger btn-sm">delete</a>


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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Prestasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.prestasi.store') }}" method="post">
                        @csrf
                        <div class="form-group"><label for="">Nama</label>
                            <select name="user_id" id="" class="form-control">
                                <option value="">-- pilih opsi --</option>
                                @foreach ($mhs as $mhsiswa)
                                    @if ($mhsiswa->is_admin == '4')
                                        <option value="{{ $mhsiswa->id }}">{{ $mhsiswa->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group"><label for="">Kompetisi</label>
                            <select name="id_kompetisi" id="" class="form-control">
                                <option value="">-- pilih opsi --</option>
                                @foreach ($kompetisi as $kmpt)
                                    <option value="{{ $kmpt->id }}">{{ $kmpt->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group"><label for="">Team</label>
                            <textarea name="team" id="" cols="30" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group"><label for="">Hasil</label>
                            <select name="id_kompetisi_hasil" id="" class="form-control">
                                <option value="">-- pilih opsi --</option>
                                @foreach ($hasil as $hsl)
                                    <option value="{{ $hsl->id }}">{{ $hsl->hasil }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($users as $usr)
        <!-- Modal -->
        <div class="modal fade" id="exampleModal-{{ $usr->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Prestasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.prestasi.update', $usr->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group"><label for="">Nama</label>
                                <select name="user_id" id="" class="form-control">
                                    <option value="{{ $usr->user_id }}">{{ $usr->user->name }}</option>
                                    @foreach ($mhs as $mhsiswa)
                                        @if ($mhsiswa->is_admin == '4')
                                            <option value="{{ $mhsiswa->id }}">{{ $mhsiswa->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group"><label for="">Kompetisi</label>
                                <select name="id_kompetisi" id="" class="form-control">
                                    <option value="{{ $usr->id_kompetisi }}">{{ $usr->kompetisi->nama }}</option>
                                    @foreach ($kompetisi as $kmpt)
                                        <option value="{{ $kmpt->id }}">{{ $kmpt->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group"><label for="">Team</label>
                                <textarea name="team" id="" cols="30" class="form-control" rows="5">{{ $usr->team }}</textarea>
                            </div>
                            <div class="form-group"><label for="">Hasil</label>
                                <select name="id_kompetisi_hasil" id="" class="form-control">
                                    <option value="{{ $usr->id_kompetisi_hasil }}">{{ $usr->hasil->hasil }}</option>
                                    @foreach ($hasil as $hsl)
                                        <option value="{{ $hsl->id }}">{{ $hsl->hasil }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
