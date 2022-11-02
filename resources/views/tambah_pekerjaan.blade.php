@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Form Data Pekerjaan</h5>
                    <span>Isi Data Pekerjaan</span>
                  </div>
                  <form class="form theme-form" action="{{ route('tambahpekerjaan.store') }}" method="post">
                  @csrf
                    <div class="button text-end me-4">
                    <button class="btn btn-secondary" type="submit">Kembali</button>
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Jenis Pekerjaan</label>
                            <select class="form-select input-air-primary digits" name="jenis" id="">
                              <option value="1">Pilih Jenis Pekerjaan</option>
                              <option value="2">Dosen</option>
                              <option value="3">Dokter</option>
                              <option value="4">Pegawai Swasta</option>
                              <option value="5">TNI</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Kategori</label>
                            <select class="form-select input-air-primary digits" name="kategori" id="">
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
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Jabatan</label>
                            <select class="form-select input-air-primary digits" name="jabatan" id="">
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
                            <label class="form-label" for="exampleFormControlSelect17">Instansi</label>
                            <select class="form-select input-air-primary digits" name="instansi" id="">
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
                            <label class="form-label" for="exampleInputPassword16">Kontak</label>
                            <input class="form-control input-air-primary" name="kontak" id="" type="text" placeholder="Kontak">
                          </div>
                        </div>
                      </div>                     
                      <div class="row g-3">
                        <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">PKKWT / PKWT</label>
                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                          <div class="radio radio-primary">
                            <input id="radioinline1" type="radio" name="radio1" value="ya">
                            <label class="mb-0" for="radioinline1">Ya</label>
                          </div>
                          <div class="radio radio-primary">
                            <input id="radioinline2" type="radio" name="radio1" value="tidak">
                            <label class="mb-0" for="radioinline2">Tidak</label>
                          </div>
                        </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">PKKKPW</label>
                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                          <div class="radio radio-primary">
                            <input id="radioinline3" type="radio" name="radio2" value="ya">
                            <label class="mb-0" for="radioinline3">Ya</label>
                          </div>
                          <div class="radio radio-primary">
                            <input id="radioinline4" type="radio" name="radio2" value="tidak">
                            <label class="mb-0" for="radioinline4">Tidak</label>
                          </div>
                        </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">PKKBPW</label>
                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                          <div class="radio radio-primary">
                            <input id="radioinline7" type="radio" name="radio3" value="ya">
                            <label class="mb-0" for="radioinline7">Ya</label>
                          </div>
                          <div class="radio radio-primary">
                            <input id="radioinline8" type="radio" name="radio3" value="tidak">
                            <label class="mb-0" for="radioinline8">Tidak</label>
                          </div>
                        </div>
                          </div>
                        </div>
                        
                      </div>

                      <div class="row g-3">
                        <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">PNS</label>
                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                          <div class="radio radio-primary">
                            <input id="radioinline9" type="radio" name="radio4" value="ya">
                            <label class="mb-0" for="radioinline9">Ya</label>
                          </div>
                          <div class="radio radio-primary">
                            <input id="radioinline10" type="radio" name="radio4" value="tidak">
                            <label class="mb-0" for="radioinline10">Tidak</label>
                          </div>
                        </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputPassword16">PPPK</label>
                            <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                          <div class="radio radio-primary">
                            <input id="radioinline11" type="radio" name="radio5" value="ya">
                            <label class="mb-0" for="radioinline11">Ya</label>
                          </div>
                          <div class="radio radio-primary">
                            <input id="radioinline12" type="radio" name="radio5" value="tidak">
                            <label class="mb-0" for="radioinline12">Tidak</label>
                          </div>
                        </div>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="row">
                        <div class="col">
                          <div class="mt-2">
                            <label class="form-label" for="exampleInputPassword16">Foto</label>
                            <input class="form-control input-air-primary" id="exampleInputPassword16" type="file" placeholder="Foto">
                            <div class="invalid-feedback">Example invalid form file feedback</div>
                          </div>
                        </div>
                      </div> -->
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