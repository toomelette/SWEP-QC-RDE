
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="6" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="6" style="text-align: center;">
        TABLE IV. ANALYSES OF GROSS CANE GROUND
      </td>
    </tr>
      
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:40px;">SUGAR FACTORY</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">PERCENT <br> POL</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">PERCENT <br> SUCROSE</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">PERCENT <br> FIBER</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">PERCENT <br> TRASH</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:15px;">POL PERCENT <br> FIBER</th>
        </tr> 
    </thead>
    <tbody>

        <?php
            $total_percent_pol = 0;
            $total_percent_sucrose = 0;
            $total_percent_fiber = 0;
            $total_percent_trash = 0;
            $total_pol_percent_fiber = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_percent_pol += totalPerRegionAndField($collection, $reg_key, "percent_pol");
                    $total_percent_sucrose += totalPerRegionAndField($collection, $reg_key, "percent_sucrose");
                    $total_percent_fiber += totalPerRegionAndField($collection, $reg_key, "percent_fiber");
                    $total_percent_trash += totalPerRegionAndField($collection, $reg_key, "percent_trash");
                    $total_pol_percent_fiber += totalPerRegionAndField($collection, $reg_key, "pol_percent_fiber");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">
                        {{ $reg_data }}</td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_pol")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_sucrose")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_fiber")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_trash")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "pol_percent_fiber")) }}
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
                            {{ displayData($data->percent_pol) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->percent_sucrose) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->percent_fiber) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->percent_trash) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->pol_percent_fiber) }}
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_pol) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_sucrose) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_fiber) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_trash) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_pol_percent_fiber)  }}</td>
        </tr>
    </tbody>
</table>