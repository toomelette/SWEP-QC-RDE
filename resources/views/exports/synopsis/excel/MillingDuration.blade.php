@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="6" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="6" style="text-align: center;">
        TABLE XXIII. MILLING DURATION
      </td>
    </tr>
      
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="font-size:10px; width:40px; text-align: center;">SUGAR FACTORY</th>
            <th style="font-size:10px; width:20px; text-align: center;">MILLING STARTED</th>
            <th style="font-size:10px; width:20px; text-align: center;">MILLING ENDED</th>
            <th>&nbsp;</th>
            <th style="font-size:10px; width:20px; text-align: center;">CROP LENGTH</th>
            <th style="font-size:10px; width:30px; text-align: center;">TOTAL ELAPSED TIME (TET) <br> (HOURS)</th>
        </tr>  
    </thead>
    <tbody>

        <?php
            $total_crop_length = 0;
            $total_tet = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)

            @if (numberPerRegion($collection, $reg_key) > 0)

                <?php
                    $total_crop_length += totalPerRegionAndField($collection, $reg_key, "crop_length");
                    $total_tet += totalPerRegionAndField($collection, $reg_key, "tet");
                ?>

                {{-- Total per mill --}}
                <tr>
                    
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>

                    <td></td>

                    <td></td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">Total:</td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "crop_length")) }}
                    </td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "tet")) }}
                    </td>

                </tr>

                {{-- Average per mill --}}
                <tr>
                    
                    <td></td>

                    <td></td>

                    <td></td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">Ave:</td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "crop_length") / numberPerRegion($collection, $reg_key)) }}
                    </td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "tet") / numberPerRegion($collection, $reg_key)) }}
                    </td>

                </tr>

            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="font-size:10px;">{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ __dataType::date_parse($data->mill_start, 'm/d/Y') }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ __dataType::date_parse($data->mill_end, 'm/d/Y') }}</td>
                        <td></td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->crop_length) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->tet) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach

        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td></td>
            <td></td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">Total:</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_crop_length) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_tet) }}</td>
        </tr>

        {{-- Average Country --}}
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">Ave:</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_crop_length / $collection->count()) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_tet / $collection->count()) }}</td>
        </tr>

    </tbody>
</table>