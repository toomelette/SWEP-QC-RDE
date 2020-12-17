@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Overall Recovery</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<oar-list></oar-list>
	    	<oar-create-modal></oar-create-modal>
	    	<oar-update-modal></oar-update-modal>
	    	<oar-delete-modal></oar-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynOARMain.js') }}"></script>
@endsection