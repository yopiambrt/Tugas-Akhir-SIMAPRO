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
                                    <h6>MEMBUKA USAHA</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama Pemilik</label>
                                        <input type="text" class="form-control" name="nama_pemilik" placeholder="Nama Pemilik" value="{{$result->alumni_wirausaha->nama_pemilik ?? Auth::user()->name}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="tanggal_mulai" placeholder="Tanggal Mulai" value="{{$result->alumni_wirausaha->tanggal_mulai ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Usaha</label>
                                        <input type="text" class="form-control" name="nama_usaha" placeholder="Nama Usaha" value="{{$result->alumni_wirausaha->nama_usaha ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Provinsi Tempat Usaha</label>
                                        <select class="form-control select-province">
                                            <option value="">==Pilih Provinsi==</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kota/Kabupaten Tempat Usaha</label>
                                        <select class="form-control select-city" name="city_id">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Penghasilan</label>
                                        <input type="number" class="form-control" name="penghasilan" placeholder="Penghasilan" value="{{$result->alumni_wirausaha->penghasilan ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>UMR Kota/Kabupaten</label>
                                        <input type="number" class="form-control" name="umr" placeholder="UMR Kota/Kabupaten" value="{{$result->alumni_wirausaha->umr ?? null}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Usaha</label>
                                        <select class="form-control select-jenis-usaha" name="jenis_usaha_id">
                                            <option value="">==Pilih jenis usaha==</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Membuka Usaha / Pekerja Lepas</label>
                                        <select class="form-control select-tipe" name="tipe">
                                            <option value="">==Pilih membuka usaha / pekerja lepas==</option>
                                            <option value="1" @if($result->alumni_wirausaha && $result->alumni_wirausaha->tipe == \App\Models\Alumni\AlumniWirausaha::TIPE_MEMBUKA_USAHA) selected @endif>Membuka Usaha</option>
                                            <option value="2" @if($result->alumni_wirausaha && $result->alumni_wirausaha->tipe == \App\Models\Alumni\AlumniWirausaha::TIPE_PEKERJA_LEPAS) selected @endif>Pekerja Lepas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Level Usaha</label>
                                        <select class="form-control select-level-usaha" name="level_usaha_id">
                                            <option value="">==Pilih level usaha==</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Dijalankan oleh</label>
                                        <select class="form-control" name="dijalankan_oleh">
                                            <option value="">==Pilih dijalankan oleh==</option>
                                            <option value="1" @if($result->alumni_wirausaha && $result->alumni_wirausaha->dijalankan_oleh == \App\Models\Alumni\AlumniWirausaha::DIJALANKAN_INDIVIDU) selected @endif>Individu</option>
                                            <option value="2" @if($result->alumni_wirausaha && $result->alumni_wirausaha->dijalankan_oleh == \App\Models\Alumni\AlumniWirausaha::DIJALANKAN_BERPASANGAN) selected @endif>Berpasangan</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="display: none">
                                        <label>Kriteria Usaha</label>
                                        <select class="form-control select-kriteria-usaha" name="kriteria_usaha_id">
                                            <option value="">==Pilih kriteria usaha==</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="display: none">
                                        <label>Kriteria Pekerja Lepas</label>
                                        <select class="form-control select-kriteria-pekerja-lepas" name="kriteria_pekerja_lepas_id">
                                            <option value="">==Pilih kriteria pekerja lepas==</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    @if(!$result->alumni_wirausaha)
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

            province('.select-province',null,false);
            jenis_usaha('.select-jenis-usaha',null,false);
            level_usaha('.select-level-usaha',null,false);
            kriteria_usaha('.select-kriteria-usaha',null,false);
            kriteria_pekerja_lepas('.select-kriteria-pekerja-lepas',null,false);

            @if($result && !empty($result->alumni_wirausaha->jenis_usaha_id))
                jenis_usaha('.select-jenis-usaha','{{$result->alumni_wirausaha->jenis_usaha_id}}',true);
            @endif

            @if($result && !empty($result->alumni_wirausaha->level_usaha_id))
                level_usaha('.select-level-usaha','{{$result->alumni_wirausaha->level_usaha_id}}',true);
            @endif

            @if($result && !empty($result->alumni_wirausaha->kriteria_usaha_id))
                kriteria_usaha('.select-kriteria-usaha','{{$result->alumni_wirausaha->kriteria_usaha_id}}',true);

                $(".select-kriteria-usaha").parent().css("display","block");
            @endif

            @if($result && !empty($result->alumni_wirausaha->kriteria_pekerja_lepas_id))
                kriteria_pekerja_lepas('.select-kriteria-pekerja-lepas','{{$result->alumni_wirausaha->kriteria_pekerja_lepas}}',true);

                $(".select-kriteria-pekerja-lepas").parent().css("display","block");
            @endif

            @if($result && !empty($result->alumni_wirausaha->city_id))
                province('.select-province','{{$result->alumni_wirausaha->city_address->prov_id ?? null}}',true);
                city(".select-city",'{{$result->alumni_wirausaha->city_address->prov_id ?? null}}','{{$result->alumni_wirausaha->city_id ?? null}}',true);
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

            $(document).on("change",".select-tipe",function(){
                let val = $(this).val();

                if(val == ""){

                    $(".select-kriteria-usaha").parent().css("display","none");
                    $(".select-kriteria-pekerja-lepas").parent().css("display","none");
                }
                else{
                    if(val == "1"){
                        $(".select-kriteria-pekerja-lepas").parent().css("display","none");
                        $(".select-kriteria-usaha").parent().css("display","block");
                    }
                    else if(val == "2"){
                        $(".select-kriteria-usaha").parent().css("display","none");
                        $(".select-kriteria-pekerja-lepas").parent().css("display","block");
                    }
                }
            });

            $(document).on("submit","#frmStore",function(e){
                e.preventDefault();
                if(confirm("Apakah anda yakin ingin menyimpan data ini ? ")){
                    $.ajax({
                        url : '{{route('mhs.pendataan_alumni.membuka_usaha.store')}}',
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
                                    '{{route('mhs.pendataan_alumni.membuka_usaha.create')}}'
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
