
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>BHR</title>
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
    <span style="font-size: 14px;">TABLE XVII. BOILING HOUSE</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                
                <tr>
                    <th rowspan="2" style="text-align: center;">SUGAR FACTORY</th>
                    <th rowspan="2" style="text-align: center;">MILLING LOSS</th>
                    <th colspan="5" style="text-align: center;">POL LOSSES</th>
                </tr>  
                <tr>
                    <th style="text-align: center;">BAGASSE</th>
                    <th style="text-align: center;">FILTER CAKE</th>
                    <th style="text-align: center;">FINAL MOLASSES</th>
                    <th style="text-align: center;">UNDETERMINED</th>
                    <th style="text-align: center;">TOTAL</th>
                </tr>  
            </thead>
            
            <tbody>
                <?php
                    $total_milling_loss = 0;
                    $total_bagasse = 0;
                    $total_filter_cake = 0;
                    $total_molasses = 0;
                    $total_undetermined = 0;
                    $total_total = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_milling_loss += totalPerRegionAndField($collection, $reg_key, "milling_loss");
                            $total_bagasse += totalPerRegionAndField($collection, $reg_key, "bagasse");
                            $total_filter_cake += totalPerRegionAndField($collection, $reg_key, "filter_cake");
                            $total_molasses += totalPerRegionAndField($collection, $reg_key, "molasses");
                            $total_undetermined += totalPerRegionAndField($collection, $reg_key, "undetermined");
                            $total_total += totalPerRegionAndField($collection, $reg_key, "total");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "milling_loss")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "bagasse")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "filter_cake")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "molasses")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "undetermined")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "total")) }}
                            </td>
                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;"> {{ displayData($data->milling_loss) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->bagasse) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->filter_cake) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->molasses) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->undetermined) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->total) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_milling_loss) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_bagasse) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_filter_cake) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_molasses) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_undetermined) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_total) }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>