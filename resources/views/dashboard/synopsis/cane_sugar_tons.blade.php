@extends('layouts.admin-master')

@section('content')

	<section class="content-header">
		<h1>Cane-Sugar Tons</h1>
	</section>

	<section class="content">

	    <div id="app">
	    	<synopsis-cane-sugar-tons-list></synopsis-cane-sugar-tons-list>
	    	<synopsis-cane-sugar-tons-create></synopsis-cane-sugar-tons-create>
	    </div>

	</section>

@endsection


@section('vueScripts')

	<script type="text/javascript" src="{{ asset('js/CaneSugarTonsMain.js') }}"></script>

@endsection

@section('scripts')

	<script type="text/javascript">

		$(".priceformat").priceFormat({
            prefix: "",
            thousandsSeparator: ",",
            clearOnEmpty: true,
            allowNegative: true
        });

	</script>

@endsection