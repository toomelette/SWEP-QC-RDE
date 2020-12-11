@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Cane Analyses</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<cane-analysis-list></cane-analysis-list>
	    	<cane-analysis-create-modal></cane-analysis-create-modal>
	    	{{-- <cane-analysis-update-modal></cane-analysis-update-modal> --}}
	    	{{-- <cane-analysis-delete-modal></cane-analysis-delete-modal> --}}
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynCaneAnalysisMain.js') }}"></script>
@endsection