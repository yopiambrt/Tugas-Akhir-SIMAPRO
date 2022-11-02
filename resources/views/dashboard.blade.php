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
          <h5>DASHBOARD</h5>
          <h6>Welcome to dashboard {{ Auth::user()->name }}</h6>
        </div>
        <div class="card-body">
          <div class="row">
            @if(Auth::user()->is_admin != \App\Models\User::ROLE_MAHASISWA)
            <div class="col-sm-6 col-xl-4 col-lg-6">
              <div class="card o-hidden border-0">
                <div class="bg-primary b-r-4 card-body">
                  <div class="media static-top-widget">
                    <div class="align-self-center text-center"><i data-feather="database"></i></div>
                    <div class="media-body"><span class="m-0">Total User</span>
                      <h4 class="mb-0 counter">{{$total_user}}</h4><i class="icon-bg" data-feather="database"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
              <div class="card o-hidden border-0">
                <div class="bg-secondary b-r-4 card-body">
                  <div class="media static-top-widget">
                    <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                    <div class="media-body"><span class="m-0">Total Mahasiswa</span>
                      <h4 class="mb-0 counter">{{$total_mahasiswa}}</h4><i class="icon-bg" data-feather="database"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            <div class="col-sm-6 col-xl-4 col-lg-6">
              <div class="card o-hidden border-0">
                <div class="bg-primary b-r-4 card-body">
                  <div class="media static-top-widget">
                    <div class="align-self-center text-center"><i data-feather="message-circle"></i></div>
                    <div class="media-body"><span class="m-0">Total Alumni</span>
                      <h4 class="mb-0 counter">{{$total_alumni}}</h4><i class="icon-bg" data-feather="database"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
              <div class="card o-hidden border-0">
                <div class="bg-secondary b-r-4 card-body">
                  <div class="media static-top-widget">
                    <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                    <div class="media-body"><span class="m-0">Total Alumni Wirausaha</span>
                      <h4 class="mb-0 counter">{{$alumni_wirausaha}}</h4><i class="icon-bg" data-feather="database"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
              <div class="card o-hidden border-0">
                <div class="bg-primary b-r-4 card-body">
                  <div class="media static-top-widget">
                    <div class="align-self-center text-center"><i data-feather="message-circle"></i></div>
                    <div class="media-body"><span class="m-0">Total Alumni Studi Lanjut</span>
                      <h4 class="mb-0 counter">{{$alumni_studi_lanjut}}</h4><i class="icon-bg" data-feather="database"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-lg-6">
              <div class="card o-hidden border-0">
                <div class="bg-secondary b-r-4 card-body btn-klik-bekerja" style="cursor: pointer">
                  <div class="media static-top-widget">
                    <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                    <div class="media-body"><span class="m-0">Total Alumni Bekerja</span>
                      <h4 class="mb-0 counter">{{$alumni_bekerja}}</h4><i class="icon-bg" data-feather="database"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12 xl-100 box-col-12">
              <div class="card">
                <div class="cal-date-widget card-body">
                  <div class="row">
                    <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                      <div class="cal-info text-center">
                        <div>
                          <h2>{{date("m")}}</h2>
                          <div class="text-center"><span class="b-r-dark pe-3">{{date("F")}}</span><span class="ps-3">{{date("Y")}}</span></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                      <div class="cal-datepicker">
                        <div class="datepicker-here float-sm-end" data-language="en"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
    $(document).on("click", ".btn-klik-bekerja", function() {
      location.href = "{{route("dashboard.bekerja")}}";
    })
  });
</script>
@endsection