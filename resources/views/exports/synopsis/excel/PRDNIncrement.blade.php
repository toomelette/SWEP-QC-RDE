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


    function lastCropYearName($crop_year){
        $last_cy = explode(" - ", $crop_year);
        $last_cy[0] = intval($last_cy[0]) - 1;
        $last_cy[1] = intval($last_cy[1]) - 1;
        $last_cy = implode("-", $last_cy);
        return $last_cy;
    }


?>


<table style="font-size:8px;">
      
    <tr>
      <td colspan="6" style="text-align: center;">CROP-YEAR: {{ $crop_year }}</td>
    </tr>

    <tr>
      <td colspan="6" style="text-align: center;">
        TABLE II. PRODUCTION INCREMENT AND SHARING RATIO
      </td>
    </tr>
      
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th rowspan="2" style="font-size:10px; text-align:center; width:40px;">SUGAR FACTORY</th>
            <th colspan="3" style="font-size:10px; text-align: center; width:60px;">50 - KILOGRAMS RAW SUGAR MANUFACTURED</th>
            <th rowspan="2" style="font-size:10px; text-align: center; width:25px;">PLANTERS-MILLERS <br> SHARING RATIO</th>
        </tr>  
        <tr>
            <th style="font-size:10px; text-align: center; width:20px;">CROP YEAR <br> {{ lastCropYearName($crop_year) }}</th>
            <th style="font-size:10px; text-align: center; width:20px;">CROP YEAR <br> {{ $crop_year }}</th>
            <th style="font-size:10px; text-align: center; width:20px;">INCREASE / <br> DECREASE</th>
        </tr>
    </thead>
    <tbody>

        <?php
            $current_cy_prod = 0;
            $past_cy_prod = 0;
            $increase_decrease = 0;
        ?>

        @foreach ($regions as $reg_key => $reg_data)
            @if (numberPerRegion($collection, $reg_key) > 0)
                <?php
                    $current_cy_prod += totalPerRegionAndField($collection, $reg_key, "current_cy_prod");
                    $past_cy_prod += totalPerRegionAndField($collection, $reg_key, "past_cy_prod");
                    $increase_decrease += totalPerRegionAndField($collection, $reg_key, "increase_decrease");
                ?>
                {{-- Total per mill --}}
                <tr>
                    <td style="font-size:10px; font-weight:bold;">
                        {{ $reg_data }}</td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "current_cy_prod")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "past_cy_prod")) }}
                    </td>
                    <td style="font-size:10px; font-weight:bold; text-align:right;">
                        {{ displayData(totalPerRegionAndField($collection, $reg_key, "increase_decrease")) }}
                    </td>
                    <td></td>
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
                            {{ displayData($data->current_cy_prod) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->past_cy_prod) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ displayData($data->increase_decrease) }}
                        </td>
                        <td style="font-size:10px; text-align:right;">
                            {{ $data->sharing_ratio }}
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        {{-- Total Country --}}
        <tr>
            <td style="font-size:10px; font-weight:bold;">PHILIPPINES</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($current_cy_prod) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($past_cy_prod) }}</td>
            <td style="font-size:10px; font-weight:bold; text-align:right;">{{ displayData($increase_decrease) }}</td>
            <td></td>
        </tr>
    </tbody>
</table>