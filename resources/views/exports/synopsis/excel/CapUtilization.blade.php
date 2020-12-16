
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="6" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="6" style="text-align: center;">
        TABLE XV. CAPACITY UTILIZATION AND MECHANICAL TIME EFFICIENCY
      </td>
    </tr>
      
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:40px;">SUGAR FACTORY</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">NORMAL RATE <br>CAPACITY <br>(TCD)</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">TONNES <br>CANE PER <br>HOUR</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">AVERAGE HOURS <br>ACTUAL GRINDING/ <br>HOUR</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">CAPACITY <br>UTILIZATION</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">MECHANICAL <br>TIME <br>EFFICIENCY</th>
        </tr> 
    </thead>
    <tbody>

        <?php
            $total_normal_rate_cap = 0;
            $total_tonnes_cane_per_hr = 0;
            $total_ave_hr_actual_grinding = 0;
            $total_cap_utilization = 0;
            $total_mechanical_time_eff = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_normal_rate_cap += totalPerRegionAndField($collection, $reg_key, "normal_rate_cap");
                    $total_tonnes_cane_per_hr += totalPerRegionAndField($collection, $reg_key, "tonnes_cane_per_hr");
                    $total_ave_hr_actual_grinding += totalPerRegionAndField($collection, $reg_key, "ave_hr_actual_grinding");
                    $total_cap_utilization += totalPerRegionAndField($collection, $reg_key, "cap_utilization");
                    $total_mechanical_time_eff += totalPerRegionAndField($collection, $reg_key, "mechanical_time_eff");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>
                    
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "normal_rate_cap")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "tonnes_cane_per_hr")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "ave_hr_actual_grinding")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "cap_utilization")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "mechanical_time_eff")) }}
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
                            {{ displayData($data->normal_rate_cap) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->tonnes_cane_per_hr) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->ave_hr_actual_grinding) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->cap_utilization) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->mechanical_time_eff) }}
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_normal_rate_cap) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_tonnes_cane_per_hr) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_ave_hr_actual_grinding) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_cap_utilization) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_mechanical_time_eff)  }}</td>
        </tr>
    </tbody>
</table>