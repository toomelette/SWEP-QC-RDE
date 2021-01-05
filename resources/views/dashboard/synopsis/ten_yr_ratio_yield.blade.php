@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Ten Year Ratio Yield</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<ten-yr-ratio-yield-list></ten-yr-ratio-yield-list>
	    	<ten-yr-ratio-yield-create-modal></ten-yr-ratio-yield-create-modal>
	    	<ten-yr-ratio-yield-update-modal></ten-yr-ratio-yield-update-modal>
	    	<ten-yr-ratio-yield-delete-modal></ten-yr-ratio-yield-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynTenYrRatioYieldMain.js') }}"></script>
@endsection