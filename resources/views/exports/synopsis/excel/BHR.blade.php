
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="5" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="5" style="text-align: center;">
        TABLE XVII. BOILING HOUSE
      </td>
    </tr>
      
    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="font-size:10px; width:40px; text-align:center;">SUGAR FACTORY</th>
            <th style="font-size:10px; width:25px; text-align:center;">ACTUAL <br>BOILING HOUSE <br>RECOVERY</th>
            <th style="font-size:10px; width:25px; text-align:center;">THEORETICAL <br>BOILING HOUSE <br>RECOVERY</th>
            <th style="font-size:10px; width:25px; text-align:center;">BASIC <br>BOILING HOUSE <br>RECOVERY</th>
            <th style="font-size:10px; width:25px; text-align:center;">REDUCED <br>BOILING HOUSE <br>RECOVERY, ESG</th>
        </tr> 
    </thead>
    <tbody>

        <?php
            $total_actual_bhr = 0;
            $total_theoritical_bhr = 0;
            $total_basic_bhr = 0;
            $total_reduced_bhr = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_actual_bhr += totalPerRegionAndField($collection, $reg_key, "actual_bhr");
                    $total_theoritical_bhr += totalPerRegionAndField($collection, $reg_key, "theoritical_bhr");
                    $total_basic_bhr += totalPerRegionAndField($collection, $reg_key, "basic_bhr");
                    $total_reduced_bhr += totalPerRegionAndField($collection, $reg_key, "reduced_bhr");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "actual_bhr")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "theoritical_bhr")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "basic_bhr")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "reduced_bhr")) }}
                    </td>
                </tr>
            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="font-size:10px;">{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->actual_bhr) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->theoritical_bhr) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->basic_bhr) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->reduced_bhr) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_actual_bhr) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_theoritical_bhr) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_basic_bhr) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_reduced_bhr) }}</td>
        </tr>
    </tbody>
</table>