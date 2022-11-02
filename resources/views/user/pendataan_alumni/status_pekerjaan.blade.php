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
                            <div class="row mb-5">
                                <div class="col-12">
                                    <h5>Pendataan Alumni</h5>
                                    <p>Silahkan mengisi data berikut untuk pendataan alumni</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Setelah lulus</label>
                                        <select class="form-control select-status-pekerjaan" name="status_pekerjaan_id">
                                            <option value="">==Pilih pekerjaan setelah anda lulus==</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-primary btn-sm" type="submit" disabled>Submit</button>
                                    @if($result && $result->status_pekerjaan_id && $result->status_pekerjaan_id != \App\Models\Master\StatusPekerjaan::BELUM_BEKERJA)
                                    <a href="{{route("mhs.pendataan_alumni.setelah_lulus.pilihan")}}" class="btn btn-warning btn-sm" style="margin-left: 10px;">Next</a>
                                    @endif
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

            status_pekerjaan('.select-status-pekerjaan',null,false);

            @if($result && !empty($result->status_pekerjaan_id))
                status_pekerjaan('.select-status-pekerjaan','{{$result->status_pekerjaan_id}}',true);
            @endif

            $(document).on("submit","#frmStore",function(e){
                e.preventDefault();
                if(confirm("Apakah anda yakin ingin menyimpan data ini ? ")){
                    $.ajax({
                        url : '{{route('mhs.pendataan_alumni.setelah_lulus.store')}}',
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
                                    '{{route('mhs.pendataan_alumni.setelah_lulus.create')}}'
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
