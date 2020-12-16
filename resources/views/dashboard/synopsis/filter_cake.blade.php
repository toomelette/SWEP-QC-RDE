@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Filter Cake</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<filter-cake-list></filter-cake-list>
	    	<filter-cake-create-modal></filter-cake-create-modal>
	    	<filter-cake-update-modal></filter-cake-update-modal>
	    	<filter-cake-delete-modal></filter-cake-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynFilterCakeMain.js') }}"></script>
@endsection