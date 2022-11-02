@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                  <h5>Form Prestasi</h5>
                  </div>
                  <form class="form theme-form">
                    <div class="card-body">
                    <div class="card-footer text-end">
                      <button class="btn btn-primary" type="submit">Kembali</button>
                    </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Nama</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="name" placeholder="Nama">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">NIM</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="name" placeholder="NIM">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Dosbing</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="text" placeholder="Dosbing">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Nama Kompetisi</label>
                            <select class="form-select input-air-primary digits" id="exampleFormControlSelect17">
                              <option>--pilih--</option>
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
                            <label class="form-label" for="exampleFormControlSelect17">Peran</label>
                            <select class="form-select input-air-primary digits" id="exampleFormControlSelect17">
                              <option>--pilih--</option>
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
                            <label class="form-label" for="exampleInputPassword16">Nama Tim</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="text" placeholder="Nama Tim">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Hasil</label>
                            <select class="form-select input-air-primary digits" id="exampleFormControlSelect17">
                              <option>--pilih--</option>
                              <option>Juara 1</option>
                              <option>Juara 2</option>
                              <option>Juara 3</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mt-2">
                            <label class="form-label" for="exampleInputPassword16">Bukti</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="file" placeholder="Poster">
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