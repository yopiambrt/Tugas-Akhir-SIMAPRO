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
                            @if($pendataan_alumni == true)
                                @if($result)
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body bg-{{$result->status_verifikasi()->class ?? null }}">
                                                {{$result->status_verifikasi()->msg ?? null}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h5>Pendataan Alumni</h5>
                                        <p>Silahkan mengisi data berikut untuk pendataan alumni</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Status Kelulusan</label>
                                            <select class="form-control" name="status_kelulusan">
                                                <option value="">==Pilih status kelulusan==</option>
                                                <option value="1" @if($result && $result->status_kelulusan == \App\Models\Alumni::STATUS_KELULUSAN_YES) selected @endif>Lulus</option>
                                                <option value="0" @if($result && $result->status_kelulusan == \App\Models\Alumni::STATUS_KELULUSAN_NO) selected @endif>Belum Lulus</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lulus</label>
                                            <input type="date" class="form-control" name="tanggal_lulus" value="{{$result->tanggal_lulus ?? null}}"/>
                                            <p class="text-info"><small>Kosongi jika anda belum lulus</small></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Terbit Ijasah</label>
                                            <input type="date" class="form-control" name="tanggal_terbit_ijasah" value="{{$result->tanggal_terbit_ijasah ?? null}}"/>
                                            <p class="text-info"><small>Kosongi jika anda belum lulus</small></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto Ijasah</label>
                                            <input type="file" class="form-control" name="upload_foto_ijasah"/>
                                            <p class="text-info"><small>Kosongi jika anda belum lulus</small></p>
                                            @if(!empty($result->upload_foto_ijasah))
                                            <a href="{{asset($result->upload_foto_ijasah ?? null)}}" target="_blank" class="btn btn-info btn-sm">Lihat Foto Ijasah</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        @if(!$result)
                                        <button class="btn btn-primary" type="submit" disabled>Submit</button>
                                        <button class="btn btn-warning btn-reset" type="button" style="margin-left: 10px;">Reset</button>
                                        @endif
                                        @if($result && $result->status_verifikasi == \App\Models\Alumni::STATUS_VERIFIKASI_YES)
                                        <a href="{{route("mhs.pendataan_alumni.setelah_lulus.create")}}" class="btn btn-warning" style="margin-left: 10px;">Next</a>
                                        @endif
                                        <a href="{{url()->previous()}}" class="btn btn-warning btn-sm" style="margin-left: 10px;">Kembali</a>
                                    </div>
                                </div>
                            @else
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body bg-info">
                                            Halaman isi data alumni akan tampil setelah 3 tahun dari tahun masuk kuliah Anda
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
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

            $(document).on("click",".btn-reset",function(){
                $("#frmStore")[0].reset();
            });

            $(document).on("submit","#frmStore",function(e){
                e.preventDefault();
                if(confirm("Apakah anda yakin ingin menyimpan data ini ? ")){
                    $.ajax({
                        url : '{{route('mhs.pendataan_alumni.store')}}',
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
                                    '{{route('mhs.pendataan_alumni.create')}}'
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
