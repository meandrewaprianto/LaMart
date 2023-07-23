<!DOCTYPE html>
<html>
  <head>
   <title>Cetak Kartu Member</title>
   <style>
      .box{ position: relative; }
      .card{ width: 502.732pt; height: 327.402pt }
      .kode {
        position: absolute;
        top: 160pt;
        left: 15pt;
        color: #ddd;
        font-size: 10pt;
      }
      .barcode {
        position: absolute;
        top: 90pt;
        left: 400pt;
        font-size: 10pt;
      }
   </style>
  </head>
  <body>
    <table width="100%">
      @foreach($datamember as $data)
        <tr>
          <td align="center">
            <div class="box">
              <img src="{{ public_path('images/card.png') }}" alt="card" class="card"/>
              <div class="kode">{{ $data->kode_member }}</div>
              <div class="barcode">
              <img src="data:image/png;base64, {{ DNS1D::getBarcodePNG($data->kode_member, 'C39') }}" height="30" width="120"><br>{{ $data->kode_member }}<br>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
    </table>
  </body>
</html>