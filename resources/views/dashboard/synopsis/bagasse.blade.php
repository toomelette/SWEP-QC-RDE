@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Bagasse</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<bagasse-list></bagasse-list>
	    	<bagasse-create-modal></bagasse-create-modal>
	    	<bagasse-update-modal></bagasse-update-modal>
	    	<bagasse-delete-modal></bagasse-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynBagasseMain.js') }}"></script>
@endsection