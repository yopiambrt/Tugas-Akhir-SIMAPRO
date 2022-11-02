@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Form Tambah Instansi</h5>
                    <span>Data Instansi Pekerjaan</span>
                  </div>
                  <form class="form theme-form" action="{{route('mhsinstansi.store')}}" method="post">
                  <div class="button text-end me-4">
                    <button class="btn btn-secondary" type="submit">Kembali</button>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Nama Instansi</label>
                            <input class="form-control input-air-primary" name="nama" id="exampleFormControlInput15" type="name" placeholder="Nama">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlTextarea19">Alamat Instansi</label>
                            <textarea class="form-control input-air-primary"name="alamat" id="exampleFormControlTextarea19" rows="3"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Email Instansi</label>
                            <input class="form-control input-air-primary" name="email" id="exampleInputPassword16" type="email" placeholder="Email instansi">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Level</label>
                            <select class="form-select input-air-primary digits" name="level" id="exampleFormControlSelect17">
                              <option>Pilih Pekerjaan</option>
                              <option value="1">2</option>
                              <option value="2">3</option>
                              <option value="3">4</option>
                              <option value="4">5</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Bidang</label>
                            <select class="form-select input-air-primary digits" name="bidang" id="exampleFormControlSelect17">
                              <option>Pilih Bidang</option>
                              <option value="1">Keuangan</option>
                              <option value="2">Teknologi</option>
                              <option value="3">Kesehatan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                     
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Jenis Instansi</label>
                            <select class="form-select input-air-primary digits" name="jenis" id="exampleFormControlSelect17">
                              <option>Pilih Jenis</option>
                              <option value="1">Swasta</option>
                              <option value="2">Negeri</option>
                              <option value="3">Desa</option>
                              <option value="4">Kabupaten</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row g-3">
                        <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">SIUP</label>
                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                          <div class="radio radio-primary">
                            <input id="radioinline1" type="radio"name="siup" value="option1">
                            <label class="mb-0" for="radioinline1" value="ya">Ya</label>
                          </div>
                          <div class="radio radio-primary">
                            <input id="radioinline2" type="radio" name="siup" value="option1">
                            <label class="mb-0" for="radioinline2" value="tidak">Tidak</label>
                          </div>
                        </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">IUMK</label>
                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                          <div class="radio radio-primary">
                            <input id="radioinline3" type="radio" name="iumk" value="option1">
                            <label class="mb-0" for="radioinline3" value="ya">Ya</label>
                          </div>
                          <div class="radio radio-primary">
                            <input id="radioinline4" type="radio" name="iumk" value="option1">
                            <label class="mb-0" for="radioinline4" value="tidak">Tidak</label>
                          </div>
                        </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Yayasan</label>
                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                          <div class="radio radio-primary">
                            <input id="radioinline5" type="radio" name="yayasan" value="option1">
                            <label class="mb-0" for="radioinline5" value="ya">Ya</label>
                          </div>
                          <div class="radio radio-primary">
                            <input id="radioinline6" type="radio" name="yayasan" value="option1">
                            <label class="mb-0" for="radioinline6" value="tidak">Tidak</label>
                          </div>
                        </div>
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="row g-3">
                        <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">PBH</label>
                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                          <div class="radio radio-primary">
                            <input id="radioinline7" type="radio" name="pbh" value="option1">
                            <label class="mb-0" for="radioinline7"value="ya">Ya</label>
                          </div>
                          <div class="radio radio-primary">
                            <input id="radioinline8" type="radio" name="pbh" value="option1">
                            <label class="mb-0" for="radioinline8"value="tidak">Tidak</label>
                          </div>
                        </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">LSM</label>
                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                          <div class="radio radio-primary">
                            <input id="radioinline9" type="radio" name="lsm" value="option1">
                            <label class="mb-0" for="radioinline9"value="ya">Ya</label>
                          </div>
                          <div class="radio radio-primary">
                            <input id="radioinline10" type="radio" name="lsm" value="option1">
                            <label class="mb-0" for="radioinline10"value="tidak">Tidak</label>
                          </div>
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