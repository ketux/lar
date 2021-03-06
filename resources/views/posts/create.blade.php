@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
				
				
	<h1>Sukurti</h1>
	
	{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} 
	<!-- multipart naudojamas kad galetum uploadint images -->
    
		<div class="form-group">
			{{ Form::label('pavadinimas', 'Pavadinimas')}}
			{{Form::text('pavadinimas', '', ['class' => 'form-control', 'placeholder' => 'Pavadinimas'])}}
		</div>
		


		<div class="form-group">
			{{ Form::label('aprasymas', 'Aprasymas')}}
			{{Form::textarea('aprasymas', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Aprasymas'])}}
		</div>

		<div class="form-group">
			{{ Form::label('kaina', 'Kaina')}}
			{{Form::text('kaina', '', ['class' => 'form-control', 'placeholder' => 'Kaina'])}}
		</div>
		
		<div class="form-group">
			{{ Form::file('cover_image')}}	
		</div>
		
						
		{{ Form :: submit('Tinka', ['class' => 'btn btn-primary'])}}
	{!! Form::close() !!}
	
@endsection

				</div>
			</div>
		</div>
	</div>
</div>