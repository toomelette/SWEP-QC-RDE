
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>PRDN Increment</title>
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
    <span style="font-size: 14px;">TABLE II.  PRODUCTION INCREMENT AND SHARING RATIO</span> 
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th rowspan="2" style="text-align:center;">SUGAR FACTORY</th>
                    <th colspan="3" style="text-align: center;">50 - KILOGRAMS RAW SUGAR MANUFACTURED</th>
                    <th rowspan="2" style="text-align: center;">PLANTERS-MILLERS <br> SHARING RATIO</th>
                </tr>  
                <tr>
                    <th style="text-align: center;">CROP YEAR <br> {{ lastCropYearName($crop_year) }}</th>
                    <th style="text-align: center;">CROP YEAR <br> {{ $crop_year }}</th>
                    <th style="text-align: center;">INCREASE / <br> DECREASE</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                    $current_cy_prod = 0;
                    $past_cy_prod = 0;
                    $increase_decrease = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                        $current_cy_prod += totalPerRegionAndField($collection, $reg_key, "current_cy_prod");
                        $past_cy_prod += totalPerRegionAndField($collection, $reg_key, "past_cy_prod");
                        $increase_decrease += totalPerRegionAndField($collection, $reg_key, "increase_decrease");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">
                                {{ $reg_data }}</td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "current_cy_prod")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "past_cy_prod")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "increase_decrease")) }}
                            </td>
                            <td></td>
                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;">{{ displayData($data->current_cy_prod) }}</td>
                                <td style="text-align:right;">{{ displayData($data->past_cy_prod) }}</td>
                                <td style="text-align:right;">{{ displayData($data->increase_decrease) }}</td>
                                <td style="text-align:right;">{{ $data->sharing_ratio }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($current_cy_prod) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($past_cy_prod) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($increase_decrease) }}</td>
                    <td></td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>