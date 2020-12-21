
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="6" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="6" style="text-align: center;">
        TABLE XXIV.  HOURS ACTUAL GRINDING ; TOTAL DELAYS AND STOPPAGES
      </td>
    </tr>
      
    <tr>
      <td colspan="6"></td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th rowspan="2" style="font-size:10px; width:40px; text-align: center;">SUGAR FACTORY</th>
            <th rowspan="2"></th>
            <th colspan="2" style="font-size:10px; width:40px; text-align: center;">ACTUAL GRINDING</th>
            <th colspan="2" style="font-size:10px; width:50px; text-align: center;">TOTAL DELAYS &amp; STOPPAGES</th>
        </tr>  
        <tr>
            <th style="font-size:10px; text-align:center; width:20px;">NO. OF HOUR</th>
            <th style="font-size:10px; text-align:center; width:20px;">% ON TET</th>
            <th style="font-size:10px; text-align:center; width:25px;">NO. OF HOUR</th>
            <th style="font-size:10px; text-align:center; width:25px;">% ON TET</th>
        </tr>   
    </thead>
    <tbody>

        <?php
            $total_actual_grind_hrs = 0;
            $total_actual_grind_tet = 0;
            $total_total_delays_hrs = 0;
            $total_total_delays_tet = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)

                <?php
                    $total_actual_grind_hrs += totalPerRegionAndField($collection, $reg_key, "actual_grind_hrs");
                    $total_actual_grind_tet += totalPerRegionAndField($collection, $reg_key, "actual_grind_tet");
                    $total_total_delays_hrs += totalPerRegionAndField($collection, $reg_key, "total_delays_hrs");
                    $total_total_delays_tet += totalPerRegionAndField($collection, $reg_key, "total_delays_tet");
                ?>

                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>
                    <td style="font-size:10px; font-weight:bold;">Total:</td>
                    
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "actual_grind_hrs")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "actual_grind_tet")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "total_delays_hrs")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "total_delays_tet")) }}
                    </td>
                </tr>

                {{-- Ave per mill --}}
                <tr>
                    <td></td>
                    <td style="font-size:10px; font-weight:bold;">Ave:</td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "actual_grind_hrs") / numberPerRegion($collection, $reg_key)) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "actual_grind_tet") / numberPerRegion($collection, $reg_key)) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "total_delays_hrs") / numberPerRegion($collection, $reg_key)) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "total_delays_tet") / numberPerRegion($collection, $reg_key)) }}
                    </td>
                </tr>

            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="font-size:10px;">{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td></td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->actual_grind_hrs) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->actual_grind_tet) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->total_delays_hrs) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->total_delays_tet) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold;">Total:</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_actual_grind_hrs) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_actual_grind_tet) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_total_delays_hrs) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_total_delays_tet) }}</td>
        </tr>
        {{-- Ave Country --}}
        <tr>
            <td></td>
            <td style="font-size:10px; font-weight:bold;">Ave:</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_actual_grind_hrs / $collection->count()) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_actual_grind_tet / $collection->count()) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_total_delays_hrs / $collection->count()) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_total_delays_tet / $collection->count()) }}</td>
        </tr>
    </tbody>
</table>