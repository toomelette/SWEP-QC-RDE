
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
      <td colspan="7" style="text-align: center;">CROP YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="7" style="text-align: center;">
        TABLE XXII. POTENTIAL REVENUE DIFFERENTIAL DUE INCREASED EFFICIENCY
      </td>
    </tr>
      
    <tr>
      <td colspan="7">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:40px;">SUGAR FACTORY</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:20px;">DUE MILL AND <br>BOILING HOUSE</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:20px;">DUE TRASH</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:20px;">TOTAL</th>
            <th style="text-align:center; font-size:10px; font-weight:bold; width:20px;">POTENTIAL REVENUE <br> (PESO)</th>
        </tr> 
    </thead>
    <tbody>

        <?php
            $total_due_bh = 0;
            $total_due_trash = 0;
            $total_total = 0;
            $total_potential_revenue = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_due_bh += totalPerRegionAndField($collection, $reg_key, "due_bh");
                    $total_due_trash += totalPerRegionAndField($collection, $reg_key, "due_trash");
                    $total_total += totalPerRegionAndField($collection, $reg_key, "total");
                    $total_potential_revenue += totalPerRegionAndField($collection, $reg_key, "potential_revenue");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">{{ $reg_data }}</td>

                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_bh")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "due_trash")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "total")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "potential_revenue")) }}
                    </td>
                </tr>
            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    {{-- Data per mill --}}
                    <tr>
                        <td style="font-size:10px;">{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->due_bh) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->due_trash) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->total) }}</td>
                        <td style="font-size:10px; text-align:right;">{{ displayData($data->potential_revenue) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_bh) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_due_trash) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_total) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_potential_revenue) }}</td>
        </tr>
    </tbody>
</table>