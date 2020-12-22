@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Detail of Stoppages - A</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<detail-of-stoppage-b-list></detail-of-stoppage-b-list>
	    	<detail-of-stoppage-b-create-modal></detail-of-stoppage-b-create-modal>
	    	<detail-of-stoppage-b-update-modal></detail-of-stoppage-b-update-modal>
	    	<detail-of-stoppage-b-delete-modal></detail-of-stoppage-b-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynDetailOfStoppageBMain.js') }}"></script>
@endsection