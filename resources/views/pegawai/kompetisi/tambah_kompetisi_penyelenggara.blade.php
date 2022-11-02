@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5>Form Penyelenggara Kompetisi</h5>
                    <span>Input Penyelenggara</span>
                  </div>
                  <form class="form theme-form">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect17">Jenis Penyelenggara</label>
                            <select class="form-select input-air-primary digits" id="exampleFormControlSelect17">
                              <option>Pilih Jenis Penyelenggara</option>
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
                            <label class="form-label" for="exampleFormControlInput15">Nama Penyelenggara</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="text" placeholder="Nama Penyelenggara">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput15">Urutan</label>
                            <input class="form-control input-air-primary" id="exampleFormControlInput15" type="text" placeholder="Urutan">
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