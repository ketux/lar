@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
				
				
	<a href="/../nfq2/public/orders" class="btn btn-default"> Go back</a> 
	<h1>{{$order->title}}</h1>
	
			<div>
					{!!$order->pavadinimas!!}</select>
			</div>	
				
				
	<img style="width:80%" src="/../nfq2/storage/app/public/cover_images/{{$order->cover_image}}">
	<br>
	<br>
					<div>
					{!!$order->aprasymas!!}</select>
						
					</div>
	<hr>
		<small>Written on {{ $order->created_at}}</small>
		<hr>
		

									<td>
											{!! Form::open(['action' => ['OrdersControllerKopinam@getCloneOrder', $order->id], 'method' => 'POST', 'class' => 'pull-right'])!!}							
											{{Form::submit ('Kopijuoti', ['class' => 'btn btn-primary'])}}
											{!!Form::close()!!}
										</td>

                                        <td><a href="/../nfq2/public/orders/{{$order->id}}/edit" class="btn btn-default">Taisyti</a></td>
									
									<td>
												<!-- Atkelta tas pats is show.blade.php -->
												{!! Form::open(['action' => ['OrdersController@destroy', $order->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
													{{Form::hidden ('_method', 'DELETE')}}
													{{Form::submit ('Trynti', ['class' => 'btn btn-danger'])}}
												{!!Form::close()!!}
										</td>
		
@endsection

				</div>
			</div>
		</div>
	</div>
</div>