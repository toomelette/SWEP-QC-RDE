
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="9" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="9" style="text-align: center;">
        TABLE V. ANALYSES OF RAW SUGAR MANUFACTURED
      </td>
    </tr>
      
    <tr>
      <td colspan="9">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:40px;">SUGAR FACTORY</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">GRAVITY <br>PURITY</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">APPARENT <br>PURITY</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">PERCENT <br>POL</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">PERCENT <br>SUCROSE</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">PERCENT <br>MOISTURE</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">DI</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">CLARITY/ <br>TURBIDITY</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">PERCENT <br>ASH</th>
        </tr> 
    </thead>
    <tbody>

        <?php
            $total_gravity_purity = 0;
            $total_apparent_purity = 0;
            $total_percent_pol = 0;
            $total_percent_sucrose = 0;
            $total_percent_moisture = 0;
            $total_di = 0;
            $total_clarity_turbidity = 0;
            $total_percent_ash = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_gravity_purity += totalPerRegionAndField($collection, $reg_key, "gravity_purity");
                    $total_apparent_purity += totalPerRegionAndField($collection, $reg_key, "apparent_purity");
                    $total_percent_pol += totalPerRegionAndField($collection, $reg_key, "percent_pol");
                    $total_percent_sucrose += totalPerRegionAndField($collection, $reg_key, "percent_sucrose");
                    $total_percent_moisture += totalPerRegionAndField($collection, $reg_key, "percent_moisture");
                    $total_di += totalPerRegionAndField($collection, $reg_key, "di");
                    $total_clarity_turbidity += totalPerRegionAndField($collection, $reg_key, "clarity_turbidity");
                    $total_percent_ash += totalPerRegionAndField($collection, $reg_key, "percent_ash");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">
                        {{ $reg_data }}</td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "gravity_purity")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "apparent_purity")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_pol")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_sucrose")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_moisture")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "di")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "clarity_turbidity")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_ash")) }}
                    </td>
                </tr>
            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="font-size:10px;">
                            {{ $mill_no += 1 }}. {{ $data->mill->name }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->gravity_purity) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->apparent_purity) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->percent_pol) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->percent_sucrose) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->percent_moisture) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->di) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->clarity_turbidity) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->percent_ash) }}
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_gravity_purity) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_apparent_purity) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_pol) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_sucrose) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_moisture)  }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_di) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_clarity_turbidity) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_ash)  }}</td>
        </tr>
    </tbody>
</table>