
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="4" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="4" style="text-align: center;">
        TABLE XX. ADDITIONAL KILOS OF SUGAR DUE MILL AND BOILING HOUSE
      </td>
    </tr>
      
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="font-size:10px; width:40px; text-align:center;">SUGAR FACTORY</th>
            <th style="font-size:10px; width:20px; text-align:center;">STANDARD OVERALL <br>RECOVERY</th>
            <th style="font-size:10px; width:20px; text-align:center;">ACTUAL OVERALL <br>RECOVERY</th>
            <th style="font-size:10px; width:20px; text-align:center;">ADDITIONAL KILOS <br>OF SUGAR</th>
        </tr>  
    </thead>
    <tbody>

        <?php
            $total_standard_oar = 0;
            $total_actual_oar = 0;
            $total_additional_kg_sugar = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_standard_oar += totalPerRegionAndField($collection, $reg_key, "standard_oar");
                    $total_actual_oar += totalPerRegionAndField($collection, $reg_key, "actual_oar");
                    $total_additional_kg_sugar += totalPerRegionAndField($collection, $reg_key, "additional_kg_sugar");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "standard_oar")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "actual_oar")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "additional_kg_sugar")) }}
                    </td>
                </tr>
            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="font-size:10px;">{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->standard_oar) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->actual_oar) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->additional_kg_sugar) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_standard_oar) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_actual_oar) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_additional_kg_sugar) }}</td>
        </tr>
    </tbody>
</table>