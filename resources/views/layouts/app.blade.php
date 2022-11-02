<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities. laravel/framework: ^8.40">
    <meta name="keywords"
        content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="https://laravel.pixelstrap.com/viho/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="https://laravel.pixelstrap.com/viho/assets/images/favicon.png" type="image/x-icon">
    <title>Dashboard | SIMAPRO</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/date-picker.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/style.css">
    <link id="color" rel="stylesheet" href="https://laravel.pixelstrap.com/viho/assets/css/color-1.css"
        media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/responsive.css">
    {{-- Sweetalert --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.css') }}">
    {{-- Fontawesine --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
    <style>
        .background-grey{
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: grey;
            opacity: 0.6;
            width: 100%;
            height: 100%;
            z-index: 9999999;
        }
    </style>
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader"></div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-sidebar" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right row m-0">
                <div class="main-header-left">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset('assets/img/hero-img.png') }}" alt="" width="30"
                                height="24" class="d-inline-block align-text-top">
                            SIMAPRO
                        </a>
                    </div>
                    <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center"
                            id="sidebar-toggle"> </i></div>
                </div>
             
                <div class="nav-right col pull-right right-menu p-0">
                    <ul class="nav-menus">
                        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                                    data-feather="maximize"></i></a></li>           
                        <li class="onhover-dropdown p-0">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-primary-light" type="submit"><i
                                        data-feather="log-out"></i>Log
                                    out</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">
            <!-- Page Sidebar Start-->
            <header class="main-nav">
                <div class="sidebar-user text-center">
                    <a class="setting-primary" href="{{route("profile")}}"><i data-feather="settings"></i></a><img
                        class="img-90 rounded-circle"
                        src="@if(!empty(Auth::user()->avatar)) {{asset(Auth::user()->avatar)}} @else https://laravel.pixelstrap.com/viho/assets/images/dashboard/1.png @endif" alt="" style="height: 80px;width: 80px;"/>
                    <a href="{{route("profile")}}">
                        <h6 class="mt-3 f-14 f-w-600"> {{ Auth::user()->name }}</h6>
                    </a>
                    <p class="mb-0 font-roboto"> {{ Auth::user()->role->name }} </p>

                </div>
                @include('components.navbar')
            </header>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <!-- Container-fluid starts-->
                <!-- Container-fluid starts-->

                <div class="container-fluid dashboard-default-sec">
                    @if(session('error') || session('success'))
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-{{ session('error') ? 'danger' : 'success' }} alert-dismissible fade show" role="alert">
                                @if (session('error'))
                                <strong>Error!</strong> {!! session('error') !!}
                                @elseif (session('success'))
                                <strong>Berhasil!</strong> {!! session('success') !!}
                                @endif
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    @endif

                    @yield('content')
                </div>
                <!-- Container-fluid Ends-->
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright 2022 © Teknik Informatika</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <div class="modal fade" id="loader" tabindex="false" role="dialog" aria-labelledby="loadMeLabel">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fas fa-spinner fa-pulse"></i> Tunggu
                </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="https://laravel.pixelstrap.com/viho/assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="https://laravel.pixelstrap.com/viho/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="https://laravel.pixelstrap.com/viho/assets/js/sidebar-menu.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="https://laravel.pixelstrap.com/viho/assets/js/bootstrap/popper.min.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/bootstrap/bootstrap.min.js"></script>

    <script src="https://laravel.pixelstrap.com/viho/assets/js/vector-map/map/jquery-jvectormap-in-mill.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/vector-map/map/jquery-jvectormap-asia-mill.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/dashboard/default.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/notify/index.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('backend/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script> --}}
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/datatable/datatable-extension/custom.js') }}"></script>
    <script src="{{ asset('backend/assets/js/tooltip-init.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="https://laravel.pixelstrap.com/viho/assets/js/script.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/theme-customizer/customizer.js"></script>
    <!-- Plugin used-->
    {{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> --}}

    <!-- Plugins JS start-->
    <script src="{{ asset('backend/assets/js/editor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('backend/assets/js/editor/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="{{ asset('backend/assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('backend/assets/js/email-app.js') }}"></script>
    <script src="{{ asset('backend/assets/js/form-validation-custom.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('backend/assets/js/script.js') }}"></script>
    <script src="{{ asset('backend/assets/js/theme-customizer/customizer.js') }}"></script>
    {{-- Sweetalert --}}
    <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.js') }}"></script>

    <script type="text/javascript">
        function swal_success(message = "", callback = null){
            Swal.fire({
                icon : "success",
                title : "success",
                text : message
            }).then((ok) => {
                if(callback != null){
                    return location.href = callback
                }
            })
        }
        function swal_error(message){
            Swal.fire({
                icon : "error",
                title : "Oops...",
                text : message
            })
        }
        function internalServerError(){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Internal server error',
            })
        }
        function agama(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/agama') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['agama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['agama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Agama==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }
        function province(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/territory/province') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['prov_id']){
                                option += '<option value="'+e['prov_id']+'" selected>'+e['prov_name']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['prov_id']+'">'+e['prov_name']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Provinsi==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }
        function city(target,province_id,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/territory/city') }}",
                data : {
                    province_id : province_id
                },
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['city_id']){
                                option += '<option value="'+e['city_id']+'" selected>'+e['city_name']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['city_id']+'">'+e['city_name']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Kota/Kabupaten==</option>' + option;
                            
                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }

        function jenis_usaha(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/master/jenis_usaha') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['nama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['nama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Jenis Usaha==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }

        function level_usaha(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/master/level_usaha') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['nama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['nama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Level Usaha==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }

        function kriteria_usaha(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/master/kriteria_usaha') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['nama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['nama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Kriteria Usaha==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }

        function kriteria_pekerja_lepas(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/master/kriteria_pekerja_lepas') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['nama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['nama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Kriteria Pekerja Lepas==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }

        function status_pekerjaan(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/master/status_pekerjaan') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['nama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['nama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Status Pekerjaan==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }

        function kategori_pekerjaan(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/master/kategori_pekerjaan') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['nama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['nama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Kategori Pekerjaan==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }

        function level_instansi(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/master/level_instansi') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['nama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['nama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Level Instansi==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }

        function universitas_jenjang(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/master/universitas_jenjang') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['nama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['nama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Jenjang Universitas==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }

        function universitas_level(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/master/universitas_level') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['nama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['nama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Level Universitas==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }

        function universitas_kategori(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/master/universitas_kategori') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['nama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['nama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Kategori Universitas==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }

        function jenis_perusahaan(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/master/jenis_perusahaan') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['nama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['nama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Jenis Perusahaan==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }

        function pendidikan(target,selected_id = null,replace = false){
            $.ajax({
                url: "{{ url('/api/base/master/pendidikan') }}",
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').addClass('show');
                    $('#loader').addClass('background-grey');
                    $('#loader').css('display','block');
                },
                success: function (resp) {
                    if (resp.IsError === true) {
                        swal_error(resp.Message);
                    } else {
                        let option = "";
                        $.each(resp.Data , function(i,e){
                            if(selected_id != null && selected_id == e['id']){
                                option += '<option value="'+e['id']+'" selected>'+e['nama']+'</option>';
                            }
                            else{
                                option += '<option value="'+e['id']+'">'+e['nama']+'</option>';
                            }
                        })
                        if(replace == false){
                            $(target + "").append(option);
                        }
                        else{
                            option = '<option value="">==Pilih Pendidikan==</option>' + option;

                            $(target + "").html(option)
                        }
                    }
                },
                error: function (response) {
                    internalServerError()
                },
                complete: function () {
                    $('#loader').removeClass('show');
                    $('#loader').removeClass('background-grey');
                    $('#loader').css('display','none');
                }
            })
        }
    </script>


    @yield('script')
</body>

</html>
