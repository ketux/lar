@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
				
				
	<h1>Redaguoti</h1>
	
	{!! Form::open(['action' => ['OrdersControllerProduct@update', $order->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    
		<div class="form-group">
			{{ Form::label('pavadinimas', 'Pavadinimas')}}
			{{Form::text('pavadinimas', $order->pavadinimas, ['class' => 'form-control', 'placeholder' => 'Pavadinimas'])}}
		</div>
		
		<div class="form-group">
			{{ Form::label('aprasymas', 'Aprasymas')}}
			{{Form::textarea('aprasymas', $order->aprasymas, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body'])}}
		</div>

		<div class="form-group">
			{{ Form::label('kaina', 'Kaina')}}
			{{Form::textarea('kaina', $order->kaina, ['class' => 'form-control', 'placeholder' => 'Kaina'])}}
		</div>
			<div class="form-group">
				{{ Form::file('cover_image')}}	
			</div>
			<!-- PUT request -->
		{{Form::hidden('_method', 'PUT')}}
		{{ Form :: submit('Tinka', ['class' => 'btn btn-primary'])}}
	{!! Form::close() !!}
	
@endsection

				</div>
			</div>
		</div>
	</div>
</div>