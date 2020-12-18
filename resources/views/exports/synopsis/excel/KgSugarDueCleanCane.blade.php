
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="4" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="4" style="text-align: center;">
        TABLE XXI. ADDITIONAL KILOS SUGAR DUE CLEAN CANE
      </td>
    </tr>
      
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="font-size:10px; width:40px; text-align:center;">SUGAR FACTORY</th>
            <th style="font-size:10px; width:20px; text-align:center;">TRASH PERCENT <br>CANE</th>
            <th style="font-size:10px; width:20px; text-align:center;">PERCENT <br>RECOVERY</th>
            <th style="font-size:10px; width:20px; text-align:center;">RECOVERABLE KILOS SUGAR<br> DUE FIBROUS TRASH AND <br>INCREASED EFFICIENCY</th>
        </tr>  
    </thead>
    <tbody>

        <?php
            $total_trash_percent_cane = 0;
            $total_percent_recovery = 0;
            $total_recoverable = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_trash_percent_cane += totalPerRegionAndField($collection, $reg_key, "trash_percent_cane");
                    $total_percent_recovery += totalPerRegionAndField($collection, $reg_key, "percent_recovery");
                    $total_recoverable += totalPerRegionAndField($collection, $reg_key, "recoverable");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "trash_percent_cane")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "percent_recovery")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "recoverable")) }}
                    </td>
                </tr>
            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="font-size:10px;">{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->trash_percent_cane) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->percent_recovery) }}</td>
                        <td style="font-size:10px; text-align:right;"> {{ displayData($data->recoverable) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_trash_percent_cane) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_percent_recovery) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_recoverable) }}</td>
        </tr>
    </tbody>
</table>