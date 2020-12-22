
@include('printables.util')

<!DOCTYPE html>
<html>

<head>
  <title>Detail of Stoppages - B</title>
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
    <span style="font-size: 14px;">TABLE XXV-B.  DETAIL OF STOPPAGES</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">
        
        <table class="table table-bordered">
        
            <thead>
                {{-- Header --}} 
                <tr>
                    <th rowspan="2" style="text-align: center;">SUGAR FACTORY</th>
                    <th rowspan="2"></th>
                    <th colspan="2" style="text-align: center;">DUE CLEANING</th>
                    <th colspan="2" style="text-align: center;">DUE NO UNAVOIDABLE</th>
                    <th colspan="2" style="text-align: center;">MISCELLANEOUS</th>
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
                    $total_due_cleaning_hrs = 0;
                    $total_due_cleaning_tet = 0;
                    $total_due_no_unavoidable_hrs = 0;
                    $total_due_no_unavoidable_tet = 0;
                    $total_due_miscellaneous_hrs = 0;
                    $total_due_miscellaneous_tet = 0;
                ?>
        
                @foreach ($regions as $reg_key => $reg_data)
                    @if (numberPerRegion($collection, $reg_key) > 0)
                        <?php
                            $total_due_cleaning_hrs += totalPerRegionAndField($collection, $reg_key, "due_cleaning_hrs");
                            $total_due_cleaning_tet += totalPerRegionAndField($collection, $reg_key, "due_cleaning_tet");
                            $total_due_no_unavoidable_hrs += totalPerRegionAndField($collection, $reg_key, "due_no_unavoidable_hrs");
                            $total_due_no_unavoidable_tet += totalPerRegionAndField($collection, $reg_key, "due_no_unavoidable_tet");
                            $total_due_miscellaneous_hrs += totalPerRegionAndField($collection, $reg_key, "due_miscellaneous_hrs");
                            $total_due_miscellaneous_tet += totalPerRegionAndField($collection, $reg_key, "due_miscellaneous_tet");
                        ?>

                        {{-- Total per mill --}}
                        <tr>
                            <td style="font-weight:bold;">{{ $reg_data }}</td>
                            <td style="font-weight:bold;">Total:</td>
                            
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_cleaning_hrs")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_cleaning_tet")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_no_unavoidable_hrs")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_no_unavoidable_tet")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_miscellaneous_hrs")) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_miscellaneous_tet")) }}
                            </td>
                        </tr>

                        {{-- Ave per mill --}}
                        <tr>
                            <td></td>
                            <td style="font-weight:bold;">Ave:</td>

                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_cleaning_hrs") / numberPerRegion($collection, $reg_key)) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_cleaning_tet") / numberPerRegion($collection, $reg_key)) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_no_unavoidable_hrs") / numberPerRegion($collection, $reg_key)) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_no_unavoidable_tet") / numberPerRegion($collection, $reg_key)) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_miscellaneous_hrs") / numberPerRegion($collection, $reg_key)) }}
                            </td>
                            <td style="font-weight:bold; text-align:right;">
                                {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_miscellaneous_tet") / numberPerRegion($collection, $reg_key)) }}
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
                                <td style="text-align:right;">{{ displayData($data->due_cleaning_hrs) }}</td>
                                <td style="text-align:right;">{{ displayData($data->due_cleaning_tet) }}</td>
                                <td style="text-align:right;">{{ displayData($data->due_no_unavoidable_hrs) }}</td>
                                <td style="text-align:right;">{{ displayData($data->due_no_unavoidable_tet) }}</td>
                                <td style="text-align:right;">{{ displayData($data->due_miscellaneous_hrs) }}</td>
                                <td style="text-align:right;">{{ displayData($data->due_miscellaneous_tet) }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                {{-- Total Country --}}
                <tr>
                    <td style="font-weight:bold;">PHILIPPINES</td>
                    <td style="font-weight:bold;">Total:</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_cleaning_hrs) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_cleaning_tet) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_no_unavoidable_hrs) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_no_unavoidable_tet) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_miscellaneous_hrs) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_miscellaneous_tet) }}</td>
                </tr>
                {{-- Ave Country --}}
                <tr>
                    <td></td>
                    <td style="font-weight:bold;">Ave:</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_cleaning_hrs / $collection->count()) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_cleaning_tet / $collection->count()) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_no_unavoidable_hrs / $collection->count()) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_no_unavoidable_tet / $collection->count()) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_miscellaneous_hrs / $collection->count()) }}</td>
                    <td style="font-weight:bold; text-align:right;">{{ displayData($total_due_miscellaneous_tet / $collection->count()) }}</td>
                </tr>
            </tbody>

        </table>
      

    </div>

  </div>

</section>

</body>

</html>