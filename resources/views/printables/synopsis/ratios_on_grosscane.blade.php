<?php


    function totalPerRegionAndField($collection, $region, $field){
        $total = 0;
        if (!empty($collection)) {
            foreach ($collection as $key => $data) {
                if ($data->mill->report_region == $region) {
                    $total += $data[$field];
                }
            }
        }
        return $total;
    }


    function numberPerRegion($collection, $region){
        $num = 0;
        if (!empty($collection)) {
            foreach ($collection as $data) {
                if ($data->mill->report_region == $region) {
                    $num++;
                }
            }
        }
        return $num;
    }


    function displayData($float){
        $data = 'NA';
        if (!$float == 0) {
            $data = number_format($float, 2);
        }
        return $data;
    }


    function lastCropYearName($crop_year){
        $last_cy = explode(" - ", $crop_year);
        $last_cy[0] = intval($last_cy[0]) - 1;
        $last_cy[1] = intval($last_cy[1]) - 1;
        $last_cy = implode("-", $last_cy);
        return $last_cy;
    }


?>

<!DOCTYPE html>
<html>

<head>
  <title>Ratios On Gross Cane</title>
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
    <span style="font-size: 14px;">TABLE III. RATIOS ON GROSS CANE GROUND</span> 
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th style="text-align: center;">SUGAR FACTORY</th>
                    <th style="text-align: center;">Burnt Cane Percent <br> Gross Cane</th>
                    <th style="text-align: center;">Quality Ratio <br> TC/TS</th>
                    <th style="text-align: center;">Rendement <br> Lkg/TC</th>
                    <th style="text-align: center;">Total Sugar <br> Recovered  %Cane </th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                    $burnt_cane_percent = 0;
                    $quality_ratio = 0;
                    $rendement = 0;
                    $total_sugar_recovered = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $burnt_cane_percent += totalPerRegionAndField($collection, $reg_key, "burnt_cane_percent");
                            $quality_ratio += totalPerRegionAndField($collection, $reg_key, "quality_ratio");
                            $rendement += totalPerRegionAndField($collection, $reg_key, "rendement");
                            $total_sugar_recovered += totalPerRegionAndField($collection, $reg_key, "total_sugar_recovered");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "burnt_cane_percent")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "quality_ratio")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "rendement")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "total_sugar_recovered")) }}
                            </td>
                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;">{{ displayData($data->burnt_cane_percent) }}</td>
                                <td style="text-align:right;">{{ displayData($data->quality_ratio) }}</td>
                                <td style="text-align:right;">{{ displayData($data->rendement) }}</td>
                                <td style="text-align:right;">{{ displayData($data->total_sugar_recovered) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($burnt_cane_percent) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($quality_ratio) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($rendement) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_sugar_recovered) }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>