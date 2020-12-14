@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>First Expressed Juice</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<first-expressed-juice-list></first-expressed-juice-list>
	    	<first-expressed-juice-create-modal></first-expressed-juice-create-modal>
	    	<first-expressed-juice-update-modal></first-expressed-juice-update-modal>
	    	<first-expressed-juice-delete-modal></first-expressed-juice-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynFirstExpressedJuiceMain.js') }}"></script>
@endsection