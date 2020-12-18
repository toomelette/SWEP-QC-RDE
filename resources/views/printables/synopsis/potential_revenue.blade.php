
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>Potential Revenue</title>
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
    <span style="font-size: 14px;">TABLE XXII. POTENTIAL REVENUE DIFFERENTIAL DUE INCREASED EFFICIENCY</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}}
                <tr>
                    <th style="text-align:center;">SUGAR FACTORY</th>
                    <th style="text-align:center;">DUE MILL AND <br>BOILING HOUSE</th>
                    <th style="text-align:center;">DUE TRASH</th>
                    <th style="text-align:center;">TOTAL</th>
                    <th style="text-align:center;">POTENTIAL REVENUE <br> (PESO)</th>
                </tr> 
            </thead>
            
            <tbody>
                <?php
                    $total_due_bh = 0;
                    $total_due_trash = 0;
                    $total_total = 0;
                    $total_potential_revenue = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_due_bh += totalPerRegionAndField($collection, $reg_key, "due_bh");
                            $total_due_trash += totalPerRegionAndField($collection, $reg_key, "due_trash");
                            $total_total += totalPerRegionAndField($collection, $reg_key, "total");
                            $total_potential_revenue += totalPerRegionAndField($collection, $reg_key, "potential_revenue");
                        ?>
                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>
                    
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_bh")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_trash")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "total")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "potential_revenue")) }}
                            </td>
                        </tr>
                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td style="text-align:right;">{{ displayData($data->due_bh) }}</td>
                                <td style="text-align:right;">{{ displayData($data->due_trash) }}</td>
                                <td style="text-align:right;">{{ displayData($data->total) }}</td>
                                <td style="text-align:right;">{{ displayData($data->potential_revenue) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_bh) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_trash) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_total) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_potential_revenue) }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>