@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Cane-Sugar Tons</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<cane-sugar-tons-list></cane-sugar-tons-list>
	    	<cane-sugar-tons-create-modal></cane-sugar-tons-create-modal>
	    	<cane-sugar-tons-update-modal></cane-sugar-tons-update-modal>
	    	<cane-sugar-tons-delete-modal></cane-sugar-tons-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynCaneSugarTonsMain.js') }}"></script>
@endsection