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
                    <form id="frmStore" method="post" action="#" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{$result->id}}"/>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <h5>Pendataan Alumni</h5>
                                    <h6>STUDI LANJUT</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>User</label>
                                        <select class="form-control" name="user_id">
                                            <option value="">==Pilih user mahasiswa==</option>
                                            @foreach ($mahasiswa as $index => $row)
                                            <option value="{{$row->id}}" @if($result->user_id == $row->id) selected @endif>{{$row->biodata->nama}} - {{$row->biodata->nim}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{$result->nama ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="tanggal_mulai" placeholder="Tanggal Mulai" value="{{$result->tanggal_mulai ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Universitas</label>
                                        <input type="text" class="form-control" name="nama_universitas" placeholder="Nama Universitas" value="{{$result->nama_universitas ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenjang</label>
                                        <select class="form-control select-univ-jenjang" name="univ_jenjang_id">
                                            <option value="">==Pilih Jenjang==</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori Universitas</label>
                                        <select class="form-control select-univ-kategori" name="univ_kategori_id">
                                            <option value="">==Pilih Kategori Universitas==</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Level</label>
                                        <select class="form-control select-univ-level" name="univ_level_id">
                                            <option value="">==Pilih Level Universitas==</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Program Studi</label>
                                        <input type="text" class="form-control" name="program_studi" placeholder="Program Studi" value="{{$result->program_studi ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Fakultas</label>
                                        <input type="text" class="form-control" name="fakultas" placeholder="Fakultas" value="{{$result->fakultas ?? null}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{url()->previous()}}" class="btn btn-warning btn-sm" style="margin-left: 10px;">Kembali</a>
                                </div>
                            </div>
                        </div>
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

            $("button[type='submit']").attr("disabled",false);

            universitas_jenjang('.select-univ-jenjang',null,false);
            universitas_level('.select-univ-level',null,false);
            universitas_kategori('.select-univ-kategori',null,false);

            @if($result && !empty($result->univ_jenjang_id))
                universitas_jenjang('.select-univ-jenjang','{{$result->univ_jenjang_id}}',true);
            @endif

            @if($result && !empty($result->univ_level_id))
                universitas_level('.select-univ-level','{{$result->univ_level_id}}',true);
            @endif

            @if($result && !empty($result->univ_kategori_id))
                universitas_kategori('.select-univ-kategori','{{$result->univ_kategori_id}}',true);
            @endif

            $(document).on("click",".btn-reset",function(){
                $("#frmStore")[0].reset();
            });
        });
    </script>
@endsection
