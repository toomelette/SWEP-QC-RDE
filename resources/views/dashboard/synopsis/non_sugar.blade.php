@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Molasses</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<non-sugar-list></non-sugar-list>
	    	<non-sugar-create-modal></non-sugar-create-modal>
	    	<non-sugar-update-modal></non-sugar-update-modal>
	    	<non-sugar-delete-modal></non-sugar-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynNonSugarMain.js') }}"></script>
@endsection