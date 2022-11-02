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
                            @if(!empty($waktu_tunggu))
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body bg-primary">
                                            <p>
                                                {{$waktu_tunggu}}
                                            </p>
                                            <p>
                                                {{$waktu_tunggu_detail}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
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
                                                    <?php
                                                        $nama = null;
                                                        $email = null;

                                                        if(empty($result)){
                                                            $nama = Auth::user()->name;
                                                            $email = Auth::user()->email;
                                                        }
                                                        else{
                                                            $nama = $result->nama;
                                                            $email = $result->email;
                                                        }
                                                    ?>
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="nama" placeholder="Nama lengkap" value="{{$nama}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{$email}}"/>
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
                                    @if(empty($result) || (isset($result->user->alumni->status_verifikasi) &&$result->user->alumni->status_verifikasi == \App\Models\Alumni::STATUS_VERIFIKASI_NO))
                                    <button class="btn btn-warning btn-reset" type="button" style="margin-left: 10px;">Reset</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if($pendataan_alumni == true)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <a class="btn btn-primary" href="{{route("mhs.pendataan_alumni.create")}}">Pendataan Alumni</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(!empty($result->user->alumni) && $result->user->alumni->status_kelulusan == \App\Models\Alumni::STATUS_KELULUSAN_YES)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <!-- Nav tabs -->
                                <h5 class="mb-2">RIWAYAT PEKERJAAN</h5>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="riwayat-bekerja-tab" data-bs-toggle="tab" data-bs-target="#riwayat-bekerja" type="button" role="tab" aria-controls="riwayat-bekerja" aria-selected="true">Riwayat Bekerja</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="wirausaha-tab" data-bs-toggle="tab" data-bs-target="#wirausaha" type="button" role="tab" aria-controls="wirausaha" aria-selected="false">Riwayat Wirausaha</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="studi-lanjut-tab" data-bs-toggle="tab" data-bs-target="#studi-lanjut" type="button" role="tab" aria-controls="studi-lanjut" aria-selected="false">Studi Lanjut</button>
                                        </li>
                                </ul>
                                
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="riwayat-bekerja" role="tabpanel" aria-labelledby="riwayat-bekerja-tab">
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="example" class="table table-striped" style="width:100%">
                                                        <thead>
                                                            <th>Nama</th>
                                                            <th>NIM</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Nama Instansi</th>
                                                            <th>Jenis Pekerjaan</th>
                                                            <th>Jenis Perusahaan</th>
                                                            <th>Created At</th>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($bekerja as $index => $row)
                                                                <tr>
                                                                    <td>{{$row->user->biodata->nama ?? null}}</td>
                                                                    <td>{{$row->user->biodata->nim ?? null}}</td>
                                                                    <td>
                                                                        @if(!empty($row->tanggal_mulai))
                                                                        <?= date("d-m-Y",strtotime($row->tanggal_mulai)) ?>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{$row->nama_instansi}}</td>
                                                                    <td>{{$row->jenis_pekerjaan}}</td>
                                                                    <td>{{$row->jenis_perusahaan->nama ?? null}}</td>
                                                                    <td>{{date("d-m-Y H:i:s",strtotime($row->created_at))}}</td>
                                                                </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="10" class="text-center">Data tidak ditemukan</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="wirausaha" role="tabpanel" aria-labelledby="wirausaha-tab">
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="example" class="table table-striped" style="width:100%">
                                                        <thead>
                                                            <th>Nama</th>
                                                            <th>NIM</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Nama Usaha</th>
                                                            <th>Jenis Usaha</th>
                                                            <th>Level Usaha</th>
                                                            <th>Created At</th>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($wirausaha as $index => $row)
                                                                <tr>
                                                                    <td>{{$row->user->biodata->nama ?? null}}</td>
                                                                    <td>{{$row->user->biodata->nim ?? null}}</td>
                                                                    <td>
                                                                        @if(!empty($row->tanggal_mulai))
                                                                        <?= date("d-m-Y",strtotime($row->tanggal_mulai)) ?>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{$row->nama_usaha}}</td>
                                                                    <td>{{$row->jenis_usaha->nama ?? null}}</td>
                                                                    <td>{{$row->level_usaha->nama ?? null}}</td>
                                                                    <td>{{date("d-m-Y H:i:s",strtotime($row->created_at))}}</td>
                                                                </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="10" class="text-center">Data tidak ditemukan</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="studi-lanjut" role="tabpanel" aria-labelledby="studi-lanjut-tab">
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="example" class="table table-striped" style="width:100%">
                                                        <thead>
                                                            <th>Nama</th>
                                                            <th>NIM</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Nama Universitas</th>
                                                            <th>Program Studi</th>
                                                            <th>Fakultas</th>
                                                            <th>Created At</th>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($studi_lanjut as $index => $row)
                                                                <tr>
                                                                    <td>{{$row->user->biodata->nama ?? null}}</td>
                                                                    <td>{{$row->user->biodata->nim ?? null}}</td>
                                                                    <td>
                                                                        @if(!empty($row->tanggal_mulai))
                                                                        <?= date("d-m-Y",strtotime($row->tanggal_mulai)) ?>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{$row->nama_universitas}}</td>
                                                                    <td>{{$row->program_studi}}</td>
                                                                    <td>{{$row->fakultas}}</td>
                                                                    <td>{{date("d-m-Y H:i:s",strtotime($row->created_at))}}</td>
                                                                </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="10" class="text-center">Data tidak ditemukan</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
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
        @endif
    </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $("button[type='submit']").attr("disabled",false);

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
                if(confirm("Apakah anda yakin ingin menyimpan data ini ? ")){
                    $.ajax({
                        url : '{{route('mhs.biodatas.store')}}',
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
                                    '{{route('mhs.biodata')}}'
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
