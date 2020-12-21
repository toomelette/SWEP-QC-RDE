@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Grinding Stopagges</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<detail-of-stoppage-a-list></detail-of-stoppage-a-list>
	    	<detail-of-stoppage-a-create-modal></detail-of-stoppage-a-create-modal>
	    	<detail-of-stoppage-a-update-modal></detail-of-stoppage-a-update-modal>
	    	<detail-of-stoppage-a-delete-modal></detail-of-stoppage-a-delete-modal>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynDetailOfStoppageAMain.js') }}"></script>
@endsection