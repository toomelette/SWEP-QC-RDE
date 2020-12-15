
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>Clarification</title>
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
    <span style="font-size: 14px;">TABLE IX. CLARIFICATION DATA</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th rowspan="2" style="text-align: center;">SUGAR FACTORY</th>
                    <th colspan="4" style="text-align: center;">CLARIFIED JUICE</th>
                    <th colspan="3" style="text-align: center;">LIME</th>
                </tr>  
                <tr>
                    <th style="text-align: center;">APPARENT <br>PURITY</th>
                    <th style="text-align: center;">BRIX</th>
                    <th style="text-align: center;">pH</th>
                    <th style="text-align: center;">CLARITY</th>
                    <th style="text-align: center;">TONNES <br>USED</th>
                    <th style="text-align: center;">% CAO</th>
                    <th style="text-align: center;">Kg CAO <br>PER TC</th>
                </tr> 
            </thead>
            
            <tbody>
                <?php
                    $total_juice_apparent_purity = 0;
                    $total_juice_brix = 0;
                    $total_juice_ph = 0;
                    $total_juice_clarity = 0;
                    $total_lime_tonnes_used = 0;
                    $total_lime_cao = 0;
                    $total_lime_cao_per_tc = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_juice_apparent_purity += totalPerRegionAndField($collection, $reg_key, "juice_apparent_purity");
                            $total_juice_brix += totalPerRegionAndField($collection, $reg_key, "juice_brix");
                            $total_juice_ph += totalPerRegionAndField($collection, $reg_key, "juice_ph");
                            $total_juice_clarity += totalPerRegionAndField($collection, $reg_key, "juice_clarity");
                            $total_lime_tonnes_used += totalPerRegionAndField($collection, $reg_key, "lime_tonnes_used");
                            $total_lime_cao += totalPerRegionAndField($collection, $reg_key, "lime_cao");
                            $total_lime_cao_per_tc += totalPerRegionAndField($collection, $reg_key, "lime_cao_per_tc");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "juice_apparent_purity")) }}
                            </td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "juice_brix")) }}
                            </td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "juice_ph")) }}
                            </td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "juice_clarity")) }}
                            </td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "lime_tonnes_used")) }}
                            </td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "lime_cao")) }}
                            </td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "lime_cao_per_tc")) }}
                            </td>

                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;">{{ displayData($data->juice_apparent_purity) }}</td>
                                <td style="text-align:right;">{{ displayData($data->juice_brix) }}</td>
                                <td style="text-align:right;">{{ displayData($data->juice_ph) }}</td>
                                <td style="text-align:right;">{{ displayData($data->juice_clarity) }}</td>
                                <td style="text-align:right;">{{ displayData($data->lime_tonnes_used) }}</td>
                                <td style="text-align:right;">{{ displayData($data->lime_cao) }}</td>
                                <td style="text-align:right;">{{ displayData($data->lime_cao_per_tc) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_juice_apparent_purity) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_juice_brix) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_juice_ph) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_juice_clarity) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_lime_tonnes_used) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_lime_cao) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_lime_cao_per_tc) }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>