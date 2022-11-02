@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Form Data Alumni</h5>
                    </div>
                    <form class="form theme-form" action="{{ route('mawa.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlInput15">Nama</label>
                                        <input type="text" name="user_id" value="{{ Auth::user()->name }}"
                                            class="form-control input-air-primary">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleInputPassword16">NIM</label>
                                        <input class="form-control input-air-primary" id="exampleInputPassword16"
                                            type="text" placeholder="NIM " name="nim">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleInputPassword16">NIK</label>
                                        <input class="form-control input-air-primary" id="exampleInputPassword16"
                                            type="text" placeholder="NIK" name="nik">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleInputPassword16">Jenis Kelamin</label>
                                        <input class="form-control input-air-primary" id="exampleInputPassword16"
                                            type="text" placeholder="Jenis Kelamin" name="jenis_kelamin">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleInputPassword16">Tempat Lahir</label>
                                        <input class="form-control input-air-primary" id="exampleInputPassword16"
                                            type="text" placeholder="Tempat Lahir" name="tempat_lahir">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleInputPassword16">Tanggal Lahir</label>
                                        <input class="form-control input-air-primary" id="exampleInputPassword16"
                                            type="date" placeholder="Tanggal Lahir" name="tanggal_lahir">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlTextarea19">Alamat</label>
                                        <textarea class="form-control input-air-primary" id="exampleFormControlTextarea19" rows="3" name="alamat"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleInputPassword16">Nomor Hp</label>
                                        <input class="form-control input-air-primary" name="no_hp"
                                            id="exampleInputPassword16" type="text" placeholder="NO HP">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleInputPassword16">Tahun Masuk</label>
                                        <input class="form-control input-air-primary" id="exampleInputPassword16"
                                            type="number" placeholder="Tahun Masuk" name="tahun_masuk">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleInputPassword16">Tanggal Lulus</label>
                                        <input class="form-control input-air-primary" id="exampleInputPassword16"
                                            type="date" placeholder="Tanggal Lulus" name="tanggal_lulus">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleInputPassword16">Tanggal Wisuda</label>
                                        <input class="form-control input-air-primary" id="exampleInputPassword16"
                                            type="date" placeholder="Tanggal Wisuda" name="tanggal_wisuda">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="exampleFormControlSelect17">Status
                                            Mahasiswa</label>
                                        <select class="form-select input-air-primary digits"
                                            id="exampleFormControlSelect17" name="status">
                                            <option value="0">Status Mahasiswa</option>
                                            <option value="1">Tidak Bekerja</option>
                                            <option value="2">Bekerja</option>
                                            <option value="3">Usaha</option>
                                            <option value="4">Studi Lanjut</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mt-2">
                                        <label class="form-label" for="exampleInputPassword16">Foto</label>
                                        <input class="form-control input-air-primary" id="exampleInputPassword16"
                                            type="file" placeholder="Foto" name="foto">
                                        <div class="invalid-feedback">Example invalid form file feedback</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <input class="btn btn-light" type="reset" value="Cancel">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
