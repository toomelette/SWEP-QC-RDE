
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>TEN - YEAR DATA ON AGRICULTURAL PARAMETERS</title>
  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/dist/css/skins/_all-skins.min.css') }}">
</head>

<body onload="window.print();" onafterprint="window.close()" style="font-size: 11px;">

<section class="invoice">

  {{-- HEADER --}}
  <div class="row" style="padding:11px; text-align: center;">
    <span style="font-size: 14px;">CROP-YEAR: {{ $crop_year }}</span><br>
    <span style="font-size: 14px;">ANNEX IV</span><br>
    <span style="font-size: 14px;">TEN - YEAR DATA ON AGRICULTURAL PARAMETERS</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th style="text-align:center;">CROP YEAR</th>
                    <th style="text-align:center;">AREA HARVESTED <br>(Hectares)</th>
                    <th style="text-align:center;">TC/Ha</th>
                    <th style="text-align:center;">LKg/TC</th>
                    <th style="text-align:center;">LKg/Ha</th>
                </tr> 
            </thead>
            
            <tbody>
                @foreach ($collection as $key => $data)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="text-align:right;"> {{ $data['cy_name'] }}</td>
                        <td style="text-align:right;"> {{ displayData($data['area_harvested']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['tc_ha']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['lkg_tc']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['lkg_ha']) }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>