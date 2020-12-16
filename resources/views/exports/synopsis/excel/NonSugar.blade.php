
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="7" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="7" style="text-align: center;">
        TABLE XIV. PERCENT NON-SUGAR OF END PRODUCTS and MATERIALS IN PROCESS
      </td>
    </tr>
      
    <tr>
      <td colspan="7">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="font-size:10px; width:40px;  text-align:center;">SUGAR FACTORY</th>
            <th style="font-size:10px; width:15px;  text-align:center;">FIRST EXPRESSED <br>JUICE</th>
            <th style="font-size:10px; width:15px;  text-align:center;">LAST EXPRESSED <br>JUICE</th>
            <th style="font-size:10px; width:15px;  text-align:center;">MIXED JUICE</th>
            <th style="font-size:10px; width:15px;  text-align:center;">SYRUP</th>
            <th style="font-size:10px; width:15px;  text-align:center;">MOLASSES</th>
            <th style="font-size:10px; width:15px;  text-align:center;">SUGAR</th>
        </tr> 
    </thead>
    <tbody>

        <?php
            $total_first_expressed_juice = 0;
            $total_last_expressed_juice = 0;
            $total_mixed_juice = 0;
            $total_syrup = 0;
            $total_molasses = 0;
            $total_sugar = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_first_expressed_juice += totalPerRegionAndField($collection, $reg_key, "first_expressed_juice");
                    $total_last_expressed_juice += totalPerRegionAndField($collection, $reg_key, "last_expressed_juice");
                    $total_mixed_juice += totalPerRegionAndField($collection, $reg_key, "mixed_juice");
                    $total_syrup += totalPerRegionAndField($collection, $reg_key, "syrup");
                    $total_molasses += totalPerRegionAndField($collection, $reg_key, "molasses");
                    $total_sugar += totalPerRegionAndField($collection, $reg_key, "sugar");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "first_expressed_juice")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "last_expressed_juice")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "mixed_juice")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "syrup")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "molasses")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "sugar")) }}
                    </td>
                </tr>
            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="font-size:10px;">{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->first_expressed_juice) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->last_expressed_juice) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->mixed_juice) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->syrup) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->molasses) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->sugar) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_first_expressed_juice) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_last_expressed_juice) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_mixed_juice) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_syrup) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_molasses) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_sugar) }}</td>
        </tr>
    </tbody>
</table>