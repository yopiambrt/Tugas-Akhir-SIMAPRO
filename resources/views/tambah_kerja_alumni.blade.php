@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Form Data Pekerjaan Alumni</h5>
                    <span>Data Pekerjaan Alumni</span>
                  </div>
                  <div class="button text-end me-4">
                    <button class="btn btn-secondary" type="submit">Kembali</button>
                    <form class="form theme-form" action="{{ route('tambahalumni.store') }}" method="post">
                    @csrf
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Nama</label>
                            <input class="form-control input-air-primary" id="" name="nama" type="name" placeholder="Nama">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">NIM</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" name="nim" type="text" placeholder="NIM">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">Angkatan / Tahun Masuk</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="text" name="angkatan" placeholder="Angkatan / Tahun Masuk">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Jenis Pekerjaan</label>
                            <select class="form-select input-air-primary digits" name="pekerjaan" id="exampleFormControlSelect17">
                              <option>Pilih Pekerjaan</option>
                              <option value="1">1</option>
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
                            <label class="form-label" for="exampleFormControlSelect17">Instansi</label>
                            <select class="form-select input-air-primary digits"name="instansi" id="exampleFormControlSelect17">
                              <option>Pilih Instansi</option>
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
                            <label class="form-label" for="exampleInputPassword16">Tanggal Masuk</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" name="masuk" type="date" placeholder="Tanggal Masuk">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Jabatan</label>
                            <select class="form-select input-air-primary digits" name="jabatan" id="exampleFormControlSelect17">
                              <option>Pilih Jabatan</option>
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
                            <label class="form-label" for="exampleInputPassword16">Gaji Pertama</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" name="gaji" type="number" placeholder="Gaji Pertama">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">UMR Kota / Kabupaten</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" name="umr" type="number" placeholder="UMR Kota / Kabupaten">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Kategori Pekerjaan</label>
                            <select class="form-select input-air-primary digits" name="kategori" id="exampleFormControlSelect17">
                              <option>Pilih Kategori</option>
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
                          <div class="mt-2">
                            <label class="form-label" for="exampleInputPassword16">Foto</label>
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