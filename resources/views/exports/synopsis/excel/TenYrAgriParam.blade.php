
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
        <td colspan="7" style="text-align: center;">
            CROP YEAR: {{ $crop_year }}
        </td>
    </tr>

    <tr>
        <td colspan="7" style="text-align: center;">
            ANNEX IV
        </td>
    </tr>
      
    <tr>
        <td colspan="7" style="text-align: center;">
            TEN - YEAR DATA ON AGRICULTURAL PARAMETERS
        </td>
    </tr>

    <tr>

    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="font-size:10px; width:20px; text-align:center;">CROP YEAR</th>
            <th style="font-size:10px; width:20px; text-align:center;">AREA HARVESTED <br>(Hectares)</th>
            <th style="font-size:10px; width:20px; text-align:center;">TC/Ha</th>
            <th style="font-size:10px; width:20px; text-align:center;">LKg/TC</th>
            <th style="font-size:10px; width:20px; text-align:center;">LKg/Ha</th>
        </tr> 
    </thead>
    <tbody>
        @foreach ($collection as $key => $data)
            <tr>
                <td style="font-size:10px; text-align:right;"> {{ $data['cy_name'] }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['area_harvested']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['tc_ha']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['lkg_tc']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['lkg_ha']) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>