@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Ratios on Gross Cane</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<synopsis-ratios-on-gross-cane-list></synopsis-ratios-on-gross-cane-list>
	    	<synopsis-ratios-on-gross-cane-create-modal></synopsis-ratios-on-gross-cane-create-modal>
	    	<synopsis-ratios-on-gross-cane-update-modal></synopsis-ratios-on-gross-cane-update-modal>
	    	<synopsis-ratios-on-gross-cane-delete-modal></synopsis-ratios-on-gross-cane-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynRatiosOnGrossCaneMain.js') }}"></script>
@endsection