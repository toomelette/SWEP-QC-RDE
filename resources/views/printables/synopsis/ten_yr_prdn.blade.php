
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>TEN - YEAR SUMMARY OF PRODUCTION DATA</title>
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
    <span style="font-size: 14px;">ANNEX I</span><br>
    <span style="font-size: 14px;">TEN - YEAR SUMMARY OF PRODUCTION DATA</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th style="text-align:center;">CROP YEAR</th>
                    <th style="text-align:center;">GROSS CANE <br>MILLED</th>
                    <th style="text-align:center;">RAW SUGAR <br>MANUFACTURED</th>
                    <th style="text-align:center;">MOLASSES DUE <br>CANE</th>
                    <th style="text-align:center;">BAGASSE</th>
                    <th style="text-align:center;">FILTER CAKE</th>
                </tr> 
            </thead>
            
            <tbody>
                @foreach ($collection as $key => $data)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="text-align:right;"> {{ $data['cy_name'] }}</td>
                        <td style="text-align:right;"> {{ displayData($data['gross_cane_milled']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['raw_sugar_man']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['molasses_due_cane']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['bagasse']) }}</td>
                        <td style="text-align:right;"> {{ displayData($data['filter_cake']) }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>