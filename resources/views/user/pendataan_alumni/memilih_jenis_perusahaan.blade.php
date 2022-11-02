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
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h5>Pendataan Alumni</h5>
                                    <p>Silahkan mengisi data berikut untuk pendataan alumni</p>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($jenis_perusahaan as $index => $row)
                                <div class="col-lg-3" style="cursor: pointer">
                                    <div class="card pilih-perusahaan" style="min-height: 120px;background-color  :	#DCDCDC	" data-id="{{$row->id}}">
                                        <div class="card-body text-center" style="height: 100%;">
                                            <p class="d-flex align-items-center justify-content-center"><b>{{$row->nama}}</b></p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit" disabled>Submit</button>
                                    <button class="btn btn-warning btn-reset" type="button" style="margin-left: 10px;">Reset</button>
                                    <a href="{{url()->previous()}}" class="btn btn-warning" style="margin-left: 10px;">Kembali</a>
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

            $(document).on("click",".pilih-perusahaan",function(){
                let id = $(this).attr("data-id");

                location.href = '{{route("mhs.pendataan_alumni.bekerja.create")}}' + '?perusahaan_id=' + id;
            });
        });
    </script>
@endsection
