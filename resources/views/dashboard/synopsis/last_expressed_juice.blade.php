@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Last Expressed Juice</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<last-expressed-juice-list></last-expressed-juice-list>
	    	<last-expressed-juice-create-modal></last-expressed-juice-create-modal>
	    	<last-expressed-juice-update-modal></last-expressed-juice-update-modal>
	    	<last-expressed-juice-delete-modal></last-expressed-juice-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynLastExpressedJuiceMain.js') }}"></script>
@endsection