@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Sugar Analyses</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<sugar-analysis-list></sugar-analysis-list>
	    	<sugar-analysis-create-modal></sugar-analysis-create-modal>
	    	<sugar-analysis-update-modal></sugar-analysis-update-modal>
	    	<sugar-analysis-delete-modal></sugar-analysis-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynSugarAnalysisMain.js') }}"></script>
@endsection