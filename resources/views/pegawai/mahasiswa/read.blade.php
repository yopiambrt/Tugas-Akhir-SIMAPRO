@extends('layouts.app')
@section('title')
    Mahasiswa Read
@endsection

@section('content')
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <a href="{{ route('admin.mhs.index') }}" class="btn btn-danger btn-sm">
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.mhs.store', $mhs->id) }}" method="post">
                            @csrf
                            <div class="col-12">
                                <h4>DATA MAHASISWA</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">Name</label>
                                        <input required type="text" name="name" value="{{ $mhs->name }}"
                                            class="form-control" disabled>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">Email</label>
                                        <input required type="text" name="email" value="{{ $mhs->email }}"
                                            class="form-control" disabled>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NIM</label>
                                        @if (empty($mhs->alamat->user_id))
                                            <input required type="text" name="nim" placeholder="masukan NIM..."
                                                class="form-control">
                                        @else
                                            <input required type="text" name="nim" value="{{ $mhs->alamat->nim }}"
                                                placeholder="masukan NIM..." class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">STATUS ALAMAT</label>
                                        <select name="alamat_status" id="" class="form-control">
                                            @if (empty($mhs->alamat->user_id))
                                                <option value="KONTAKAN">PILIH OPSI</option>
                                            @else
                                                <option value="{{ $mhs->alamat->alamat_status }}">
                                                    {{ $mhs->alamat->alamat_status }}</option>
                                            @endif
                                            <option value="KONTRAKAN">KONRTAKAN</option>
                                            <option value="RUMAH">RUMAH</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">ALAMAT TINGGAL</label>
                                        <textarea name="alamat_tinggal" class="form-control" id="" rows="5">
                                        @if (empty($mhs->alamat->user_id))
@else
{{ $mhs->alamat->alamat_tinggal }}
@endif
                                        </textarea>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">JENIS SEKOLAH ATAS</label>
                                        <select name="jenis_sekolah_atas" id="" class="form-control">
                                            @if (empty($mhs->sekolah->user_id))
                                                <option value="">-- PILIH OPSI ---</option>
                                            @else
                                                <option value="{{ $mhs->sekolah->jenis_sekolah_atas }}">
                                                    {{ $mhs->sekolah->jenis_sekolah_atas }}</option>
                                            @endif
                                            <option value="SMK">SMK</option>
                                            <option value="PESANTREN">PESANTREN</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NAMA SEKOLAH ATAS</label>
                                        @if (empty($mhs->sekolah->user_id))
                                            <input required type="text" name="nama_sekolah_atas"
                                                placeholder="masukan NAMA SEKOLAH ATAS..." class="form-control">
                                        @else
                                            <input required type="text" name="nama_sekolah_atas"
                                                value="{{ $mhs->sekolah->nama_sekolah_atas }}"
                                                placeholder="masukan NAMA SEKOLAH ATAS..." class="form-control">
                                        @endif

                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NAMA SMP</label>
                                        @if (empty($mhs->sekolah->user_id))
                                            <input required type="text" name="nama_smp" placeholder="masukan NAMA SMP..."
                                                class="form-control">
                                        @else
                                            <input required type="text" name="nama_smp"
                                                value="{{ $mhs->sekolah->nama_smp }}" placeholder="masukan NAMA SMP..."
                                                class="form-control">
                                        @endif

                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NAMA SD</label>
                                        @if (empty($mhs->sekolah->user_id))
                                            <input required type="text" name="nama_sd" placeholder="masukan NAMA SD..."
                                                class="form-control">
                                        @else
                                            <input required type="text" name="nama_sd"
                                                value="{{ $mhs->sekolah->nama_sd }}" placeholder="masukan NAMA SD..."
                                                class="form-control">
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4>DATA KELUARGA</h4>
                            <hr>
                            <div class="col-12">


                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NAMA ayah</label>
                                        @if (empty($mhs->dataKeluarga->user_id))
                                            <input required type="text" name="ayah_nama"
                                                placeholder="masukan NAMA ayah.." class="form-control">
                                        @else
                                            <input required type="text" name="ayah_nama"
                                                value="{{ $mhs->dataKeluarga->ayah_nama }}"
                                                placeholder="masukan NAMA SD..." class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NO TELEPON (ayah)</label>
                                        @if (empty($mhs->dataKeluarga->user_id))
                                            <input required type="text" name="ayah_telepon"
                                                placeholder="masukan NAMA ayah.." class="form-control">
                                        @else
                                            <input required type="text" name="ayah_telepon"
                                                value="{{ $mhs->dataKeluarga->ayah_telepon }}"
                                                placeholder="masukan NAMA SD..." class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">PENDIDIKAN TERAKHIR</label>
                                        @if (empty($mhs->dataKeluarga->user_id))
                                            <input required type="text" name="ayah_pendidikan_terakhir"
                                                placeholder="masukan PENDIDIKAN TERAKHIR.." class="form-control">
                                        @else
                                            <input required type="text" name="ayah_pendidikan_terakhir"
                                                value="{{ $mhs->dataKeluarga->ayah_pendidikan_terakhir }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">PEKERJAAN</label>
                                        @if (empty($mhs->dataKeluarga->user_id))
                                            <input required type="text" name="ayah_pekerjaan"
                                                placeholder="masukan PEKERJAAN.." class="form-control">
                                        @else
                                            <input required type="text" name="ayah_pekerjaan"
                                                value="{{ $mhs->dataKeluarga->ayah_pendidikan_terakhir }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">PENDAPATAN</label>
                                        @if (empty($mhs->dataKeluarga->user_id))
                                            <input required type="number" name="ayah_gaji" placeholder="masukan .."
                                                class="form-control">
                                        @else
                                            <input required type="number" name="ayah_gaji"
                                                value="{{ $mhs->dataKeluarga->ayah_gaji }}" class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">ALAMAT TINGGAL</label>
                                        <textarea name="ayah_alamat" class="form-control" id="" rows="5">
                                        @if (empty($mhs->dataKeluarga->user_id))
