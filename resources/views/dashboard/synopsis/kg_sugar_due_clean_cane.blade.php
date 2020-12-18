@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Additional Kilos of Sugar Due Clean Cane</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<kg-sugar-due-clean-cane-list></kg-sugar-due-clean-cane-list>
	    	<kg-sugar-due-clean-cane-create-modal></kg-sugar-due-clean-cane-create-modal>
	    	<kg-sugar-due-clean-cane-update-modal></kg-sugar-due-clean-cane-update-modal>
	    	<kg-sugar-due-clean-cane-delete-modal></kg-sugar-due-clean-cane-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynKgSugarDueCleanCaneMain.js') }}"></script>
@endsection