@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Ten Year Production Data</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<ten-yr-prdn-list></ten-yr-prdn-list>
	    	<ten-yr-prdn-create-modal></ten-yr-prdn-create-modal>
	    	<ten-yr-prdn-update-modal></ten-yr-prdn-update-modal>
	    	<ten-yr-prdn-delete-modal></ten-yr-prdn-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynTenYrPrdnMain.js') }}"></script>
@endsection