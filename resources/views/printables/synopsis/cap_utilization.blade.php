
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>Cane Analyses</title>
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
    <span style="font-size: 14px;">TABLE IV. ANALYSES OF GROSS CANE GROUND</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">NORMAL RATE <br>CAPACITY <br>(TCD)</th>
                    <th style="text-align:center;">TONNES <br>CANE PER <br>HOUR</th>
                    <th style="text-align:center;">AVERAGE HOURS <br>ACTUAL GRINDING/ <br>HOUR</th>
                    <th style="text-align:center;">CAPACITY <br>UTILIZATION</th>
                    <th style="text-align:center;">MECHANICAL <br>TIME <br>EFFICIENCY</th>
                </tr> 
            </thead>
            
            <tbody>
                <?php
                    $total_normal_rate_cap = 0;
                    $total_tonnes_cane_per_hr = 0;
                    $total_ave_hr_actual_grinding = 0;
                    $total_cap_utilization = 0;
                    $total_mechanical_time_eff = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_normal_rate_cap += totalPerRegionAndField($collection, $reg_key, "normal_rate_cap");
                            $total_tonnes_cane_per_hr += totalPerRegionAndField($collection, $reg_key, "tonnes_cane_per_hr");
                            $total_ave_hr_actual_grinding += totalPerRegionAndField($collection, $reg_key, "ave_hr_actual_grinding");
                            $total_cap_utilization += totalPerRegionAndField($collection, $reg_key, "cap_utilization");
                            $total_mechanical_time_eff += totalPerRegionAndField($collection, $reg_key, "mechanical_time_eff");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "normal_rate_cap")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "tonnes_cane_per_hr")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "ave_hr_actual_grinding")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "cap_utilization")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "mechanical_time_eff")) }}
                            </td>
                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;">{{ displayData($data->normal_rate_cap) }}</td>
                                <td style="text-align:right;">{{ displayData($data->tonnes_cane_per_hr) }}</td>
                                <td style="text-align:right;">{{ displayData($data->ave_hr_actual_grinding) }}</td>
                                <td style="text-align:right;">{{ displayData($data->cap_utilization) }}</td>
                                <td style="text-align:right;">{{ displayData($data->mechanical_time_eff) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_normal_rate_cap) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_tonnes_cane_per_hr) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_ave_hr_actual_grinding) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_cap_utilization) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_mechanical_time_eff)  }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>