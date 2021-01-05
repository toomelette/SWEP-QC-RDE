@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Ten Year Factory Performance</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<ten-yr-factory-performance-list></ten-yr-factory-performance-list>
	    	<ten-yr-factory-performance-create-modal></ten-yr-factory-performance-create-modal>
	    	<ten-yr-factory-performance-update-modal></ten-yr-factory-performance-update-modal>
	    	<ten-yr-factory-performance-delete-modal></ten-yr-factory-performance-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynTenYrFactoryPerformanceMain.js') }}"></script>
@endsection