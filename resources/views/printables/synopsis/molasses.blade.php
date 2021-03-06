
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>Molasses</title>
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
    <span style="font-size: 14px;">TABLE XIII. FINAL MOLASSES</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">TONNES <br>MANUFACTURED</th>
                    <th style="text-align:center;">TONNES DUE CANE</th>
                    <th style="text-align:center;">PERCENT <br>ON CANE</th>
                    <th style="text-align:center;">BRIX</th>
                    <th style="text-align:center;">APPARENT <br>PURITY</th>
                    <th style="text-align:center;">GRAVITY <br>PURITY</th>
                    <th style="text-align:center;">PERCENT <br>ASH</th>
                    <th style="text-align:center;">PERCENT <br>REDUCING <br>SUGAR</th>
                    <th style="text-align:center;">EXPECTED <br>MOLASSES <br>PURITY</th>
                </tr> 
            </thead>
            
            <tbody>
                <?php
                    $total_tonnes_manufactured = 0;
                    $total_tonnes_due_cane = 0;
                    $total_percent_on_cane = 0;
                    $total_brix = 0;
                    $total_apparent_purity = 0;
                    $total_gravity_purity = 0;
                    $total_percent_ash = 0;
                    $total_percent_reducing_sugar = 0;
                    $total_expected_molasses_purity = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_tonnes_manufactured += totalPerRegionAndField($collection, $reg_key, "tonnes_manufactured");
                            $total_tonnes_due_cane += totalPerRegionAndField($collection, $reg_key, "tonnes_due_cane");
                            $total_percent_on_cane += totalPerRegionAndField($collection, $reg_key, "percent_on_cane");
                            $total_brix += totalPerRegionAndField($collection, $reg_key, "brix");
                            $total_apparent_purity += totalPerRegionAndField($collection, $reg_key, "apparent_purity");
                            $total_gravity_purity += totalPerRegionAndField($collection, $reg_key, "gravity_purity");
                            $total_percent_ash += totalPerRegionAndField($collection, $reg_key, "percent_ash");
                            $total_percent_reducing_sugar += totalPerRegionAndField($collection, $reg_key, "percent_reducing_sugar");
                            $total_expected_molasses_purity += totalPerRegionAndField($collection, $reg_key, "expected_molasses_purity");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "tonnes_manufactured")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "tonnes_due_cane")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_on_cane")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "brix")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "apparent_purity")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "gravity_purity")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_ash")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_reducing_sugar")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "expected_molasses_purity")) }}
                            </td>

                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;"> {{ displayData($data->tonnes_manufactured) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->tonnes_due_cane) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->percent_on_cane) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->brix) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->apparent_purity) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->gravity_purity) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->percent_ash) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->percent_reducing_sugar) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->expected_molasses_purity) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_tonnes_manufactured) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_tonnes_due_cane) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_percent_on_cane) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_brix) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_apparent_purity) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_gravity_purity) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_percent_ash) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_percent_reducing_sugar) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_expected_molasses_purity) }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>