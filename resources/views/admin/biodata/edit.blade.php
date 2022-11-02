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

                    </div>
                    <form id="frmStore" method="post" action="#" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{$result->id}}"/>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Data Mahasiswa</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Data Keluarga</button>
                                        </li>
                                    </ul>
                                    
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row mt-5">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>User</label>
                                                        <select class="form-control" name="user_id">
                                                            <option value="">==Pilih user mahasiswa==</option>
                                                            @foreach ($mahasiswa as $index => $row)
                                                            <option value="{{$row->id}}" @if($result->user_id == $row->id) selected @endif>{{$row->name}} - {{$row->email}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="nama" placeholder="Nama lengkap" value="{{$result->nama ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{$result->email ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NIM</label>
                                                        <input type="text" class="form-control" name="nim" placeholder="NIM" value="{{$result->nim ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <input class="form-check-input" type="radio" name="jk" value="L" @if($result && $result->jk == \App\Models\MhsBiodata::JK_PRIA) checked @endif>
                                                                <label class="form-check-label" >
                                                                Laki-Laki
                                                                </label>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input class="form-check-input" type="radio" name="jk" value="P" @if($result && $result->jk == \App\Models\MhsBiodata::JK_PEREMPUAN) checked @endif>
                                                                <label class="form-check-label" >
                                                                Perempuan
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Agama</label>
                                                        <select class="form-control select-agama" name="agama_id">
                                                            <option value="">==Pilih Agama==</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Provinsi Lahir</label>
                                                        <select class="form-control select-province-lahir">
                                                            <option value="">==Pilih Provinsi==</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kota/Kabupaten Lahir</label>
                                                        <select class="form-control select-city-lahir" name="tempat_lahir">
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir</label>
                                                        <input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{$result->tanggal_lahir ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Provinsi Tinggal</label>
                                                        <select class="form-control select-province">
                                                            <option value="">==Pilih Provinsi==</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kota/Kabupaten Tinggal</label>
                                                        <select class="form-control select-city" name="city_id">
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat Tinggal</label>
                                                        <textarea class="form-control" placeholder="Alamat" name="alamat">{{$result->alamat ?? null}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendidikan Terakhir</label>
                                                        <input type="text" class="form-control" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir" value="{{$result->pendidikan_terakhir ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kelas</label>
                                                        <input type="text" class="form-control" name="kelas" placeholder="Kelas" value="{{$result->kelas ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tahun Masuk</label>
                                                        <input type="number" class="form-control" name="tahun_masuk" placeholder="Tahun Masuk" value="{{$result->tahun_masuk ?? null}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="row mt-5">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Nama Ayah</label>
                                                        <input type="text" class="form-control" name="ayah_nama" placeholder="Nama Ayah" value="{{$result->keluarga->ayah_nama ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No.Telepon</label>
                                                        <input type="text" class="form-control" name="ayah_telepon" placeholder="No.Telepon" value="{{$result->keluarga->ayah_telepon ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendidikan Terakhir</label>
                                                        <select class="form-control select-pendidikan-ayah" name="ayah_pendidikan_id">
                                                            <option value="">==Pilih Pendidikan==</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pekerjaan</label>
                                                        <input type="text" class="form-control" name="ayah_pekerjaan" placeholder="Pekerjaan" value="{{$result->keluarga->ayah_pekerjaan ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendapatan</label>
                                                        <input type="number" class="form-control" name="ayah_gaji" placeholder="Pendapatan" value="{{$result->keluarga->ayah_gaji ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat Tinggal</label>
                                                        <textarea class="form-control" placeholder="Alamat" name="ayah_alamat">{{$result->keluarga->ayah_alamat ?? null}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jumlah Kakak</label>
                                                        <input type="number" class="form-control" name="kakak_jumlah" placeholder="Jumlah Kakak" value="{{$result->keluarga->kakak_jumlah ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jumlah Adik</label>
                                                        <input type="number" class="form-control" name="adik_jumlah" placeholder="Jumlah Adik" value="{{$result->keluarga->adik_jumlah ?? null}}"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Nama Ibu</label>
                                                        <input type="text" class="form-control" name="ibu_nama" placeholder="Nama Ibu" value="{{$result->keluarga->ibu_nama ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No.Telepon</label>
                                                        <input type="text" class="form-control" name="ibu_telepon" placeholder="No.Telepon" value="{{$result->keluarga->ibu_telepon ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendidikan Terakhir</label>
                                                        <select class="form-control select-pendidikan-ibu" name="ibu_pendidikan_id">
                                                            <option value="">==Pilih Pendidikan==</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pekerjaan</label>
                                                        <input type="text" class="form-control" name="ibu_pekerjaan" placeholder="Pekerjaan" value="{{$result->keluarga->ibu_pekerjaan ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendapatan</label>
                                                        <input type="number" class="form-control" name="ibu_gaji" placeholder="Pendapatan" value="{{$result->keluarga->ibu_gaji ?? null}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat Tinggal</label>
                                                        <textarea class="form-control" placeholder="Alamat" name="ibu_alamat">{{$result->keluarga->ibu_alamat ?? null}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit" disabled>Submit</button>
                                    <button class="btn btn-warning btn-reset" type="button" style="margin-left: 10px;">Reset</button>
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

            $('#example').DataTable();

            agama('.select-agama',null,false);
            province('.select-province',null,false);
            province('.select-province-lahir',null,false);
            pendidikan('.select-pendidikan-ayah',null,false);
            pendidikan('.select-pendidikan-ibu',null,false);

            @if($result && !empty($result->agama_id))
                agama('.select-agama','{{$result->agama_id ?? null}}',true);
            @endif

            @if($result && !empty($result->tempat_lahir))
                province('.select-province-lahir','{{$result->city_birth->prov_id ?? null}}',true);
                city(".select-city-lahir",'{{$result->city_birth->prov_id ?? null}}','{{$result->tempat_lahir ?? null}}',true);
            @endif

            @if($result && !empty($result->city_id))
                province('.select-province','{{$result->city_address->prov_id ?? null}}',true);
                city(".select-city",'{{$result->city_address->prov_id ?? null}}','{{$result->city_id ?? null}}',true);
            @endif

            @if($result && !empty($result->keluarga->ayah_pendidikan_id))
                pendidikan('.select-pendidikan-ayah','{{$result->keluarga->ayah_pendidikan_id ?? null}}',true);
            @endif

            @if($result && !empty($result->keluarga->ibu_pendidikan_id))
                pendidikan('.select-pendidikan-ibu','{{$result->keluarga->ibu_pendidikan_id ?? null}}',true);
            @endif

            $(document).on("change",".select-province",function(){
                let val = $(this).val();
                $(".select-city").html("");
                $(".select-city").append('<option value="">==Pilih kota/kabupaten</option>');

                if(val != ""){
                    city(".select-city",val,null,false);
                }
            })

            $(document).on("change",".select-province-lahir",function(){
                let val = $(this).val();
                $(".select-city-lahir").html("");
                $(".select-city-lahir").append('<option value="">==Pilih kota/kabupaten</option>');

                if(val != ""){
                    city(".select-city-lahir",val,null,false);
                }
            })

            $(document).on("click",".btn-reset",function(){
                $("#frmStore")[0].reset();
            });

            $(document).on("submit","#frmStore",function(e){
                e.preventDefault();
                if(confirm("Apakah anda yakin ingin mengubah data ini ? ")){
                    $.ajax({
                        url : '{{route('admin.biodata.update')}}',
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
                                    '{{route('admin.biodata.index')}}'
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
