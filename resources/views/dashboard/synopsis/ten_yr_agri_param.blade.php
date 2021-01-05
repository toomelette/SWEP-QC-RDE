@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Ten Year Factory Performance</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<ten-yr-agri-param-list></ten-yr-agri-param-list>
	    	<ten-yr-agri-param-create-modal></ten-yr-agri-param-create-modal>
	    	<ten-yr-agri-param-update-modal></ten-yr-agri-param-update-modal>
	    	<ten-yr-agri-param-delete-modal></ten-yr-agri-param-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynTenYrAgriParamMain.js') }}"></script>
@endsection