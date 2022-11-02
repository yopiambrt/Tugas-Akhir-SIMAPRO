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
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{$result->alumni_studi_lanjut->nama ?? Auth::user()->name}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="tanggal_mulai" placeholder="Tanggal Mulai" value="{{$result->alumni_studi_lanjut->tanggal_mulai ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Universitas</label>
                                        <input type="text" class="form-control" name="nama_universitas" placeholder="Nama Universitas" value="{{$result->alumni_studi_lanjut->nama_universitas ?? null}}"/>
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
                                        <input type="text" class="form-control" name="program_studi" placeholder="Program Studi" value="{{$result->alumni_studi_lanjut->program_studi ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Fakultas</label>
                                        <input type="text" class="form-control" name="fakultas" placeholder="Fakultas" value="{{$result->alumni_studi_lanjut->fakultas ?? null}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    @if(!$result->alumni_studi_lanjut)
                                    <button class="btn btn-primary btn-sm" type="submit" disabled>Submit</button>
                                    <button class="btn btn-warning btn-sm btn-reset" type="button" style="margin-left: 10px;">Reset</button>
                                    @endif
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

            @if($result && !empty($result->alumni_studi_lanjut->univ_jenjang_id))
                universitas_jenjang('.select-univ-jenjang','{{$result->alumni_studi_lanjut->univ_jenjang_id}}',true);
            @endif

            @if($result && !empty($result->alumni_studi_lanjut->univ_level_id))
                universitas_level('.select-univ-level','{{$result->alumni_studi_lanjut->univ_level_id}}',true);
            @endif

            @if($result && !empty($result->alumni_studi_lanjut->univ_kategori_id))
                universitas_kategori('.select-univ-kategori','{{$result->alumni_studi_lanjut->univ_kategori_id}}',true);
            @endif

            $(document).on("click",".btn-reset",function(){
                $("#frmStore")[0].reset();
            });

            $(document).on("submit","#frmStore",function(e){
                e.preventDefault();
                if(confirm("Apakah anda yakin ingin menyimpan data ini ? ")){
                    $.ajax({
                        url : '{{route('mhs.pendataan_alumni.studi_lanjut.store')}}',
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
                                    '{{route('mhs.pendataan_alumni.studi_lanjut.create')}}'
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
