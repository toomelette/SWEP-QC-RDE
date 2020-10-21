<!DOCTYPE html>
<html>

<head>

  <title>Rated Capacity</title>
  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/dist/css/skins/_all-skins.min.css') }}">

  <style type="text/css">

    @page  
      { 
        size: auto;
        margin-top: 25mm;
        margin-bottom: 30mm;  
      } 

  </style>

</head>

<body onload="window.print();" onafterprint="window.close()" style="font-size: 11px;">

<section class="invoice">

  {{-- HEADER --}}
  <div class="row" style="padding:11px; text-align: center;">
    <span style="font-size: 14px;">REFINERY RATED CAPACITY</span><br>
    <span style="font-size: 14px;">CY {{ $crop_year->name }}</span>
  </div>

  <div class="row" id="content">

    <div class="col-xs-12">

      <table class="table table-bordered">

        <thead>
          <tr>
            <th style="width:100px;">SUGAR REFINERIES</th>
            <th style="width:100px;">RATED CAPACITY</th>
          </tr>
        </thead>

        <tbody>

          <?php 
            $total_L = 0;
            $total_V = 0;
            $total_M = 0; 
          ?>

          @foreach (__static::report_regions() as $rr_name => $rr_key)

            <tr>
              <td style="vertical-align: text-top; padding-top:5px; font-weight:bold;">
                {{ $rr_name }}
              </td>
              <td style="padding-top:5px;"></td>
            </tr>

            @foreach($refinery_registrations as $data)
              @if (!empty($data->refinery))
                @if ($data->refinery->report_region == $rr_key)

                <?php $total_L += $data->rated_capacity ?>

                  <tr>
                    <td style="vertical-align: text-top; padding-top:5px;">
                      {{ optional($data->refinery)->name }}
                    </td>
                    <td style="padding-top:5px;">
                      {{ number_format($data->rated_capacity, 2) }} Lkg/day<br>
                    </td>
                  </tr>
                @endif
              @endif
            @endforeach
            
          @endforeach

          <?php
            $total_rc = $total_L + $total_V + $total_M;
          ?>

          <tr>
            <td style="vertical-align: text-top; padding-top:5px; font-weight:bold;">
              TOTAL
            </td>
            <td style="padding-top:5px;">{{ number_format($total_rc, 2) }}</td>
          </tr>

        </tbody>

      </table>

    </div>

  </div>

</section>

</body>

</html>