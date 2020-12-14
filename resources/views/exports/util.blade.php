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