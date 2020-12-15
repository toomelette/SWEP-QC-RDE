
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="5" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="5" style="text-align: center;">
        TABLE VI. FIRST EXPRESSED JUICE
      </td>
    </tr>
      
    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="font-size:10px; width:40px; text-align:center;">SUGAR FACTORY</th>
            <th style="font-size:10px; width:15px; text-align:center;">BRIX</th>
            <th style="font-size:10px; width:15px; text-align:center;">PERCENT <br>POL</th>
            <th style="font-size:10px; width:15px; text-align:center;">APPARENT <br>PURITY</th>
            <th style="font-size:10px; width:15px; text-align:center;">DEREASE <br>IN AP</th>
        </tr> 
    </thead>
    <tbody>

        <?php
            $total_brix = 0;
            $total_percent_pol = 0;
            $total_apparent_purity = 0;
            $total_decrease_in_ap = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_brix += totalPerRegionAndField($collection, $reg_key, "brix");
                    $total_percent_pol += totalPerRegionAndField($collection, $reg_key, "percent_pol");
                    $total_apparent_purity += totalPerRegionAndField($collection, $reg_key, "apparent_purity");
                    $total_decrease_in_ap += totalPerRegionAndField($collection, $reg_key, "decrease_in_ap");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">
                        {{ $reg_data }}</td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "brix")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_pol")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "apparent_purity")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "decrease_in_ap")) }}
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
                            {{ displayData($data->brix) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->percent_pol) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->apparent_purity) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->decrease_in_ap) }}
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_brix) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_pol) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_apparent_purity) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_decrease_in_ap) }}</td>
        </tr>
    </tbody>
</table>