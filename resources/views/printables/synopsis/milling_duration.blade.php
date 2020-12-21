
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>Milling Duration</title>
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
    <span style="font-size: 14px;">TABLE XXIII. MILLING DURATION</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th style="text-align: center;">SUGAR FACTORY</th>
                    <th style="text-align: center;">MILLING STARTED</th>
                    <th style="text-align: center;">MILLING ENDED</th>
                    <th>&nbsp;</th>
                    <th style="text-align: center;">CROP LENGTH</th>
                    <th style="text-align: center;">TOTAL ELAPSED TIME (TET) <br> (HOURS)</th>
                </tr>  
            </thead>
            
            <tbody>

                <?php
                    $total_crop_length = 0;
                    $total_tet = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                    
                        <?php
                            $total_crop_length += totalPerRegionAndField($collection, $reg_key, "crop_length");
                            $total_tet += totalPerRegionAndField($collection, $reg_key, "tet");
                        ?>

                        {{-- Total per mill --}}
                        <tr>
                            
                            <td style="font-weight:bold;">{{ $reg_data }}</td>

                            <td></td>

                            <td></td>

                            <td style="font-weight:bold; text-align:right;">Total:</td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "crop_length")) }}
                            </td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "tet")) }}
                            </td>

                        </tr>

                        {{-- Average per mill --}}
                        <tr>
                            
                            <td></td>

                            <td></td>

                            <td></td>

                            <td style="font-weight:bold; text-align:right;">Ave:</td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "crop_length") / numberPerRegion($collection, $reg_key)) }}
                            </td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "tet") / numberPerRegion($collection, $reg_key)) }}
                            </td>

                        </tr>

                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td style="text-align:right;"> {{ __dataType::date_parse($data->mill_start, 'm/d/Y') }}</td>
                        <td style="text-align:right;"> {{ __dataType::date_parse($data->mill_end, 'm/d/Y') }}</td>
                        <td></td>
                        <td style="text-align:right;"> {{ displayData($data->crop_length) }}</td>
                        <td style="text-align:right;"> {{ displayData($data->tet) }}</td>
                    </tr>
                        @endif
                    @endforeach
                @endforeach

                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td></td>
                    <td></td>
                    <td style="font-weight:bold; text-align:right;">Total:</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_crop_length) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_tet) }}</td>
                </tr>
        
                {{-- Average Country --}}
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="font-weight:bold; text-align:right;">Ave:</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_crop_length / $collection->count()) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_tet / $collection->count()) }}</td>
                </tr>

            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>