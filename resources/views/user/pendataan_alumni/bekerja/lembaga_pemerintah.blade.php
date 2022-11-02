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
                        <input type="hidden" name="jenis_perusahaan_id" value="{{$perusahaan->id}}"/>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <h5>Pendataan Alumni</h5>
                                    <h6 style="text-transform: uppercase">BEKERJA DI {{$perusahaan->nama ?? null}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{$result->alumni_bekerja->nama ?? Auth::user()->name}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="tanggal_mulai" placeholder="Tanggal Mulai" value="{{$result->alumni_bekerja->tanggal_mulai ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Instasi</label>
                                        <input type="text" class="form-control" name="nama_instansi" placeholder="Nama Instasi" value="{{$result->alumni_bekerja->nama_instansi ?? null}}"/>
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
                                        <input type="number" class="form-control" name="gaji_pertama" placeholder="Gaji Pertama" value="{{$result->alumni_bekerja->gaji_pertama ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>UMR Kota/Kabupaten</label>
                                        <input type="number" class="form-control" name="umr" placeholder="UMR Kota/Kabupaten" value="{{$result->alumni_bekerja->umr ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Email / Kontak Instansi</label>
                                        <input type="text" class="form-control" name="contact" placeholder="Email / Kontak Instansi" value="{{$result->alumni_bekerja->contact ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Pekerjaan</label>
                                        <input type="text" class="form-control" name="jenis_pekerjaan" placeholder="Jenis Pekerjaan" value="{{$result->alumni_bekerja->jenis_pekerjaan ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" value="{{$result->alumni_bekerja->jabatan ?? null}}"/>
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
                                        <label>Terdaftar Pegawai Negeri Sipil (PNS) ? </label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input class="form-check-input" type="radio" name="pns" value="1" @if($result->alumni_bekerja && $result->alumni_bekerja->pns == \App\Models\Alumni\AlumniBekerja::PNS_YES) checked @endif>
                                                <label class="form-check-label" >
                                                Ya
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-check-input" type="radio" name="pns" value="0" @if($result->alumni_bekerja && $result->alumni_bekerja->pns == \App\Models\Alumni\AlumniBekerja::PNS_NO) checked @endif>
                                                <label class="form-check-label" >
                                                Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <label>Terdaftar Sebagai Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) ? </label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input class="form-check-input" type="radio" name="pppk" value="1" @if($result->alumni_bekerja && $result->alumni_bekerja->pppk == \App\Models\Alumni\AlumniBekerja::PPPK_YES) checked @endif>
                                                <label class="form-check-label" >
                                                Ya
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <input class="form-check-input" type="radio" name="pppk" value="0" @if($result->alumni_bekerja && $result->alumni_bekerja->pppk == \App\Models\Alumni\AlumniBekerja::PPPK_NO) checked @endif>
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
                                    <button class="btn btn-primary btn-sm" type="submit" disabled>Submit</button>
                                    <button class="btn btn-warning btn-sm btn-reset" type="button" style="margin-left: 10px;">Reset</button>
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

            province('.select-province',null,false);
            kategori_pekerjaan('.select-kategori-pekerjaan',null,false);
            level_instansi('.select-level-instansi',null,false);

            @if($result && !empty($result->alumni_bekerja->kategori_pekerjaan_id))
                kategori_pekerjaan('.select-kategori-pekerjaan','{{$result->alumni_bekerja->kategori_pekerjaan_id}}',true);
            @endif

            @if($result && !empty($result->alumni_bekerja->level_instansi_id))
                level_instansi('.select-level-instansi','{{$result->alumni_bekerja->level_instansi_id}}',true);
            @endif

            @if($result && !empty($result->alumni_bekerja->city_id))
                province('.select-province','{{$result->alumni_bekerja->city->prov_id ?? null}}',true);
                city(".select-city",'{{$result->alumni_bekerja->city->prov_id ?? null}}','{{$result->alumni_bekerja->city_id ?? null}}',true);
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
                        url : '{{route('mhs.pendataan_alumni.bekerja.store_lembaga_pemerintah')}}',
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
                                    '{{route('mhs.pendataan_alumni.bekerja.create')}}' + '?perusahaan_id=' + '{{$perusahaan->id}}' 
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
