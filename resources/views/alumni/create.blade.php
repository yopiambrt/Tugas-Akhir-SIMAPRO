@extends('layouts.app')
@section('title')
    Create
@endsection

@section('content')
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <form action="{{ route('mawa.biodata.store', Auth::user()->id) }}" method="post">
                            @csrf

                            <div class="col-12">
                                <h4>DATA MAHASISWA</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">Name</label>
                                        <input required type="text" name="name" value="{{ Auth::user()->name }}"
                                            class="form-control" disabled>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">Email</label>
                                        <input required type="text" name="email" value="{{ Auth::user()->email }}"
                                            class="form-control" disabled>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NIM</label>
                                        @if (empty(Auth::user()->alamat->user_id))
                                            <input required type="text" name="nim" placeholder="masukan NIM..."
                                                class="form-control">
                                        @else
                                            <input required type="text" name="nim"
                                                value="{{ Auth::user()->alamat->nim }}" placeholder="masukan NIM..."
                                                class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">STATUS ALAMAT</label>
                                        <select name="alamat_status" id="" class="form-control">
                                            @if (empty(Auth::user()->alamat->user_id))
                                                <option value="KONTAKAN">PILIH OPSI</option>
                                            @else
                                                <option value="{{ Auth::user()->alamat->alamat_status }}">
                                                    {{ Auth::user()->alamat->alamat_status }}</option>
                                            @endif
                                            <option value="KONTRAKAN">KONRTAKAN</option>
                                            <option value="RUMAH">RUMAH</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">ALAMAT TINGGAL</label>
                                        <textarea name="alamat_tinggal" class="form-control" id="" rows="5">
                                        @if (empty(Auth::user()->alamat->user_id))
