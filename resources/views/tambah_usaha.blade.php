@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Form Tambah Usaha</h5>
                    <span>Data Usaha Alumni</span>
                  </div>
                  <form class="form theme-form">
                  <div class="button text-end me-4">
                    <button class="btn btn-secondary" type="submit">Kembali</button>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Nama Usaha</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="name" placeholder="Nama">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Jenis Usaha</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="name" placeholder="Nama">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Kategori Usaha</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="text" placeholder="Kategori Usaha">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Bidang Usaha</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="text" placeholder="Bidang Usaha">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Tanggal Berdiri</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="date" placeholder="Email instansi">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Penghasilan</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="number" placeholder="Penghasilan">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mt-2">
                            <label class="form-label" for="exampleInputPassword16">Upload Foto Usaha</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="file" placeholder="Foto">
                            <div class="invalid-feedback">Example invalid form file feedback</div>
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