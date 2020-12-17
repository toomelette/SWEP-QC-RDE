@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Additional Kilos of Sugar Due Mill and Boiling House</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<kg-sugar-due-bh-list></kg-sugar-due-bh-list>
	    	<kg-sugar-due-bh-create-modal></kg-sugar-due-bh-create-modal>
	    	<kg-sugar-due-bh-update-modal></kg-sugar-due-bh-update-modal>
	    	<kg-sugar-due-bh-delete-modal></kg-sugar-due-bh-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynKgSugarDueBHMain.js') }}"></script>
@endsection