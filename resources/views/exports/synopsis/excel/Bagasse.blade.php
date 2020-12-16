
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="7" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="7" style="text-align: center;">
        TABLE XI. BAGASSE
      </td>
    </tr>
      
    <tr>
      <td colspan="7">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="font-size:10px; width:40px; text-align:center;">SUGAR FACTORY</th>
            <th style="font-size:10px; width:15px; text-align:center;">TONNES</th>
            <th style="font-size:10px; width:15px; text-align:center;">PERCENT <br>ON CANE</th>
            <th style="font-size:10px; width:15px; text-align:center;">PERCENT <br>POL</th>
            <th style="font-size:10px; width:15px; text-align:center;">PERCENT <br>MOISTURE</th>
            <th style="font-size:10px; width:15px; text-align:center;">PERCENT <br>FIBER</th>
            <th style="font-size:10px; width:15px; text-align:center;">CALORIFIC VALUE <br>(Kcal/Kg)</th>
        </tr> 
    </thead>
    <tbody>

        <?php
            $total_tonnes = 0;
            $total_percent_on_cane = 0;
            $total_percent_pol = 0;
            $total_percent_moisture = 0;
            $total_percent_fiber = 0;
            $total_calorific_value = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_tonnes += totalPerRegionAndField($collection, $reg_key, "tonnes");
                    $total_percent_on_cane += totalPerRegionAndField($collection, $reg_key, "percent_on_cane");
                    $total_percent_pol += totalPerRegionAndField($collection, $reg_key, "percent_pol");
                    $total_percent_moisture += totalPerRegionAndField($collection, $reg_key, "percent_moisture");
                    $total_percent_fiber += totalPerRegionAndField($collection, $reg_key, "percent_fiber");
                    $total_calorific_value += totalPerRegionAndField($collection, $reg_key, "calorific_value");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "tonnes")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_on_cane")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_pol")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_moisture")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_fiber")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "calorific_value")) }}
                    </td>
                </tr>
            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="font-size:10px;">{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->tonnes) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->percent_on_cane) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->percent_pol) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->percent_moisture) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->percent_fiber) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->calorific_value) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_tonnes) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_on_cane) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_pol) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_moisture) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_fiber) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_calorific_value) }}</td>
        </tr>
    </tbody>
</table>