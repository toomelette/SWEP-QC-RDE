@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Milling Plant</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<milling-plant-list></milling-plant-list>
	    	<milling-plant-create-modal></milling-plant-create-modal>
	    	<milling-plant-update-modal></milling-plant-update-modal>
	    	<milling-plant-delete-modal></milling-plant-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynMillingPlantMain.js') }}"></script>
@endsection