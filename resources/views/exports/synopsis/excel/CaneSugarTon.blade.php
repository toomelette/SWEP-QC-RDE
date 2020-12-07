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

?>


<table>
    <thead>
        <tr>
            <th rowspan="2" style="text-align:center; width:50px;">SUGAR FACTORY</th>
            <th colspan="2" style="text-align: center;">SUGARCANE</th>
            <th colspan="3" style="text-align: center;">RAW SUGAR</th>
        </tr>  
        <tr>
            <th style="width:20px;">GROSS TONNES</th>
            <th style="width:20px;">NET TONNES</th>
            <th style="width:20px;">TONNES DUE CANE</th>
            <th style="width:25px;">TONNES MANUFACTURED</th>
            <th style="width:25px;">EQUIVALENT (50-Kg Bag)</th>
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
                <tr>
                    <td style="font-weight:bold;">{{ $reg_data }}</td>
                    <td style="font-weight:bold;">{{ number_format(totalPerRegionAndField($collection, $reg_key, "sgrcane_gross_tonnes")) }}</td>
                    <td style="font-weight:bold;">{{ number_format(totalPerRegionAndField($collection, $reg_key, "sgrcane_net_tonnes")) }}</td>
                    <td style="font-weight:bold;">{{ number_format(totalPerRegionAndField($collection, $reg_key, "rawsgr_tonnes_due_cane")) }}</td>
                    <td style="font-weight:bold;">{{ number_format(totalPerRegionAndField($collection, $reg_key, "rawsgr_tonnes_manufactured")) }}</td>
                    <td style="font-weight:bold;">{{ number_format(totalPerRegionAndField($collection, $reg_key, "equivalent")) }}</td>
                </tr>
            @endif
            <?php $mill_no = 0; ?>
            @foreach ($collection as $key => $data)
                @if($data->mill->report_region == $reg_key)
                    <tr>
                        <td>{{ $mill_no += 1 }}. {{ $data->mill->name }}</td>
                        <td>{{ number_format($data->sgrcane_gross_tonnes, 2) }}</td>
                        <td>{{ number_format($data->sgrcane_net_tonnes, 2) }}</td>
                        <td>{{ number_format($data->rawsgr_tonnes_due_cane, 2) }}</td>
                        <td>{{ number_format($data->rawsgr_tonnes_manufactured, 2) }}</td>
                        <td>{{ number_format($data->equivalent, 2) }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        <tr>
            <td style="font-weight:bold;">PHILIPPINES</td>
            <td style="font-weight:bold;">{{ number_format($total_sgrcane_gross_tonnes, 2) }}</td>
            <td style="font-weight:bold;">{{ number_format($total_sgrcane_net_tonnes, 2) }}</td>
            <td style="font-weight:bold;">{{ number_format($total_rawsgr_tonnes_due_cane, 2) }}</td>
            <td style="font-weight:bold;">{{ number_format($total_rawsgr_tonnes_manufactured, 2) }}</td>
            <td style="font-weight:bold;">{{ number_format($total_equivalent, 2)  }}</td>
        </tr>
    </tbody>
</table>