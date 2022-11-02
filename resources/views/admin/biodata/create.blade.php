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
                                                            <option value="">==Pilih user==</option>
                                                            @foreach ($mahasiswa as $index => $row)
                                                            <option value="{{$row->id}}">{{$row->name}} - {{$row->email}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="nama" placeholder="Nama lengkap"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="email" placeholder="Email"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NIM</label>
                                                        <input type="text" class="form-control" name="nim" placeholder="NIM"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <input class="form-check-input" type="radio" name="jk" value="L">
                                                                <label class="form-check-label" >
                                                                Laki-Laki
                                                                </label>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input class="form-check-input" type="radio" name="jk" value="P">
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
                                                        <input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir"/>
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
                                                        <textarea class="form-control" placeholder="Alamat" name="alamat"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendidikan Terakhir</label>
                                                        <input type="text" class="form-control" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kelas</label>
                                                        <input type="text" class="form-control" name="kelas" placeholder="Kelas"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tahun Masuk</label>
                                                        <input type="number" class="form-control" name="tahun_masuk" placeholder="Tahun Masuk"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="row mt-5">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Nama Ayah</label>
                                                        <input type="text" class="form-control" name="ayah_nama" placeholder="Nama Ayah"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No.Telepon</label>
                                                        <input type="text" class="form-control" name="ayah_telepon" placeholder="No.Telepon"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendidikan Terakhir</label>
                                                        <select class="form-control select-pendidikan-ayah" name="ayah_pendidikan_id">
                                                            <option value="">==Pilih Pendidikan==</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pekerjaan</label>
                                                        <input type="text" class="form-control" name="ayah_pekerjaan" placeholder="Pekerjaan"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendapatan</label>
                                                        <input type="number" class="form-control" name="ayah_gaji" placeholder="Pendapatan"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat Tinggal</label>
                                                        <textarea class="form-control" placeholder="Alamat" name="ayah_alamat"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jumlah Kakak</label>
                                                        <input type="number" class="form-control" name="kakak_jumlah" placeholder="Jumlah Kakak"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jumlah Adik</label>
                                                        <input type="number" class="form-control" name="adik_jumlah" placeholder="Jumlah Adik"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Nama Ibu</label>
                                                        <input type="text" class="form-control" name="ibu_nama" placeholder="Nama Ibu"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No.Telepon</label>
                                                        <input type="text" class="form-control" name="ibu_telepon" placeholder="No.Telepon"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendidikan Terakhir</label>
                                                        <select class="form-control select-pendidikan-ibu" name="ibu_pendidikan_id">
                                                            <option value="">==Pilih Pendidikan==</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pekerjaan</label>
                                                        <input type="text" class="form-control" name="ibu_pekerjaan" placeholder="Pekerjaan"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pendapatan</label>
                                                        <input type="number" class="form-control" name="ibu_gaji" placeholder="Pendapatan"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat Tinggal</label>
                                                        <textarea class="form-control" placeholder="Alamat" name="ibu_alamat"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    @if(empty($result) || (isset($result->status_verifikasi) &&$result->status_verifikasi == \App\Models\Alumni::STATUS_VERIFIKASI_NO))
                                    <button class="btn btn-primary" type="submit" disabled>Submit</button>
                                    <button class="btn btn-warning btn-reset" type="button" style="margin-left: 10px;">Reset</button>
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

            $('#example').DataTable();

            agama('.select-agama',null,false);
            province('.select-province',null,false);
            province('.select-province-lahir',null,false);
            pendidikan('.select-pendidikan-ayah',null,false);
            pendidikan('.select-pendidikan-ibu',null,false);

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
                if(confirm("Apakah anda yakin ingin menyimpan data ini ? ")){
                    $.ajax({
                        url : '{{route('admin.biodata.store')}}',
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