@else
{{ Auth::user()->alamat->alamat_tinggal }}
@endif
                                        </textarea>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">JENIS SEKOLAH ATAS</label>
                                        <select name="jenis_sekolah_atas" id="" class="form-control">
                                            @if (empty(Auth::user()->sekolah->user_id))
                                                <option value="">-- PILIH OPSI ---</option>
                                            @else
                                                <option value="{{ Auth::user()->sekolah->jenis_sekolah_atas }}">
                                                    {{ Auth::user()->sekolah->jenis_sekolah_atas }}</option>
                                            @endif
                                            <option value="SMK">SMK</option>
                                            <option value="PESANTREN">PESANTREN</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NAMA SEKOLAH ATAS</label>
                                        @if (empty(Auth::user()->sekolah->user_id))
                                            <input required type="text" name="nama_sekolah_atas"
                                                placeholder="masukan NAMA SEKOLAH ATAS..." class="form-control">
                                        @else
                                            <input required type="text" name="nama_sekolah_atas"
                                                value="{{ Auth::user()->sekolah->nama_sekolah_atas }}"
                                                placeholder="masukan NAMA SEKOLAH ATAS..." class="form-control">
                                        @endif

                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NAMA SMP</label>
                                        @if (empty(Auth::user()->sekolah->user_id))
                                            <input required type="text" name="nama_smp" placeholder="masukan NAMA SMP..."
                                                class="form-control">
                                        @else
                                            <input required type="text" name="nama_smp"
                                                value="{{ Auth::user()->sekolah->nama_smp }}"
                                                placeholder="masukan NAMA SMP..." class="form-control">
                                        @endif

                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NAMA SD</label>
                                        @if (empty(Auth::user()->sekolah->user_id))
                                            <input required type="text" name="nama_sd" placeholder="masukan NAMA SD..."
                                                class="form-control">
                                        @else
                                            <input required type="text" name="nama_sd"
                                                value="{{ Auth::user()->sekolah->nama_sd }}"
                                                placeholder="masukan NAMA SD..." class="form-control">
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
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
                                            <input required type="text" name="ayah_nama"
                                                placeholder="masukan NAMA ayah.." class="form-control">
                                        @else
                                            <input required type="text" name="ayah_nama"
                                                value="{{ Auth::user()->dataKeluarga->ayah_nama }}"
                                                placeholder="masukan NAMA SD..." class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NO TELEPON (ayah)</label>
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
                                            <input required type="text" name="ayah_telepon"
                                                placeholder="masukan NAMA ayah.." class="form-control">
                                        @else
                                            <input required type="text" name="ayah_telepon"
                                                value="{{ Auth::user()->dataKeluarga->ayah_telepon }}"
                                                placeholder="masukan NAMA SD..." class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">PENDIDIKAN TERAKHIR</label>
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
                                            <input required type="text" name="ayah_pendidikan_terakhir"
                                                placeholder="masukan PENDIDIKAN TERAKHIR.." class="form-control">
                                        @else
                                            <input required type="text" name="ayah_pendidikan_terakhir"
                                                value="{{ Auth::user()->dataKeluarga->ayah_pendidikan_terakhir }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">PEKERJAAN</label>
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
                                            <input required type="text" name="ayah_pekerjaan"
                                                placeholder="masukan PEKERJAAN.." class="form-control">
                                        @else
                                            <input required type="text" name="ayah_pekerjaan"
                                                value="{{ Auth::user()->dataKeluarga->ayah_pendidikan_terakhir }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">PENDAPATAN</label>
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
                                            <input required type="number" name="ayah_gaji" placeholder="masukan .."
                                                class="form-control">
                                        @else
                                            <input required type="number" name="ayah_gaji"
                                                value="{{ Auth::user()->dataKeluarga->ayah_gaji }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">ALAMAT TINGGAL</label>
                                        <textarea name="ayah_alamat" class="form-control" id="" rows="5">
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
@else
{{ Auth::user()->dataKeluarga->ayah_alamat }}
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
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
                                            <input required type="text" name="ibu_nama"
                                                placeholder="masukan NAMA ibu.." class="form-control">
                                        @else
                                            <input required type="text" name="ibu_nama"
                                                value="{{ Auth::user()->dataKeluarga->ibu_nama }}"
                                                placeholder="masukan NAMA SD..." class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">NO TELEPON (ibu)</label>
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
                                            <input required type="text" name="ibu_telepon"
                                                placeholder="masukan NAMA ibu.." class="form-control">
                                        @else
                                            <input required type="text" name="ibu_telepon"
                                                value="{{ Auth::user()->dataKeluarga->ibu_telepon }}"
                                                placeholder="masukan NAMA SD..." class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">PENDIDIKAN TERAKHIR</label>
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
                                            <input required type="text" name="ibu_pendidikan_terakhir"
                                                placeholder="masukan PENDIDIKAN TERAKHIR.." class="form-control">
                                        @else
                                            <input required type="text" name="ibu_pendidikan_terakhir"
                                                value="{{ Auth::user()->dataKeluarga->ibu_pendidikan_terakhir }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">PEKERJAAN</label>
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
                                            <input required type="text" name="ibu_pekerjaan"
                                                placeholder="masukan PEKERJAAN.." class="form-control">
                                        @else
                                            <input required type="text" name="ibu_pekerjaan"
                                                value="{{ Auth::user()->dataKeluarga->ibu_pendidikan_terakhir }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">PENDAPATAN</label>
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
                                            <input required type="number" name="ibu_gaji" placeholder="masukan .."
                                                class="form-control">
                                        @else
                                            <input required type="number" name="ibu_gaji"
                                                value="{{ Auth::user()->dataKeluarga->ibu_gaji }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">ALAMAT TINGGAL</label>
                                        <textarea name="ibu_alamat" class="form-control" id="" rows="5">
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
@else
{{ Auth::user()->dataKeluarga->ibu_alamat }}
@endif
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">JUMLAH KAKAK</label>
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
                                            <input required type="number" name="kakak_jumlah" placeholder="masukan .."
                                                class="form-control">
                                        @else
                                            <input required type="number" name="kakak_jumlah"
                                                value="{{ Auth::user()->dataKeluarga->kakak_jumlah }}"
                                                class="form-control">
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-sm-6 form-group">
                                        <label for="">JUMLAH ADIK</label>
                                        @if (empty(Auth::user()->dataKeluarga->user_id))
                                            <input required type="number" name="adik_jumlah" placeholder="masukan .."
                                                class="form-control">
                                        @else
                                            <input required type="number" name="adik_jumlah"
                                                value="{{ Auth::user()->dataKeluarga->adik_jumlah }}"
                                                class="form-control">
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
