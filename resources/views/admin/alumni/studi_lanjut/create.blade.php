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
                                        <label>User Mahasiswa</label>
                                        <select class="form-control" name="user_id">
                                            <option value="">==Pilih mahasiswa==</option>
                                            @foreach ($mahasiswa as $index => $row)
                                            <option value="{{$row->id}}">{{$row->biodata->nama}} - {{$row->biodata->nim}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" class="form-control" name="tanggal_mulai" placeholder="Tanggal Mulai"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Universitas</label>
                                        <input type="text" class="form-control" name="nama_universitas" placeholder="Nama Universitas"/>
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
                                        <input type="text" class="form-control" name="program_studi" placeholder="Program Studi"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Fakultas</label>
                                        <input type="text" class="form-control" name="fakultas" placeholder="Fakultas"/>
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

            universitas_jenjang('.select-univ-jenjang',null,false);
            universitas_level('.select-univ-level',null,false);
            universitas_kategori('.select-univ-kategori',null,false);

            $(document).on("click",".btn-reset",function(){
                $("#frmStore")[0].reset();
            });

            $(document).on("submit","#frmStore",function(e){
                e.preventDefault();
                if(confirm("Apakah anda yakin ingin menyimpan data ini ? ")){
                    $.ajax({
                        url : '{{route('admin.alumni.studi_lanjut.store')}}',
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
                                    '{{route('admin.alumni.studi_lanjut.index')}}'
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
