@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Last Expressed Juice</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<mixed-juice-list></mixed-juice-list>
	    	<mixed-juice-create-modal></mixed-juice-create-modal>
	    	<mixed-juice-update-modal></mixed-juice-update-modal>
	    	<mixed-juice-delete-modal></mixed-juice-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynMixedJuiceMain.js') }}"></script>
@endsection