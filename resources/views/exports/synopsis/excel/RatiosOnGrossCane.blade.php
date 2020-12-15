
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="5" style="text-align: center;">CROP-YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="5" style="text-align: center;">
        TABLE III. RATIOS ON GROSS CANE GROUND
      </td>
    </tr>
      
    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="text-align:center; font-size:10px; width:40px;">SUGAR FACTORY</th>
            <th style="text-align: center; font-size:10px; width:25px;">Burnt Cane Percent <br> Gross Cane</th>
            <th style="text-align: center; font-size:10px; width:25px;">Quality Ratio <br> TC/TS</th>
            <th style="text-align: center; font-size:10px; width:25px;">Rendement <br> Lkg/TC</th>
            <th style="text-align: center; font-size:10px; width:25px;">Total Sugar <br> Recovered  %Cane </th>
        </tr>  
    </thead>
    <tbody>

        <?php
            $burnt_cane_percent = 0;
            $quality_ratio = 0;
            $rendement = 0;
            $total_sugar_recovered = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $burnt_cane_percent += totalPerRegionAndField($collection, $reg_key, "burnt_cane_percent");
                    $quality_ratio += totalPerRegionAndField($collection, $reg_key, "quality_ratio");
                    $rendement += totalPerRegionAndField($collection, $reg_key, "rendement");
                    $total_sugar_recovered += totalPerRegionAndField($collection, $reg_key, "total_sugar_recovered");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "burnt_cane_percent")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "quality_ratio")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "rendement")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "total_sugar_recovered")) }}
                    </td>
                </tr>
            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="font-size:10px;">{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->burnt_cane_percent) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->quality_ratio) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->rendement) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->total_sugar_recovered) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($burnt_cane_percent) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($quality_ratio) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($rendement) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_sugar_recovered) }}</td>
        </tr>
    </tbody>
</table>