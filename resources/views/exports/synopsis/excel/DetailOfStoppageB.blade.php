
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="8" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="8" style="text-align: center;">
        TABLE XXV-B. DETAIL OF STOPPAGES
      </td>
    </tr>
      
    <tr>
      <td colspan="8"></td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th rowspan="2" style="font-size:10px; width:40px; text-align: center;">SUGAR FACTORY</th>
            <th rowspan="2"></th>
            <th colspan="2" style="font-size:10px; width:40px; text-align: center;">DUE CLEANING</th>
            <th colspan="2" style="font-size:10px; width:50px; text-align: center;">DUE NO UNAVOIDABLE</th>
            <th colspan="2" style="font-size:10px; width:40px; text-align: center;">MISCELLANEOUS</th>
        </tr>  
        <tr>
            <th style="font-size:10px; text-align:center; width:20px;">NO. OF HOUR</th>
            <th style="font-size:10px; text-align:center; width:20px;">% ON TET</th>
            <th style="font-size:10px; text-align:center; width:25px;">NO. OF HOUR</th>
            <th style="font-size:10px; text-align:center; width:25px;">% ON TET</th>
            <th style="font-size:10px; text-align:center; width:25px;">NO. OF HOUR</th>
            <th style="font-size:10px; text-align:center; width:25px;">% ON TET</th>
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
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>
                    <td style="font-size:10px; font-weight:bold;">Total:</td>
                    
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_cleaning_hrs")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_cleaning_tet")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_no_unavoidable_hrs")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_no_unavoidable_tet")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_miscellaneous_hrs")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_miscellaneous_tet")) }}
                    </td>
                </tr>

                {{-- Ave per mill --}}
                <tr>
                    <td></td>
                    <td style="font-size:10px; font-weight:bold;">Ave:</td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_cleaning_hrs") / numberPerRegion($collection, $reg_key)) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_cleaning_tet") / numberPerRegion($collection, $reg_key)) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_no_unavoidable_hrs") / numberPerRegion($collection, $reg_key)) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_no_unavoidable_tet") / numberPerRegion($collection, $reg_key)) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_miscellaneous_hrs") / numberPerRegion($collection, $reg_key)) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_miscellaneous_tet") / numberPerRegion($collection, $reg_key)) }}
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
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->due_cleaning_hrs) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->due_cleaning_tet) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->due_no_unavoidable_hrs) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->due_no_unavoidable_tet) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->due_miscellaneous_hrs) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->due_miscellaneous_tet) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold;">Total:</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_cleaning_hrs) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_cleaning_tet) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_no_unavoidable_hrs) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_no_unavoidable_tet) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_miscellaneous_hrs) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_miscellaneous_tet) }}</td>
        </tr>
        {{-- Ave Country --}}
        <tr>
            <td></td>
            <td style="font-size:10px; font-weight:bold;">Ave:</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_cleaning_hrs / $collection->count()) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_cleaning_tet / $collection->count()) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_no_unavoidable_hrs / $collection->count()) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_no_unavoidable_tet / $collection->count()) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_miscellaneous_hrs / $collection->count()) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_miscellaneous_tet / $collection->count()) }}</td>
        </tr>
    </tbody>
</table>