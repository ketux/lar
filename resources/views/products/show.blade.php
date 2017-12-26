@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
				
				
	<a href="/../laravelis/svari8/public/kita" class="btn btn-default"> Go back</a> 
	<h1>{{$product->title}}</h1>
	
				<div>
					{!!$product->pavadinimas!!}</select>
				</div>	
				
	<img style="width:80%" src="/../laravelis/svari8/storage/app/public/cover_images/{{$product->cover_image}}">
	<br>
	<br>
					<div>
					{!!$product->aprasymas!!}</select>
						
					</div>
	<hr>
		<small>Written on {{ $product->created_at}} by</small>
		<hr>
		
				<a href="/../laravelis/svari8/public/products/{{$product->id}}/edit" class="btn btn-default">Edit</a>
				
				<td>
						{!! Form::open(['action' => ['OrdersControllerProduct@getClone', $product->id], 'method' => 'POST', 'class' => 'pull-right'])!!}				
						{{Form::submit ('Order', ['class' => 'btn btn-success'])}}
						{!!Form::close()!!}
					</td>	

		<!-- Forma skirti delete funkcijai -->
					{!! Form::open(['action' => ['SearchPostsController@destroy', $product->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
						<!-- DELETE request -->
						{{Form::hidden ('_method', 'DELETE')}}
						{{Form::submit ('Delete', ['class' => 'btn btn-danger'])}}
					{!!Form::close()!!}
		
@endsection

				</div>
			</div>
		</div>
	</div>
</div>