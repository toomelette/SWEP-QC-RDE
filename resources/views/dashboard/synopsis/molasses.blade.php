@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Molasses</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<molasses-list></molasses-list>
	    	<molasses-create-modal></molasses-create-modal>
	    	<molasses-update-modal></molasses-update-modal>
	    	<molasses-delete-modal></molasses-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynMolassesMain.js') }}"></script>
@endsection