
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>TEN - YEAR SUMMARY OF FACTORY PERFORMANCE</title>
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
    <span style="font-size: 14px;">ANNEX III</span><br>
    <span style="font-size: 14px;">TEN - YEAR SUMMARY OF FACTORY PERFORMANCE</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th style="text-align:center;">CROP YEAR</th>
                    <th style="text-align:center;">RATED CAPACITY <br>(TCD)</th>
                    <th style="text-align:center;">CAPACITY <br>UTILIZATION <br> (%)</th>
                    <th style="text-align:center;">POL EXTRACTION <br> (%)</th>
                    <th style="text-align:center;">ACTUAL BOILING <br>HOUSE RECOVERY <br> (%)</th>
                    <th style="text-align:center;">REDUCED <br>OVERALL <br>RECOVERY, ESG <br> (%)</th>
                    <th style="text-align:center;">AVERAGE NUMBER <br>OF GRINDING DAYS</th>
                </tr> 
            </thead>
            
            <tbody>
                @foreach ($collection as $key => $data)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="text-align:right;"> {{ $data['cy_name'] }}</td>
                        <td style="text-align:right;"> {{ displayData($data['rated_capacity']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['cap_utilization']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['pol_extraction']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['actual_bhr']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['reduced_overall_recovery']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['ave_num_of_grinding']) }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>