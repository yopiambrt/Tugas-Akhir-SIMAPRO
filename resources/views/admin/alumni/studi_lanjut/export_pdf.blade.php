<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- Bootstrap CSS -->

    <title>Export Alumni Studi Lanjut</title>
    <style type="text/css">
      body{
        font-size: 12px;
      }
      table, td, th {
        border: 1px solid black;
      }
      table th{
        font-size: 12px;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        color: #333;
      }
      table tbody{
        text-align: center;
      }
      @page{
        margin-top: 15px;
      }
      .column-float {
        float: left;
        width: 50%;
      }
      .row-float:after {
        content: "";
        display: block;
        clear: both;
      }
    </style>
  </head>
  <body>
    <div class="row-float" style="margin-top: 5px;">
      <div class="column-float note" style="width: 15%;">
          <div style="height: 130px;">
            <img src="<?= base_path('public/assets/img/kop-surat.png') ?>" style="width: 100%;height: 100%;">
          </div>
      </div>
      <div class="column-float" style="width: 85%;margin-top: 15px;padding-top: 0px;">
        <h3 style="text-align: center;margin: 0;padding: 0;margin-bottom: 0 !important;padding-bottom: 0 !important;font-size: 18px;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,
          RISET, DAN TEKNOLOGI
          </h3>
        <h3 style="text-align: center;margin: 0;padding: 0;margin-bottom: 0 !important;padding-bottom: 0 !important;font-size: 18px;">UNIVERSITAS SEBELAS MARET</h2>
        <h3 style="text-align: center;margin: 0;padding: 0;margin-bottom: 0 !important;padding-bottom: 0 !important;font-size: 20px;">SEKOLAH VOKASI</h3>
        <p style="text-align: center;margin: 0;padding: 0;margin-bottom: 0 !important;padding-bottom: 0 !important;font-size: 14px;">PROGRAM STUDI D3 TEKNIK INFORMATIKA </p>
        <p style="text-align: center;margin: 0;padding: 0;margin-bottom: 0 !important;padding-bottom: 0 !important;font-size: 14px;">Jalan Insinyur Sutami Nomor 36A Kentingan  Surakarta 57126</p>
        <p style="text-align: center;margin: 0;padding: 0;margin-bottom: 0 !important;padding-bottom: 0 !important;font-size: 14px;">Telepon (0271) 663450 Faksimile (0271) 663450 </p>
        <p style="text-align: center;margin: 0;padding: 0;margin-bottom: 0 !important;padding-bottom: 0 !important;font-size: 14px;">email : kontak@d3ti.vokasi.uns.ac.id, Website : http://d3ti.vokasi.uns.ac.id</p>
      </div>
    </div>
    <hr>
    <div class="row" style="margin-top: 15px;">
      <table style="width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nim</th>
                <th>Tanggal Mulai</th>
                <th>Nama Universitas</th>
                <th>Program Studi</th>
                <th>Fakultas</th>
              </tr>
          </thead>
          <tbody>
              @forelse($table as $index => $row)
              <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$row->user->biodata->nama ?? null}}</td>
                  <td>{{$row->user->biodata->nim ?? null}}</td>
                  <td>
                    @if(!empty($row->tanggal_mulai))
                    {{date("d-m-Y",strtotime($row->tanggal_mulai))}}
                    @endif
                  </td>
                  <td>{{$row->nama_universitas}}</td>
                  <td>{{$row->program_studi}}</td>
                  <td>{{$row->fakultas}}</td>
              </tr>
              @empty
              <tr>
                <td colspan="7" style="text-align : center;">Data tidak ditemukan</td>
              </tr>
              @endforelse
          </tbody>
      </table>
    </div>

  </body>
</html>