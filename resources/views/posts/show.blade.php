@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
				
				
	<a href="/../nfq2/public/posts" class="btn btn-default"> Go back</a> 
	<h1>{{$post->title}}</h1>
	
				<div>
					{!!$post->pavadinimas!!}</select>
				</div>	
				
	<img style="width:100%" src="/../nfq2/storage/app/public/cover_images/{{$post->cover_image}}">
	<br>
	<br>
					<div>
					{!!$post->aprasymas!!}</select>
						
					</div>
	<hr>
		<small>Written on {{ $post->created_at}}</small>
		<hr>
		
					<td>
						{!! Form::open(['action' => ['PostControllerKopinam@getClonePost', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}							
						{{Form::submit ('Kopijuoti', ['class' => 'btn btn-primary'])}}
						{!!Form::close()!!}
					</td>
		
					<td>
						{!! Form::open(['action' => ['OrdersController@getClone', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}				
						{{Form::submit ('Perku', ['class' => 'btn btn-success'])}}
						{!!Form::close()!!}												
					</td>
					
					
		<a href="/../nfq2/public/posts/{{$post->id}}/edit" class="btn btn-default">Taisyti</a>

<!-- Forma skirti delete funkcijai -->
			{!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
				<!-- DELETE request -->
				{{Form::hidden ('_method', 'DELETE')}}
				{{Form::submit ('Trynti', ['class' => 'btn btn-danger'])}}
			{!!Form::close()!!}
		
@endsection

				</div>
			</div>
		</div>
	</div>
</div>