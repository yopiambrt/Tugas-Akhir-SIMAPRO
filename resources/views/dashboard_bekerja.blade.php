@extends('layouts.app')
@section('title')
    Mahasiswa
@endsection

@section('content')
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>DASHBOARD</h4>
                        <h6>Welcome to dashboard Admin</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($data as $index => $row)
                            <div class="col-sm-6 col-xl-4 col-lg-6">
                                <div class="card o-hidden border-0">
                                  <div class="bg-primary b-r-4 card-body btn-klik-bekerja">
                                    <div class="media static-top-widget">
                                      <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                                      <div class="media-body"><span class="m-0">Total Bekerja Di {{$row["perusahaan"]}}</span>
                                        <h4 class="mb-0 counter">{{$row["total_alumni"]}}</h4><i class="icon-bg" data-feather="database"></i>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <a href="{{route("dashboard")}}" class="btn btn-warning">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
        });
    </script>
@endsection
