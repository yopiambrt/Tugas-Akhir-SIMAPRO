@extends('layouts.app')
@section('title')
    User
@endsection

@section('content')
    <div class="container-fluid">


        <!-- row -->
        <div class="row">
            <div class="card">
                <form action="{{ route('admin.KompetisiMahasiswa.update', $kompetisi->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="col-lg-12 mt-4">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">Kegiatan Skala</label>

                                <select name="id_kegiatan_skala" class="form-control" required>
                                    <option value="{{ $kompetisi->id_kegiatan_skala }}">
                                        {{ $kompetisi->kegiatanSkala->skala }}</option>
                                    @foreach ($kegiatanSkala as $skala)
                                        <option value="{{ $skala->id }}">{{ $skala->skala }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">kepanjangan</label>
                                <input type="text" name="kepanjangan" value="{{ $kompetisi->kepanjangan }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">periode</label>
                                <input type="number" name="periode" value="{{ $kompetisi->periode }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">keterangan</label>
                                <input type="text" name="keterangan" value="{{ $kompetisi->keterangan }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">nama</label>
                                <input type="text" name="nama" value="{{ $kompetisi->nama }}" class="form-control"
                                    required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">Kompetisi Penyelenggara</label>
                                <select name="id_kompetisi_penyelenggara" id="" class="form-control" required>
                                    <option value="{{ $kompetisi->id_kompetisi_penyelenggara }}">
                                        {{ $kompetisi->kompetisiPenyelenggara->nama_penyelenggara }}</option>
                                    @foreach ($kompetisiPenyelenggara as $penyelenggara)
                                        <option value="{{ $penyelenggara->id }}">
                                            {{ $penyelenggara->nama_penyelenggara }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for=""> Kabupaten</label>
                                <input type="text" name="kota_kabupaten" value="{{ $kompetisi->kota_kabupaten }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for=""> Register Dibuka</label>
                                <input type="date" name="register_buka" value="{{ $kompetisi->register_buka }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for=""> Register Ditutup</label>
                                <input type="date" name="register_tutup" value="{{ $kompetisi->register_tutup }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for=""> Pelaksanaan dimulai</label>
                                <input type="date" name="pelaksanaan_awal" value="{{ $kompetisi->pelaksanaan_awal }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for=""> Pelaksanaan Selesai</label>
                                <input type="date" name="pelaksanaan_akhir"
                                    value="{{ $kompetisi->pelaksanaan_akhir }}" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">hadiah</label>
                                <input type="text" name="hadiah" value="{{ $kompetisi->hadiah }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">biaya</label>
                                <input type="number" name="biaya" value="{{ $kompetisi->biaya }}" class="form-control"
                                    required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">tautan</label>
                                <input type="text" name="tautan" value="{{ $kompetisi->tautan }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">deskripsi</label>
                                <textarea name="deskripsi" id="" rows="5" class="form-control" required>{{ $kompetisi->deskripsi }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-warning btn-sm">Update</button>
                        </div>
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
        });
    </script>
@endsection