@else
{{ $mhs->dataKeluarga->ayah_alamat }}
@endif
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">


                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NAMA ibu</label>
                                        @if (empty($mhs->dataKeluarga->user_id))
                                            <input required type="text" name="ibu_nama"
                                                placeholder="masukan NAMA ibu.." class="form-control">
                                        @else
                                            <input required type="text" name="ibu_nama"
                                                value="{{ $mhs->dataKeluarga->ibu_nama }}"
                                                placeholder="masukan NAMA SD..." class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NO TELEPON (ibu)</label>
                                        @if (empty($mhs->dataKeluarga->user_id))
                                            <input required type="text" name="ibu_telepon"
                                                placeholder="masukan NAMA ibu.." class="form-control">
                                        @else
                                            <input required type="text" name="ibu_telepon"
                                                value="{{ $mhs->dataKeluarga->ibu_telepon }}"
                                                placeholder="masukan NAMA SD..." class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">PENDIDIKAN TERAKHIR</label>
                                        @if (empty($mhs->dataKeluarga->user_id))
                                            <input required type="text" name="ibu_pendidikan_terakhir"
                                                placeholder="masukan PENDIDIKAN TERAKHIR.." class="form-control">
                                        @else
                                            <input required type="text" name="ibu_pendidikan_terakhir"
                                                value="{{ $mhs->dataKeluarga->ibu_pendidikan_terakhir }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">PEKERJAAN</label>
                                        @if (empty($mhs->dataKeluarga->user_id))
                                            <input required type="text" name="ibu_pekerjaan"
                                                placeholder="masukan PEKERJAAN.." class="form-control">
                                        @else
                                            <input required type="text" name="ibu_pekerjaan"
                                                value="{{ $mhs->dataKeluarga->ibu_pendidikan_terakhir }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">PENDAPATAN</label>
                                        @if (empty($mhs->dataKeluarga->user_id))
                                            <input required type="number" name="ibu_gaji" placeholder="masukan .."
                                                class="form-control">
                                        @else
                                            <input required type="number" name="ibu_gaji"
                                                value="{{ $mhs->dataKeluarga->ibu_gaji }}" class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">ALAMAT TINGGAL</label>
                                        <textarea name="ibu_alamat" class="form-control" id="" rows="5">
                                        @if (empty($mhs->dataKeluarga->user_id))
@else
{{ $mhs->dataKeluarga->ibu_alamat }}
@endif
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">JUMLAH KAKAK</label>
                                        @if (empty($mhs->dataKeluarga->user_id))
                                            <input required type="number" name="kakak_jumlah" placeholder="masukan .."
                                                class="form-control">
                                        @else
                                            <input required type="number" name="kakak_jumlah"
                                                value="{{ $mhs->dataKeluarga->kakak_jumlah }}" class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">JUMLAH ADIK</label>
                                        @if (empty($mhs->dataKeluarga->user_id))
                                            <input required type="number" name="adik_jumlah" placeholder="masukan .."
                                                class="form-control">
                                        @else
                                            <input required type="number" name="adik_jumlah"
                                                value="{{ $mhs->dataKeluarga->adik_jumlah }}" class="form-control">
                                        @endif
                                    </div>
                                </div>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-warning">SIMPAN</button>
                    </form>
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
