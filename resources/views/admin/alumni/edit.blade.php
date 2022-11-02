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
                    <form id="frmUpdate" method="post" action="#" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{$result->id}}"/>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5>Edit Alumni</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Nama Mahasiswa</label>
                                        <select class="form-control" name="user_id">
                                            <option value="">==Pilih mahasiswa==</option>
                                            @foreach ($mahasiswa as $index => $row)
                                            <option value="{{$row->id}}" @if($result->user_id == $row->id) selected @endif>{{$row->biodata->nama}} - {{$row->biodata->nim}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                        <input type="date" class="form-control" name="tanggal_lulus" value="{{$result->tanggal_lulus}}"/>
                                        <p class="text-info"><small>Kosongi jika anda belum lulus</small></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Terbit Ijasah</label>
                                        <input type="date" class="form-control" name="tanggal_terbit_ijasah" value="{{$result->tanggal_terbit_ijasah}}"/>
                                        <p class="text-info"><small>Kosongi jika anda belum lulus</small></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Foto Ijasah</label>
                                        <input type="file" class="form-control" name="upload_foto_ijasah"/>
                                        <p class="text-info"><small>Kosongi jika tidak diubah dan kosongi jika belum lulus</small></p>
                                        @if(!empty($result->upload_foto_ijasah))
                                        <a href="{{asset($result->upload_foto_ijasah ?? null)}}" target="_blank" class="btn btn-info btn-sm">Lihat Foto Ijasah</a>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Setelah lulus</label>
                                        <select class="form-control select-status-pekerjaan" name="status_pekerjaan_id">
                                            <option value="">==Pilih pekerjaan setelah anda lulus==</option>
                                        </select>
                                        <p class="text-info"><small>Kosongi jika anda belum lulus</small></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Status Verifikasi</label>
                                        <select class="form-control" name="status_verifikasi">
                                            <option value="">==Pilih status verifikasi==</option>
                                            <option value="0" @if($result->status_verifikasi == \App\Models\Alumni::STATUS_VERIFIKASI_NO) selected @endif>Sedang Diajukan</option>
                                            <option value="1"  @if($result->status_verifikasi == \App\Models\Alumni::STATUS_VERIFIKASI_YES) selected @endif>Diverifikasi</option>
                                            <option value="2" @if($result->status_verifikasi == \App\Models\Alumni::STATUS_VERIFIKASI_TOLAK) selected @endif>Ditolak</option>
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

            status_pekerjaan('.select-status-pekerjaan',null,false);

            @if($result && !empty($result->status_pekerjaan_id))
                status_pekerjaan('.select-status-pekerjaan','{{$result->status_pekerjaan_id}}',true);
            @endif

            $(document).on("submit","#frmUpdate",function(e){
                e.preventDefault();
                if(confirm("Apakah anda yakin ingin megnubah data ini ? ")){
                    $.ajax({
                        url : '{{route('admin.alumni.update')}}',
                        method : "POST",
                        data : new FormData($('#frmUpdate')[0]),
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
                                    '{{route('admin.alumni.index')}}'
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
