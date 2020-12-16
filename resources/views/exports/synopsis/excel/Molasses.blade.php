
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="10" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="10" style="text-align: center;">
         TABLE XIII. FINAL MOLASSES
      </td>
    </tr>
      
    <tr>
      <td colspan="10">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="font-size:10px; width:40px; text-align:center;">SUGAR FACTORY</th>
            <th style="font-size:10px; width:15px; text-align:center;">TONNES <br>MANUFACTURED</th>
            <th style="font-size:10px; width:15px; text-align:center;">TONNES DUE CANE</th>
            <th style="font-size:10px; width:15px; text-align:center;">PERCENT <br>ON CANE</th>
            <th style="font-size:10px; width:15px; text-align:center;">BRIX</th>
            <th style="font-size:10px; width:15px; text-align:center;">APPARENT <br>PURITY</th>
            <th style="font-size:10px; width:15px; text-align:center;">GRAVITY <br>PURITY</th>
            <th style="font-size:10px; width:15px; text-align:center;">PERCENT <br>ASH</th>
            <th style="font-size:10px; width:15px; text-align:center;">PERCENT <br>REDUCING <br>SUGAR</th>
            <th style="font-size:10px; width:15px; text-align:center;">EXPECTED <br>MOLASSES <br>PURITY</th>
        </tr> 
    </thead>
    <tbody>

        <?php
            $total_tonnes_manufactured = 0;
            $total_tonnes_due_cane = 0;
            $total_percent_on_cane = 0;
            $total_brix = 0;
            $total_apparent_purity = 0;
            $total_gravity_purity = 0;
            $total_percent_ash = 0;
            $total_percent_reducing_sugar = 0;
            $total_expected_molasses_purity = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_tonnes_manufactured += totalPerRegionAndField($collection, $reg_key, "tonnes_manufactured");
                    $total_tonnes_due_cane += totalPerRegionAndField($collection, $reg_key, "tonnes_due_cane");
                    $total_percent_on_cane += totalPerRegionAndField($collection, $reg_key, "percent_on_cane");
                    $total_brix += totalPerRegionAndField($collection, $reg_key, "brix");
                    $total_apparent_purity += totalPerRegionAndField($collection, $reg_key, "apparent_purity");
                    $total_gravity_purity += totalPerRegionAndField($collection, $reg_key, "gravity_purity");
                    $total_percent_ash += totalPerRegionAndField($collection, $reg_key, "percent_ash");
                    $total_percent_reducing_sugar += totalPerRegionAndField($collection, $reg_key, "percent_reducing_sugar");
                    $total_expected_molasses_purity += totalPerRegionAndField($collection, $reg_key, "expected_molasses_purity");
                ?>
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "tonnes_manufactured")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "tonnes_due_cane")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_on_cane")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "brix")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "apparent_purity")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "gravity_purity")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_ash")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_reducing_sugar")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "expected_molasses_purity")) }}
                    </td>
                </tr>
            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="font-size:10px;">{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->tonnes_manufactured) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->tonnes_due_cane) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->percent_on_cane) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->brix) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->apparent_purity) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->gravity_purity) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->percent_ash) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->percent_reducing_sugar) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->expected_molasses_purity) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_tonnes_manufactured) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_tonnes_due_cane) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_on_cane) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_brix) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_apparent_purity) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_gravity_purity) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_ash) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_reducing_sugar) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_expected_molasses_purity) }}</td>
        </tr>
    </tbody>
</table>