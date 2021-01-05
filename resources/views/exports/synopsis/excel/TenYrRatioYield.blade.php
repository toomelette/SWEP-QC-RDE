
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
        <td colspan="7" style="text-align: center;">
            CROP YEAR: {{ $crop_year }}
        </td>
    </tr>

    <tr>
        <td colspan="7" style="text-align: center;">
            ANNEX II
        </td>
    </tr>
      
    <tr>
        <td colspan="7" style="text-align: center;">
            TEN - YEAR SUMMARY OF SIGNIFICANT PRODUCTION RATIO AND YIELD
        </td>
    </tr>

    <tr>

    </tr>

    <thead>
        {{-- Header --}}
        <tr>

            <th style="font-size:10px; width:20px;  text-align:center;">CROP YEAR</th>
            <th style="font-size:10px; width:20px;  text-align:center;">IMBIBITION <br>FIBER RATIO</th>
            <th style="font-size:10px; width:20px;  text-align:center;">RENDEMENT <br>(LKg/TC)</th>
            <th style="font-size:10px; width:20px;  text-align:center;">QUALITY RATIO <br>(TC/TS)</th>
            <th style="font-size:10px; width:20px;  text-align:center;">KILOGRAM <br>MOLASSES PER <br>TONNE OF CANE</th>
            <th style="font-size:10px; width:20px;  text-align:center;">KILOGRAM <br>BAGASSE PER <br>TONNE OF CANE</th>
            <th style="font-size:10px; width:20px;  text-align:center;">KILOGRAM <br>FILTERCAKE PER <br>TONNE OF CANE</th>

        </tr> 
    </thead>
    <tbody>
        @foreach ($collection as $key => $data)
            <tr>
                <td style="font-size:10px; text-align:right;"> {{ $data['cy_name'] }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['imbibition_fiber_ratio']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['rendement']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['quality_ratio']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['kg_mollasses_per_ton_cane']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['kg_bagasse_per_ton_cane']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['kg_fc_per_ton_cane']) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>