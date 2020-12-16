
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>Bagasse</title>
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
    <span style="font-size: 14px;">TABLE XI. BAGASSE</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">TONNES</th>
                    <th style="text-align:center;">PERCENT <br>ON CANE</th>
                    <th style="text-align:center;">PERCENT <br>POL</th>
                    <th style="text-align:center;">PERCENT <br>MOISTURE</th>
                    <th style="text-align:center;">PERCENT <br>FIBER</th>
                    <th style="text-align:center;">CALORIFIC VALUE <br>(Kcal/Kg)</th>
                </tr> 
            </thead>
            
            <tbody>
                <?php
                    $total_tonnes = 0;
                    $total_percent_on_cane = 0;
                    $total_percent_pol = 0;
                    $total_percent_moisture = 0;
                    $total_percent_fiber = 0;
                    $total_calorific_value = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_tonnes += totalPerRegionAndField($collection, $reg_key, "tonnes");
                            $total_percent_on_cane += totalPerRegionAndField($collection, $reg_key, "percent_on_cane");
                            $total_percent_pol += totalPerRegionAndField($collection, $reg_key, "percent_pol");
                            $total_percent_moisture += totalPerRegionAndField($collection, $reg_key, "percent_moisture");
                            $total_percent_fiber += totalPerRegionAndField($collection, $reg_key, "percent_fiber");
                            $total_calorific_value += totalPerRegionAndField($collection, $reg_key, "calorific_value");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "tonnes")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_on_cane")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_pol")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_moisture")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_fiber")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "calorific_value")) }}
                            </td>
                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;"> {{ displayData($data->tonnes) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->percent_on_cane) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->percent_pol) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->percent_moisture) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->percent_fiber) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->calorific_value) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_tonnes) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_percent_on_cane) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_percent_pol) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_percent_moisture) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_percent_fiber) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_calorific_value) }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>