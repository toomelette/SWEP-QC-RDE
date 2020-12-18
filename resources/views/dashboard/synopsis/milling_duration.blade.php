@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Milling Duration</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<milling-duration-list></milling-duration-list>
	    	<milling-duration-create-modal></milling-duration-create-modal>
	    	<milling-duration-update-modal></milling-duration-update-modal>
	    	<milling-duration-delete-modal></milling-duration-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynMillingDurationMain.js') }}"></script>
@endsection