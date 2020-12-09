@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Production Increment</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<prdn-increment-list></prdn-increment-list>
	    	<prdn-increment-create-modal></prdn-increment-create-modal>
	    	<prdn-increment-update-modal></prdn-increment-update-modal>
	    	<prdn-increment-delete-modal></prdn-increment-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynPRDNIncrementMain.js') }}"></script>
@endsection