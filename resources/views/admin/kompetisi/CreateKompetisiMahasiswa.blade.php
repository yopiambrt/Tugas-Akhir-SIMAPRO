@extends('layouts.app')
@section('title')
    User
@endsection

@section('content')
    <div class="container-fluid">


        <!-- row -->
        <div class="row">
            <div class="card">
                <form action="{{ route('admin.KompetisiMahasiswa.store') }}" method="post">
                    @csrf
                    <div class="col-lg-12 mt-4">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">Kegiatan Skala</label>

                                <select name="id_kegiatan_skala" class="form-control" required>
                                    @foreach ($kegiatanSkala as $skala)
                                        <option value="">-- PILIH OPSI --</option>
                                        <option value="{{ $skala->id }}">{{ $skala->skala }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">Label Kompetisi</label>

                                <select name="id_kompetisi_label" class="form-control" required>
                                    @foreach ($kompetisilabel as $label)
                                        <option value="">-- PILIH OPSI --</option>
                                        <option value="{{ $label->id }}">{{ $label->nama_label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">Kategori Kompetisi</label>

                                <select name="id_kompetisi_kategori" class="form-control" required>
                                    @foreach ($kompetisikategori as $kategori)
                                        <option value="">-- PILIH OPSI --</option>
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">kepanjangan</label>
                                <input type="text" name="kepanjangan" id="" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">periode</label>
                                <input type="number" name="periode" id="" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">keterangan</label>
                                <input type="text" name="keterangan" id="" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">nama</label>
                                <input type="text" name="nama" id="" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">Kompetisi Penyelenggara</label>
                                <select name="id_kompetisi_penyelenggara" id="" class="form-control" required>
                                    <option value="">-- PILIH OPSI --</option>
                                    @foreach ($kompetisiPenyelenggara as $penyelenggara)
                                        <option value="{{ $penyelenggara->id }}">
                                            {{ $penyelenggara->nama_penyelenggara }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for=""> Kabupaten</label>
                                <input type="text" name="kota_kabupaten" id="" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for=""> Register Dibuka</label>
                                <input type="date" name="register_buka" id="" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for=""> Register Ditutup</label>
                                <input type="date" name="register_tutup" id="" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for=""> Pelaksanaan dimulai</label>
                                <input type="date" name="pelaksanaan_awal" id="" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for=""> Pelaksanaan Selesai</label>
                                <input type="date" name="pelaksanaan_akhir" id="" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">hadiah</label>
                                <input type="text" name="hadiah" id="" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">biaya</label>
                                <input type="number" name="biaya" id="" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">tautan</label>
                                <input type="text" name="tautan" id="" class="form-control" required>
                            </div>
                            <div class="col-lg-4 col-sm-6 form-group">
                                <label for="">deskripsi</label>
                                <textarea name="deskripsi" id="" rows="5" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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
