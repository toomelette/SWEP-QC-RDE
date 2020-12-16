
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>Non Sugar</title>
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
    <span style="font-size: 14px;">TABLE XIV. PERCENT NON-SUGAR OF END PRODUCTS & MATERIALS IN PROCESS</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">FIRST EXPRESSED <br>JUICE</th>
                    <th style="text-align:center;">LAST EXPRESSED <br>JUICE</th>
                    <th style="text-align:center;">MIXED JUICE</th>
                    <th style="text-align:center;">SYRUP</th>
                    <th style="text-align:center;">MOLASSES</th>
                    <th style="text-align:center;">SUGAR</th>
                </tr> 
            </thead>
            
            <tbody>
                <?php
                    $total_first_expressed_juice = 0;
                    $total_last_expressed_juice = 0;
                    $total_mixed_juice = 0;
                    $total_syrup = 0;
                    $total_molasses = 0;
                    $total_sugar = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_first_expressed_juice += totalPerRegionAndField($collection, $reg_key, "first_expressed_juice");
                            $total_last_expressed_juice += totalPerRegionAndField($collection, $reg_key, "last_expressed_juice");
                            $total_mixed_juice += totalPerRegionAndField($collection, $reg_key, "mixed_juice");
                            $total_syrup += totalPerRegionAndField($collection, $reg_key, "syrup");
                            $total_molasses += totalPerRegionAndField($collection, $reg_key, "molasses");
                            $total_sugar += totalPerRegionAndField($collection, $reg_key, "sugar");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "first_expressed_juice")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "last_expressed_juice")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "mixed_juice")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "syrup")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "molasses")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "sugar")) }}
                            </td>
                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;"> {{ displayData($data->first_expressed_juice) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->last_expressed_juice) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->mixed_juice) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->syrup) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->molasses) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->sugar) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_first_expressed_juice) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_last_expressed_juice) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_mixed_juice) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_syrup) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_molasses) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_sugar) }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>