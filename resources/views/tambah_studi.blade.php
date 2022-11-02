@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Form Tambah Studi Lanjut Mahasiswa</h5>
                    <span>Data Studi Lanjut Mahasiswa</span>
                  </div>
                  <form class="form theme-form">
                  <div class="button text-end me-4">
                    <button class="btn btn-secondary" type="submit">Kembali</button>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Nama Universitas</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="name" placeholder="Nama Universitas">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Kategori Universitas</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="name" placeholder="Kategori Universitas">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Program Studi</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="text" placeholder="Program Studi">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Fakultas</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="text" placeholder="Fakultas">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Jenjang</label>
                            <select class="form-select input-air-primary digits" id="exampleFormControlSelect17">
                              <option>Pilih Jenjang</option>
                              <option>S1</option>
                              <option>S2</option>
                              <option>S3</option>
                            </select>
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