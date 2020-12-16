@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Capacity Utilization</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<cap-utilization-list></cap-utilization-list>
	    	<cap-utilization-create-modal></cap-utilization-create-modal>
	    	<cap-utilization-update-modal></cap-utilization-update-modal>
	    	<cap-utilization-delete-modal></cap-utilization-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynCapUtilizationMain.js') }}"></script>
@endsection