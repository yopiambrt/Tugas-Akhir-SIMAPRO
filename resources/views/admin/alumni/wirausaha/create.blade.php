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
                                        <label>User Mahasiswa</label>
                                        <select class="form-control" name="user_id">
                                            <option value="">==Pilih mahasiswa==</option>
                                            @foreach ($mahasiswa as $index => $row)
                                            <option value="{{$row->id}}">{{$row->biodata->nama}} - {{$row->biodata->nim}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pemilik</label>
                                        <input type="text" class="form-control" name="nama_pemilik" placeholder="Nama Pemilik"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="tanggal_mulai" placeholder="Tanggal Mulai"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Usaha</label>
                                        <input type="text" class="form-control" name="nama_usaha" placeholder="Nama Usaha"/>
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
                                        <input type="number" class="form-control" name="penghasilan" placeholder="Penghasilan"/>
                                    </div>
                                    <div class="form-group">
                                        <label>UMR Kota/Kabupaten</label>
                                        <input type="number" class="form-control" name="umr" placeholder="UMR Kota/Kabupaten"/>
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
                                            <option value="1">Membuka Usaha</option>
                                            <option value="2">Pekerja Lepas</option>
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
                                            <option value="1">Individu</option>
                                            <option value="2">Berpasangan</option>
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
            jenis_usaha('.select-jenis-usaha',null,false);
            level_usaha('.select-level-usaha',null,false);
            kriteria_usaha('.select-kriteria-usaha',null,false);
            kriteria_pekerja_lepas('.select-kriteria-pekerja-lepas',null,false);

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
                        url : '{{route('admin.alumni.wirausaha.store')}}',
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
                                    '{{route('admin.alumni.wirausaha.index')}}'
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
