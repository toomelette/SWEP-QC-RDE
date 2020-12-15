@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Clarification Juice</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<clarification-list></clarification-list>
	    	<clarification-create-modal></clarification-create-modal>
	    	<clarification-update-modal></clarification-update-modal>
	    	<clarification-delete-modal></clarification-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynClarificationMain.js') }}"></script>
@endsection