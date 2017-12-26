@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
				
				
	<a href="/../laravelis/svari8/public/orders" class="btn btn-default"> Go back</a> 
	<h1>{{$order->title}}</h1>
	
			<div>
					{!!$order->pavadinimas!!}</select>
			</div>	
				
				
	<img style="width:80%" src="/../laravelis/svari8/storage/app/public/cover_images/{{$order->cover_image}}">
	<br>
	<br>
					<div>
					{!!$order->aprasymas!!}</select>
						
					</div>
	<hr>
		<small>Written on {{ $order->created_at}}</small>
		<hr>
		
				<a href="/../laravelis/svari8/public/orders/{{$order->id}}/edit" class="btn btn-default">Edit</a>

		<!-- Forma skirti delete funkcijai -->
					{!! Form::open(['action' => ['OrdersController@destroy', $order->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
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