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


?>

<!DOCTYPE html>
<html>

<head>
  <title>Cane-Sugar Tons</title>
  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/dist/css/skins/_all-skins.min.css') }}">
</head>

<body onload="window.print();" onafterprint="window.close()" style="font-size: 11px;">

<section class="invoice">

  {{-- HEADER --}}
  <div class="row" style="padding:11px; text-align: center;">
    <span style="font-size: 14px;">CANE-SUGAR TONS</span><br>
    <span style="font-size: 14px;">CY {{ $crop_year }}</span>  
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th rowspan="2" style="text-align:center;">SUGAR FACTORY</th>
                    <th colspan="2" style="text-align: center;">SUGARCANE</th>
                    <th colspan="3" style="text-align: center;">RAW SUGAR</th>
                </tr>  
                <tr>
                    <th>GROSS TONNES</th>
                    <th>NET TONNES</th>
                    <th>TONNES DUE CANE</th>
                    <th>TONNES MANUFACTURED</th>
                    <th>EQUIVALENT (50-Kg Bag)</th>
                </tr> 
            </thead>
            
            <tbody>
                <?php
                    $total_sgrcane_gross_tonnes = 0;
                    $total_sgrcane_net_tonnes = 0;
                    $total_rawsgr_tonnes_due_cane = 0;
                    $total_rawsgr_tonnes_manufactured = 0;
                    $total_equivalent = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_sgrcane_gross_tonnes += totalPerRegionAndField($collection, $reg_key, "sgrcane_gross_tonnes");
                            $total_sgrcane_net_tonnes += totalPerRegionAndField($collection, $reg_key, "sgrcane_net_tonnes");
                            $total_rawsgr_tonnes_due_cane += totalPerRegionAndField($collection, $reg_key, "rawsgr_tonnes_due_cane");
                            $total_rawsgr_tonnes_manufactured += totalPerRegionAndField($collection, $reg_key, "rawsgr_tonnes_manufactured");
                            $total_equivalent += totalPerRegionAndField($collection, $reg_key, "equivalent");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">
                                {{ $reg_data }}</td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "sgrcane_gross_tonnes")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "sgrcane_net_tonnes")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "rawsgr_tonnes_due_cane")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "rawsgr_tonnes_manufactured")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "equivalent")) }}
                            </td>
                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;">{{ displayData($data->sgrcane_gross_tonnes) }}</td>
                                <td style="text-align:right;">{{ displayData($data->sgrcane_net_tonnes) }}</td>
                                <td style="text-align:right;">{{ displayData($data->rawsgr_tonnes_due_cane) }}</td>
                                <td style="text-align:right;">{{ displayData($data->rawsgr_tonnes_manufactured) }}</td>
                                <td style="text-align:right;">{{ displayData($data->equivalent) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_sgrcane_gross_tonnes) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_sgrcane_net_tonnes) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_rawsgr_tonnes_due_cane) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_rawsgr_tonnes_manufactured) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_equivalent)  }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>