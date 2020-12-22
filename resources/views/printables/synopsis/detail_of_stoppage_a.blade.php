
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>Detail of Stoppages - A</title>
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
    <span style="font-size: 14px;">TABLE XXV-A.  DETAIL OF STOPPAGES</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}} 
                <tr>
                    <th rowspan="2" style="text-align: center;">SUGAR FACTORY</th>
                    <th rowspan="2"></th>
                    <th colspan="2" style="text-align: center;">DUE FACTORY</th>
                    <th colspan="2" style="text-align: center;">DUE NO CANE</th>
                    <th colspan="2" style="text-align: center;">DUE TRANSPORT</th>
                </tr>  
                <tr>
                    <th style="text-align:center;">NO. OF HOUR</th>
                    <th style="text-align:center;">% ON TET</th>
                    <th style="text-align:center;">NO. OF HOUR</th>
                    <th style="text-align:center;">% ON TET</th>
                    <th style="text-align:center;">NO. OF HOUR</th>
                    <th style="text-align:center;">% ON TET</th>
                </tr> 
            </thead>
            
            <tbody>
                <?php
                    $total_due_factory_hrs = 0;
                    $total_due_factory_tet = 0;
                    $total_due_no_cane_hrs = 0;
                    $total_due_no_cane_tet = 0;
                    $total_due_transport_hrs = 0;
                    $total_due_transport_tet = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_due_factory_hrs += totalPerRegionAndField($collection, $reg_key, "due_factory_hrs");
                            $total_due_factory_tet += totalPerRegionAndField($collection, $reg_key, "due_factory_tet");
                            $total_due_no_cane_hrs += totalPerRegionAndField($collection, $reg_key, "due_no_cane_hrs");
                            $total_due_no_cane_tet += totalPerRegionAndField($collection, $reg_key, "due_no_cane_tet");
                            $total_due_transport_hrs += totalPerRegionAndField($collection, $reg_key, "due_transport_hrs");
                            $total_due_transport_tet += totalPerRegionAndField($collection, $reg_key, "due_transport_tet");
                        ?>

                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>
                            <td style="font-weight:bold;">Total:</td>
                            
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_factory_hrs")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_factory_tet")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_no_cane_hrs")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_no_cane_tet")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_transport_hrs")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_transport_tet")) }}
                            </td>
                        </tr>

                        {{-- Ave per mill --}}
                        <tr>
                            <td></td>
                            <td style="font-weight:bold;">Ave:</td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_factory_hrs") / numberPerRegion($collection, $reg_key)) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_factory_tet") / numberPerRegion($collection, $reg_key)) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_no_cane_hrs") / numberPerRegion($collection, $reg_key)) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_no_cane_tet") / numberPerRegion($collection, $reg_key)) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_transport_hrs") / numberPerRegion($collection, $reg_key)) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_transport_tet") / numberPerRegion($collection, $reg_key)) }}
                            </td>
                        </tr>

                    @endif
                    <?php $mill_no = 0; ?>
                    @foreach ($collection as $key => $data)
                        @if($data->mill->report_region == $reg_key)
                            {{-- Data per mill --}}
                            <tr>
                                <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                                <td></td>
                                <td style="text-align:right;">{{ displayData($data->due_factory_hrs) }}</td>
                                <td style="text-align:right;">{{ displayData($data->due_factory_tet) }}</td>
                                <td style="text-align:right;">{{ displayData($data->due_no_cane_hrs) }}</td>
                                <td style="text-align:right;">{{ displayData($data->due_no_cane_tet) }}</td>
                                <td style="text-align:right;">{{ displayData($data->due_transport_hrs) }}</td>
                                <td style="text-align:right;">{{ displayData($data->due_transport_tet) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">Total:</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_factory_hrs) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_factory_tet) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_no_cane_hrs) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_no_cane_tet) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_transport_hrs) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_transport_tet) }}</td>
                </tr>
                {{-- Ave Country --}}
                <tr>
                    <td></td>
                    <td style="font-weight:bold;">Ave:</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_factory_hrs / $collection->count()) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_factory_tet / $collection->count()) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_no_cane_hrs / $collection->count()) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_no_cane_tet / $collection->count()) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_transport_hrs / $collection->count()) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_transport_tet / $collection->count()) }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>