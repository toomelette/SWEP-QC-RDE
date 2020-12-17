@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Boiling House Recovery</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<bhr-list></bhr-list>
	    	<bhr-create-modal></bhr-create-modal>
	    	<bhr-update-modal></bhr-update-modal>
	    	<bhr-delete-modal></bhr-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynBHRMain.js') }}"></script>
@endsection