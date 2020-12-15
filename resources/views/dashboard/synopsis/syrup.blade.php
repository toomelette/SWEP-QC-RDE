@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Syrup</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<syrup-list></syrup-list>
	    	<syrup-create-modal></syrup-create-modal>
	    	<syrup-update-modal></syrup-update-modal>
	    	<syrup-delete-modal></syrup-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynSyrupMain.js') }}"></script>
@endsection