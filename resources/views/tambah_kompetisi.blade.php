@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Form Kompetisi</h5>
                  </div>
                  <form class="form theme-form">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Nama Kompetisi</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="name" placeholder="Nama Kompetisi">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Tahun/Periode</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="number" placeholder="Tahun / Periode ">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Kepanjangan</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="text" placeholder="Kepanjangan">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlTextarea19">Deskripsi</label>
                            <textarea class="form-control input-air-primary" id="exampleFormControlTextarea19" rows="3"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Kategori</label>
                            <select class="form-select input-air-primary digits" id="exampleFormControlSelect17">
                              <option>Pilih Kategori</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Nama Penyelenggara</label>
                            <select class="form-select input-air-primary digits" id="exampleFormControlSelect17">
                              <option>Pilih Nama Penyelenggara</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Skala Kegiatan</label>
                            <select class="form-select input-air-primary digits" id="exampleFormControlSelect17">
                              <option>Skala Kegiatan</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row g-3">
                        <div class="col-md-4">
                          <label class="form-label" for="validationCustom01">Registrasi Dibuka</label>
                          <input class="form-control" id="validationCustom01" type="date" value="" required="">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="validationCustom02">Regitrasi Ditutup</label>
                          <input class="form-control" id="validationCustom02" type="date" value="" required="">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="validationCustom02">Pelaksanaan Dimulai</label>
                          <input class="form-control" id="validationCustom02" type="date" value="" required="">
                        </div>
                        
                      </div>
                      <div class="row g-3 mt-1">
                        <div class="col-md-4">
                          <label class="form-label" for="validationCustom01">Pelaksanaan Selesai</label>
                          <input class="form-control" id="validationCustom01" type="date" value="" required="">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="validationCustom02">Hadiah</label>
                          <input class="form-control" id="validationCustom02" type="text" value="" required="">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="validationCustom02">Biaya Pendaftaran</label>
                          <input class="form-control" id="validationCustom02" type="number" value="" required="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div>
                            <label class="form-label" for="exampleFormControlTextarea19">Panduan</label>
                            <textarea class="form-control input-air-primary" id="exampleFormControlTextarea19" rows="5"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mt-2">
                            <label class="form-label" for="exampleInputPassword16">Poster</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="file" placeholder="Poster">
                            <div class="invalid-feedback">Example invalid form file feedback</div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mt-2">
                            <label class="form-label" for="exampleInputPassword16">Tautan/URL</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="url" placeholder="Kepanjangan">
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