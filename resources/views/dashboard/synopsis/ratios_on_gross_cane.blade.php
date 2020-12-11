@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Ratios on Gross Cane</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<ratios-on-gross-cane-list></ratios-on-gross-cane-list>
	    	<ratios-on-gross-cane-create-modal></ratios-on-gross-cane-create-modal>
	    	<ratios-on-gross-cane-update-modal></ratios-on-gross-cane-update-modal>
	    	<ratios-on-gross-cane-delete-modal></ratios-on-gross-cane-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynRatiosOnGrossCaneMain.js') }}"></script>
@endsection