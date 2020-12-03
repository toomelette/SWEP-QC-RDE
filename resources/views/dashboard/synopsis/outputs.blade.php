@extends('layouts.admin-master')


@section('content')

	<section class="content-header">
		<h1>Outputs / Reports</h1>
	</section>

	<section class="content">

	    <div id="app">
            <outputs></outputs>
	    </div>

	</section>

@endsection


@section('vueScripts')
	<script type="text/javascript" src="{{ asset('js/SynOutputsMain.js') }}"></script>
@endsection