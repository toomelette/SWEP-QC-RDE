
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>OAR</title>
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
    <span style="font-size: 14px;">TABLE XVIII. OVERALL RECOVERIES</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">ACTUAL <br>BOILING HOUSE <br>RECOVERY</th>
                    <th style="text-align:center;">STANDARD <br>BOILING HOUSE <br>RECOVERY</th>
                    <th style="text-align:center;">REDUCED <br>BOILING HOUSE <br>RECOVERY, ESG</th>
                </tr> 
            </thead>
            
            <tbody>
                <?php
                    $total_actual_oar = 0;
                    $total_standard_oar = 0;
                    $total_reduced_oar = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_actual_oar += totalPerRegionAndField($collection, $reg_key, "actual_oar");
                            $total_standard_oar += totalPerRegionAndField($collection, $reg_key, "standard_oar");
                            $total_reduced_oar += totalPerRegionAndField($collection, $reg_key, "reduced_oar");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "actual_oar")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "standard_oar")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "reduced_oar")) }}
                            </td>
                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;"> {{ displayData($data->actual_oar) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->standard_oar) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->reduced_oar) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_actual_oar) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_standard_oar) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_reduced_oar) }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>