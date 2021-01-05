
@include('exports.util')

<table style="font-size:8px;">
      
    <tr>
        <td colspan="6" style="text-align: center;">
            CROP YEAR: {{ $crop_year }}
        </td>
    </tr>

    <tr>
        <td colspan="6" style="text-align: center;">
            ANNEX I
        </td>
    </tr>
      
    <tr>
        <td colspan="6" style="text-align: center;">
            TEN - YEAR SUMMARY OF PRODUCTION DATA
        </td>
    </tr>

    <tr>

    </tr>

    <thead>
        {{-- Header --}}
        <tr>
            <th style="font-size:10px; width:20px; text-align:center;">CROP YEAR</th>
            <th style="font-size:10px; width:20px; text-align:center;">GROSS CANE <br>MILLED</th>
            <th style="font-size:10px; width:20px; text-align:center;">RAW SUGAR <br>MANUFACTURED</th>
            <th style="font-size:10px; width:20px; text-align:center;">MOLASSES DUE <br>CANE</th>
            <th style="font-size:10px; width:20px; text-align:center;">BAGASSE</th>
            <th style="font-size:10px; width:20px; text-align:center;">FILTER CAKE</th>
        </tr> 
    </thead>
    <tbody>
        @foreach ($collection as $key => $data)
            <tr>
                <td style="font-size:10px; text-align:right;"> {{ $data['cy_name'] }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['gross_cane_milled']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['raw_sugar_man']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['molasses_due_cane']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['bagasse']) }}</td>
                <td style="font-size:10px; text-align:right;"> {{ displayData($data['filter_cake']) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>