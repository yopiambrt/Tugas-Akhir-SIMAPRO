<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- Bootstrap CSS -->

    <title>Export Alumni Wirausaha</title>
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
    </style>
  </head>
  <body>
    
    <div class="row" style="margin-top: 15px;">
      <table style="width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nim</th>
                <th>Tanggal Mulai</th>
                <th>Nama Usaha</th>
                <th>Jenis Usaha</th>
                <th>Level Usaha</th>
              </tr>
          </thead>
          <tbody>
              @foreach($table as $index => $row)
              <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$row->user->biodata->nama ?? null}}</td>
                  <td>{{$row->user->biodata->nim ?? null}}</td>
                  <td>
                    @if(!empty($row->tanggal_mulai))
                    {{date("d-m-Y",strtotime($row->tanggal_mulai))}}
                    @endif
                  </td>
                  <td>{{$row->nama_usaha}}</td>
                  <td>{{$row->jenis_usaha->nama ?? null}}</td>
                  <td>{{$row->level_usaha->nama ?? null}}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </div>

  </body>
</html>