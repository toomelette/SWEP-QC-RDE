
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>TEN - YEAR SUMMARY OF SIGNIFICANT PRODUCTION RATIO AND YIELD</title>
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
    <span style="font-size: 14px;">ANNEX II</span><br>
    <span style="font-size: 14px;">TEN - YEAR SUMMARY OF SIGNIFICANT PRODUCTION RATIO AND YIELD</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>

                    <th style="text-align:center;">CROP YEAR</th>
                    <th style="text-align:center;">IMBIBITION <br>FIBER RATIO</th>
                    <th style="text-align:center;">RENDEMENT <br>(LKg/TC)</th>
                    <th style="text-align:center;">QUALITY RATIO <br>(TC/TS)</th>
                    <th style="text-align:center;">KILOGRAM <br>MOLASSES PER <br>TONNE OF CANE</th>
                    <th style="text-align:center;">KILOGRAM <br>BAGASSE PER <br>TONNE OF CANE</th>
                    <th style="text-align:center;">KILOGRAM <br>FILTERCAKE PER <br>TONNE OF CANE</th>
                </tr> 
            </thead>
            
            <tbody>
                @foreach ($collection as $key => $data)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="text-align:right;"> {{ $data['cy_name'] }}</td>
                        <td style="text-align:right;"> {{ displayData($data['imbibition_fiber_ratio']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['rendement']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['quality_ratio']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['kg_mollasses_per_ton_cane']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['kg_bagasse_per_ton_cane']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['kg_fc_per_ton_cane']) }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>