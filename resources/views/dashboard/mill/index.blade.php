<?php

  $table_sessions = [ 
    Session::get('MILL_UPDATE_SUCCESS_SLUG'),
    Session::get('MILL_RENEW_LICENSE_SUCCESS_SLUG'),
  ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),
                        'page' => Request::get('page'),
                      ];

?>


@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Mills</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" action="{{ route('dashboard.mill.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.mill.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

    {{-- Table Grid --}}        
    <div class="box-body no-padding">
      <table class="table table-hover">
        <tr>
          <th>@sortablelink('name', 'Name')</th>
          <th>Action</th>
        </tr>
        @foreach($mills as $data) 
          <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
            <td id="mid-vert">{{ $data->name }}</td>
            <td id="mid-vert">

              <div class="btn-group">
                @if(in_array('dashboard.mill.edit', $global_user_submenus))
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.mill.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i>
                  </a>
                @endif
                @if(in_array('dashboard.mill.destroy', $global_user_submenus))
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.mill.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                @endif
              </div>

            </td>
          </tr>
        @endforeach
        </table>
      </div>

      @if($mills->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($mills) !!}
        {!! $mills->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('mill_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {!! __js::button_modal_confirm_delete_caller('mill_delete') !!}

    // TOAST
    @if(Session::has('MILL_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('MILL_UPDATE_SUCCESS')) !!}
    @endif

    @if(Session::has('MILL_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('MILL_DELETE_SUCCESS')) !!}
    @endif

  </script>

@endsection