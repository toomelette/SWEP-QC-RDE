@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Grinding Stopagges</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<grind-stoppage-list></grind-stoppage-list>
	    	<grind-stoppage-create-modal></grind-stoppage-create-modal>
	    	<grind-stoppage-update-modal></grind-stoppage-update-modal>
	    	<grind-stoppage-delete-modal></grind-stoppage-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynGrindStoppageMain.js') }}"></script>
@endsection