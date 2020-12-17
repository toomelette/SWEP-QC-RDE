
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>Mixed Juice</title>
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
    <span style="font-size: 14px;">TABLE VIII. MIXED JUICE</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th rowspan="2" style="text-align: center;">SUGAR FACTORY</th>
                    <th rowspan="2" style="text-align: center;">MILLING PLANT <br>EXTRACTION <br>EQUIPMENT</th>
                    <th rowspan="2" style="text-align: center;">IMBIBITION <br>PERCENT <br>FIBER</th>
                    <th rowspan="2" style="text-align: center;">IMBIBITION <br>PERCENT <br>CANE</th>
                    <th colspan="4" style="text-align: center;">EXTRACTION</th>
                </tr>  
                <tr>
                    <th style="text-align: center;">POL</th>
                    <th style="text-align: center;">SUCROSE</th>
                    <th style="text-align: center;">REDUCED</th>
                    <th style="text-align: center;">WHOLE <br>REDUCED</th>
                </tr> 
            </thead>
            
            <tbody>
                <?php
                    $total_imbibition_percent_fiber = 0;
                    $total_imbibition_percent_cane = 0;
                    $total_pol = 0;
                    $total_sucrose = 0;
                    $total_reduced = 0;
                    $total_whole_reduced = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_imbibition_percent_fiber += totalPerRegionAndField($collection, $reg_key, "imbibition_percent_fiber");
                            $total_imbibition_percent_cane += totalPerRegionAndField($collection, $reg_key, "imbibition_percent_cane");
                            $total_pol += totalPerRegionAndField($collection, $reg_key, "pol");
                            $total_sucrose += totalPerRegionAndField($collection, $reg_key, "sucrose");
                            $total_reduced += totalPerRegionAndField($collection, $reg_key, "reduced");
                            $total_whole_reduced += totalPerRegionAndField($collection, $reg_key, "whole_reduced");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>

                            <td></td>
                            
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "imbibition_percent_fiber")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "imbibition_percent_cane")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "pol")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "sucrose")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "reduced")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "whole_reduced")) }}
                            </td>

                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;"> {{ $data->extraction_equipment }}</td>
                                <td style="text-align:right;"> {{ displayData($data->imbibition_percent_fiber) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->imbibition_percent_cane) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->pol) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->sucrose) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->reduced) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->whole_reduced) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td></td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_imbibition_percent_fiber) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_imbibition_percent_cane) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_pol) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_sucrose) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_reduced) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_whole_reduced) }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>