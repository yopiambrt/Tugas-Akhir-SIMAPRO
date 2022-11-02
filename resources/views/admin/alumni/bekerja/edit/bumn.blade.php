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
                                    <h6 style="text-transform: uppercase">BEKERJA DI {{$result->jenis_perusahaan->nama ?? null}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
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
                                        <label>Nama Instasi</label>
                                        <input type="text" class="form-control" name="nama_instansi" placeholder="Nama Instasi" value="{{$result->nama_instansi ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Provinsi Instansi</label>
                                        <select class="form-control select-province">
                                            <option value="">==Pilih Provinsi==</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kota/Kabupaten Instansi</label>
                                        <select class="form-control select-city" name="city_id">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Gaji Pertama</label>
                                        <input type="number" class="form-control" name="gaji_pertama" placeholder="Gaji Pertama" value="{{$result->gaji_pertama ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>UMR Kota/Kabupaten</label>
                                        <input type="number" class="form-control" name="umr" placeholder="UMR Kota/Kabupaten" value="{{$result->umr ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Email / Kontak Instansi</label>
                                        <input type="text" class="form-control" name="contact" placeholder="Email / Kontak Instansi" value="{{$result->contact ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Pekerjaan</label>
                                        <input type="text" class="form-control" name="jenis_pekerjaan" placeholder="Jenis Pekerjaan" value="{{$result->jenis_pekerjaan ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" value="{{$result->jabatan ?? null}}"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kategori Pekerjaan</label>
                                        <select class="form-control select-kategori-pekerjaan" name="kategori_pekerjaan_id">
                                            <option value="">==Pilih kategori pekerjaan==</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Level Instansi</label>
                                        <select class="form-control select-level-instansi" name="level_instansi_id">
                                            <option value="">==Pilih level instansi==</option>
                                        </select>
                                    </div>
                                    <div class="form-group text-center">
                                        <label>Memiliki Perjanjian Kerja Waktu Tertentu (PKWT) ? </label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input class="form-check-input" type="radio" name="pkwt" value="1" @if($result && $result->pkwt == \App\Models\Alumni\AlumniBekerja::PKWT_YES) checked @endif>
                                                <label class="form-check-label" >
                                                Ya
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-check-input" type="radio" name="pkwt" value="0" @if($result && $result->pkwt == \App\Models\Alumni\AlumniBekerja::PKWT_NO) checked @endif>
                                                <label class="form-check-label" >
                                                Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <label>Memiliki Perjanjian Kerja Waktu TidakTertentu (PKWTT) ? </label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input class="form-check-input" type="radio" name="pkwtt" value="1" @if($result && $result->pkwtt == \App\Models\Alumni\AlumniBekerja::PKWTT_YES) checked @endif>
                                                <label class="form-check-label" >
                                                Ya
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-check-input" type="radio" name="pkwtt" value="0" @if($result && $result->pkwtt == \App\Models\Alumni\AlumniBekerja::PKWTT_NO) checked @endif>
                                                <label class="form-check-label" >
                                                Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit" disabled>Submit</button>
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

            province('.select-province',null,false);
            kategori_pekerjaan('.select-kategori-pekerjaan',null,false);
            level_instansi('.select-level-instansi',null,false);

            @if($result && !empty($result->kategori_pekerjaan_id))
                kategori_pekerjaan('.select-kategori-pekerjaan','{{$result->kategori_pekerjaan_id}}',true);
            @endif

            @if($result && !empty($result->level_instansi_id))
                level_instansi('.select-level-instansi','{{$result->level_instansi_id}}',true);
            @endif

            @if($result && !empty($result->city_id))
                province('.select-province','{{$result->city->prov_id ?? null}}',true);
                city(".select-city",'{{$result->city->prov_id ?? null}}','{{$result->city_id ?? null}}',true);
            @endif

            $(document).on("change",".select-province",function(){
                let val = $(this).val();
                $(".select-city").html("");
                $(".select-city").append('<option value="">==Pilih kota/kabupaten</option>');

                if(val != ""){
                    city(".select-city",val,null);
                }
            })

            $(document).on("click",".btn-reset",function(){
                $("#frmStore")[0].reset();
            });

            $(document).on("submit","#frmStore",function(e){
                e.preventDefault();
                if(confirm("Apakah anda yakin ingin menyimpan data ini ? ")){
                    $.ajax({
                        url : '{{route('admin.alumni.bekerja.store_bumn')}}',
                        method : "POST",
                        data : new FormData($('#frmStore')[0]),
                        contentType : false,
                        cache : false,
                        processData : false,
                        dataType : "JSON",
                        beforeSend : function(){
                            $('#loader').removeClass('show');
                            $('#loader').removeClass('background-grey');
                            $('#loader').addClass('show');
                            $('#loader').addClass('background-grey');
                            $('#loader').css('display','block');
                        },
                        success : function(resp){
                            if(resp.IsError == true){
                                swal_error(
                                    resp.Message,
                                );
                            }
                            else{
                                swal_success(
                                    resp.Message,
                                    '{{route('admin.alumni.bekerja.index')}}'
                                );
                            }
                        },
                        error : function(){
                            return internalServerError();
                        },
                        complete : function(){
                            $('#loader').removeClass('show');
                            $('#loader').removeClass('background-grey');
                            $('#loader').css('display','none');
                        }
                    })
                }
                else{
                    return false;
                }
            });
        });
    </script>
@endsection
