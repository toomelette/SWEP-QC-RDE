
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>Kgs of Sugar Due Clean Cane</title>
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
    <span style="font-size: 14px;">TABLE XXI. ADDITIONAL KILOS SUGAR DUE CLEAN CANE</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th style="width:40px; text-align:center;">SUGAR FACTORY</th>
                    <th style="width:20px; text-align:center;">TRASH PERCENT <br>CANE</th>
                    <th style="width:20px; text-align:center;">PERCENT <br>RECOVERY</th>
                    <th style="width:20px; text-align:center;">RECOVERABLE KILOS SUGAR<br> DUE FIBROUS TRASH AND <br>INCREASED EFFICIENCY</th>
                </tr>  
            </thead>
            
            <tbody>
                <?php
                    $total_trash_percent_cane = 0;
                    $total_percent_recovery = 0;
                    $total_recoverable = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_trash_percent_cane += totalPerRegionAndField($collection, $reg_key, "trash_percent_cane");
                            $total_percent_recovery += totalPerRegionAndField($collection, $reg_key, "percent_recovery");
                            $total_recoverable += totalPerRegionAndField($collection, $reg_key, "recoverable");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "trash_percent_cane")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_recovery")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "recoverable")) }}
                            </td>
                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;"> {{ displayData($data->trash_percent_cane) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->percent_recovery) }}</td>
                                <td style="text-align:right;"> {{ displayData($data->recoverable) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_trash_percent_cane) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_percent_recovery) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_recoverable) }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>