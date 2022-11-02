@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Edit Data Alumni</h5>
                  </div>
                  <form class="form theme-form">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Nama</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="name" placeholder="Nama Kompetisi">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">NIM</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="text" placeholder="NIM ">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">NIK</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="text" placeholder="NIK">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Jenis Kelamin</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="text" placeholder="Jenis Kelamin">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Tempat Lahir</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="text" placeholder="Tempat Lahir">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Tanggal Lahir</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="date" placeholder="Tanggal Lahir">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlTextarea19">Alamat</label>
                            <textarea class="form-control input-air-primary" id="exampleFormControlTextarea19" rows="3"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Nomor Hp</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="text" placeholder="NO HP">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Tahun Masuk</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="number" placeholder="Tahun Masuk">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Tahun Lulus</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="number" placeholder="Tahun Lulus">
                          </div>
                        </div>
                      </div> 
                      <div class="row">
                        <div class="col">
                          <div class="mt-2">
                            <label class="form-label" for="exampleInputPassword16">Foto</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="file" placeholder="Foto">
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