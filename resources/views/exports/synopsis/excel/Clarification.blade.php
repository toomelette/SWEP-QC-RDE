
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="8" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="8" style="text-align: center;">
        TABLE IX. CLARIFICATION DATA
      </td>
    </tr>
      
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th rowspan="2" style="font-size:10px; text-align:center; width:40px;">SUGAR FACTORY</th>
            <th colspan="4" style="font-size:10px; text-align:center;">CLARIFIED JUICE</th>
            <th colspan="3" style="font-size:10px; text-align:center;">LIME</th>
        </tr>  
        <tr>
            <th style="font-size:10px; width:15px; text-align:center;">APPARENT <br>PURITY</th>
            <th style="font-size:10px; width:15px; text-align:center;">BRIX</th>
            <th style="font-size:10px; width:15px; text-align:center;">pH</th>
            <th style="font-size:10px; width:15px; text-align:center;">CLARITY</th>
            <th style="font-size:10px; width:15px; text-align:center;">TONNES <br>USED</th>
            <th style="font-size:10px; width:15px; text-align:center;">% CAO</th>
            <th style="font-size:10px; width:15px; text-align:center;">Kg CAO <br>PER TC</th>
        </tr> 
    </thead>
    <tbody>

        <?php
            $total_juice_apparent_purity = 0;
            $total_juice_brix = 0;
            $total_juice_ph = 0;
            $total_juice_clarity = 0;
            $total_lime_tonnes_used = 0;
            $total_lime_cao = 0;
            $total_lime_cao_per_tc = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_juice_apparent_purity += totalPerRegionAndField($collection, $reg_key, "juice_apparent_purity");
                    $total_juice_brix += totalPerRegionAndField($collection, $reg_key, "juice_brix");
                    $total_juice_ph += totalPerRegionAndField($collection, $reg_key, "juice_ph");
                    $total_juice_clarity += totalPerRegionAndField($collection, $reg_key, "juice_clarity");
                    $total_lime_tonnes_used += totalPerRegionAndField($collection, $reg_key, "lime_tonnes_used");
                    $total_lime_cao += totalPerRegionAndField($collection, $reg_key, "lime_cao");
                    $total_lime_cao_per_tc += totalPerRegionAndField($collection, $reg_key, "lime_cao_per_tc");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "juice_apparent_purity")) }}
                    </td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "juice_brix")) }}
                    </td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "juice_ph")) }}
                    </td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "juice_clarity")) }}
                    </td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "lime_tonnes_used")) }}
                    </td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "lime_cao")) }}
                    </td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "lime_cao_per_tc")) }}
                    </td>

                </tr>
            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="font-size:10px;">{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->juice_apparent_purity) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->juice_brix) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->juice_ph) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->juice_clarity) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->lime_tonnes_used) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->lime_cao) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->lime_cao_per_tc) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_juice_apparent_purity) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_juice_brix) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_juice_ph) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_juice_clarity) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_lime_tonnes_used) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_lime_cao) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_lime_cao_per_tc) }}</td>
        </tr>
    </tbody>
</table>