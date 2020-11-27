@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Cane-Sugar Tons</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<synopsis-cane-sugar-tons-list></synopsis-cane-sugar-tons-list>
	    	<synopsis-cane-sugar-tons-create-modal></synopsis-cane-sugar-tons-create-modal>
	    	<synopsis-cane-sugar-tons-update-modal></synopsis-cane-sugar-tons-update-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/CaneSugarTonsMain.js') }}"></script>
@endsection