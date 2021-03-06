
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="8" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="8" style="text-align: center;">
        TABLE VIII. MIXED JUICE
      </td>
    </tr>
      
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="font-size:10px; width:40px; text-align:center;">SUGAR FACTORY</th>
            <th style="font-size:10px; width:15px; text-align:center;">TONNES</th>
            <th style="font-size:10px; width:15px; text-align:center;">PERCENT <br>ON CANE</th>
            <th style="font-size:10px; width:15px; text-align:center;">BRIX</th>
            <th style="font-size:10px; width:15px; text-align:center;">PERCENT <br>POL</th>
            <th style="font-size:10px; width:15px; text-align:center;">APPARENT <br>PURITY</th>
            <th style="font-size:10px; width:15px; text-align:center;">PERCENT <br>SUCROSE</th>
            <th style="font-size:10px; width:15px; text-align:center;">GRAVITY <br>PURITY</th>
        </tr> 
    </thead>
    <tbody>

        <?php
            $total_tonnes = 0;
            $total_percent_on_cane = 0;
            $total_brix = 0;
            $total_percent_pol = 0;
            $total_apparent_purity = 0;
            $total_percent_sucrose = 0;
            $total_gravity_purity = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_tonnes += totalPerRegionAndField($collection, $reg_key, "tonnes");
                    $total_percent_on_cane += totalPerRegionAndField($collection, $reg_key, "percent_on_cane");
                    $total_brix += totalPerRegionAndField($collection, $reg_key, "brix");
                    $total_percent_pol += totalPerRegionAndField($collection, $reg_key, "percent_pol");
                    $total_apparent_purity += totalPerRegionAndField($collection, $reg_key, "apparent_purity");
                    $total_percent_sucrose += totalPerRegionAndField($collection, $reg_key, "percent_sucrose");
                    $total_gravity_purity += totalPerRegionAndField($collection, $reg_key, "gravity_purity");
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
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "brix")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_pol")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "apparent_purity")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_sucrose")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "gravity_purity")) }}
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
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->brix) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->percent_pol) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->apparent_purity) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->percent_sucrose) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->gravity_purity) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_tonnes) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_on_cane) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_brix) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_pol) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_apparent_purity) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_sucrose) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_gravity_purity) }}</td>
        </tr>
    </tbody>
</table>