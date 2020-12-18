@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Potential Revenue</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<potential-revenue-list></potential-revenue-list>
	    	<potential-revenue-create-modal></potential-revenue-create-modal>
	    	<potential-revenue-update-modal></potential-revenue-update-modal>
	    	<potential-revenue-delete-modal></potential-revenue-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynPotentialRevenueMain.js') }}"></script>
@endsection