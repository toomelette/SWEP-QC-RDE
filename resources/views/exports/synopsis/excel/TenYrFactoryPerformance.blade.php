
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
        <td colspan="7" style="text-align: center;">
            CROP YEAR: {{ $crop_year }}
        </td>
    </tr>

    <tr>
        <td colspan="7" style="text-align: center;">
            ANNEX III
        </td>
    </tr>
      
    <tr>
        <td colspan="7" style="text-align: center;">
            TEN - YEAR SUMMARY OF FACTORY PERFORMANCE
        </td>
    </tr>

    <tr>

    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="font-size:10px; width:20px; text-align:center;">CROP YEAR</th>
            <th style="font-size:10px; width:20px; text-align:center;">RATED CAPACITY <br>(TCD)</th>
            <th style="font-size:10px; width:20px; text-align:center;">CAPACITY <br>UTILIZATION <br> (%)</th>
            <th style="font-size:10px; width:20px; text-align:center;">POL EXTRACTION <br> (%)</th>
            <th style="font-size:10px; width:20px; text-align:center;">ACTUAL BOILING <br>HOUSE RECOVERY <br> (%)</th>
            <th style="font-size:10px; width:20px; text-align:center;">REDUCED <br>OVERALL <br>RECOVERY, ESG <br> (%)</th>
            <th style="font-size:10px; width:20px; text-align:center;">AVERAGE NUMBER <br>OF GRINDING DAYS</th>
        </tr> 
    </thead>
    <tbody>
        @foreach ($collection as $key => $data)
            <tr>
                <td style="font-size:10px; text-align:right;"> {{ $data['cy_name'] }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['rated_capacity']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['cap_utilization']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['pol_extraction']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['actual_bhr']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['reduced_overall_recovery']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['ave_num_of_grinding']) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>