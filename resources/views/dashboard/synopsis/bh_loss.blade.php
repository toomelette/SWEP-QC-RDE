@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>BH Losses</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<bh-loss-list></bh-loss-list>
	    	<bh-loss-create-modal></bh-loss-create-modal>
	    	<bh-loss-update-modal></bh-loss-update-modal>
	    	<bh-loss-delete-modal></bh-loss-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynBHLossMain.js') }}"></script>
@endsection