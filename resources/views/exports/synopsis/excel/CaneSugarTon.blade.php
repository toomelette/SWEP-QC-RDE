<?php



    function totalPerRegionAndField($collection, $region, $field){

        $total = 0;

        if (!empty($collection)) {
            foreach ($collection as $key => $data) {
                if ($data->mill->report_region == $region) {
                    $total += $data[$field];
                }
            }
        }

        return $total;

    }



    function numberPerRegion($collection, $region){

        $num = 0;

        if (!empty($collection)) {
            foreach ($collection as $data) {
                if ($data->mill->report_region == $region) {
                    $num++;
                }
            }
        }

        return $num;

    }



    function displayData($float){

        $data = 'NA';

        if (!$float == 0) {
            $data = number_format($float, 2);
        }

        return $data;

    }



?>


<table style="font-size:8px;">

    <tr>
      <td colspan="6" style="text-align: center;">
        Cane-Sugar Tons
      </td>
    </tr>
      
    <tr>
      <td colspan="6" style="text-align: center;">CROP YEAR {{ $crop_year }}</td>
    </tr>
      
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th rowspan="2" style="font-size:10px; text-align:center; width:40px;">SUGAR FACTORY</th>
            <th colspan="2" style="font-size:10px; text-align: center;">SUGARCANE</th>
            <th colspan="3" style="font-size:10px; text-align: center;">RAW SUGAR</th>
        </tr>  
        <tr>
            <th style="font-size:10px; width:15px;">GROSS TONNES</th>
            <th style="font-size:10px; width:15px;">NET TONNES</th>
            <th style="font-size:10px; width:20px;">TONNES DUE CANE</th>
            <th style="font-size:10px; width:25px;">TONNES MANUFACTURED</th>
            <th style="font-size:10px; width:25px;">EQUIVALENT (50-Kg Bag)</th>
        </tr> 
    </thead>
    <tbody>

        <?php
            $total_sgrcane_gross_tonnes = 0;
            $total_sgrcane_net_tonnes = 0;
            $total_rawsgr_tonnes_due_cane = 0;
            $total_rawsgr_tonnes_manufactured = 0;
            $total_equivalent = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $total_sgrcane_gross_tonnes += totalPerRegionAndField($collection, $reg_key, "sgrcane_gross_tonnes");
                    $total_sgrcane_net_tonnes += totalPerRegionAndField($collection, $reg_key, "sgrcane_net_tonnes");
                    $total_rawsgr_tonnes_due_cane += totalPerRegionAndField($collection, $reg_key, "rawsgr_tonnes_due_cane");
                    $total_rawsgr_tonnes_manufactured += totalPerRegionAndField($collection, $reg_key, "rawsgr_tonnes_manufactured");
                    $total_equivalent += totalPerRegionAndField($collection, $reg_key, "equivalent");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">
                        {{ $reg_data }}</td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "sgrcane_gross_tonnes")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "sgrcane_net_tonnes")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "rawsgr_tonnes_due_cane")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "rawsgr_tonnes_manufactured")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "equivalent")) }}
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
                            {{ displayData($data->sgrcane_gross_tonnes) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->sgrcane_net_tonnes) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->rawsgr_tonnes_due_cane) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->rawsgr_tonnes_manufactured) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->equivalent) }}
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_sgrcane_gross_tonnes) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_sgrcane_net_tonnes) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_rawsgr_tonnes_due_cane) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_rawsgr_tonnes_manufactured) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($total_equivalent)  }}</td>
        </tr>
    </tbody>
</table>