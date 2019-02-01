@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Užsakymai</div>
				
				
	<!-- search opcija -->
	<div class="row">
		<div class="col-md-8">
				<form method="POST" action='{{url("/orders/search")}}'>
				{{csrf_field() }}
					<div class="input-group">
						<input type="text" name="search" class="form-control" placeholder="Paieska">
						<span class="input-group-btn">
						<button type="submit" class="btn btn-default">Pirmyn </button>
						</span>
					</div>
					</form>
				</div>
				

                <div class="panel-body">
					
					<h3>Užsakyti gaminiai</h3> 
					@if(count ($orders) > 0)
					
						<table class="table table-striped">
							<tr>
								<th>@sortablelink('pavadinimas')</th>
								<th>@sortablelink('aprasymas')</th>
								<th>@sortablelink('kaina')</th>
								<th>@sortablelink('Foto')</th>

							<th>
								<th>Veiksmai</th>		
							</th>							
								</tr>
								@foreach($orders as $order)
									<tr>
										<td><a href="/../nfq2/public/orders/{{$order->id}}">{{ $order->pavadinimas}}</a></td>
										<td>{{$order->aprasymas}}</td>
										<td>{{$order->kaina}}</td>
										<th>	<img style="width:50px" src="/../nfq2/storage/app/public/cover_images/{{$order->cover_image}}">
									</th>
								
										<td>

											{!! Form::open(['action' => ['OrdersControllerKopinam@getCloneOrder', $order->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
																	
											{{Form::submit ('Kopijuoti', ['class' => 'btn btn-primary'])}}
											{!!Form::close()!!}
										</td>
										
										
										<td>
											<a href="/../nfq2/public/orders/{{$order->id}}/edit" class="btn btn-default">Taisyti</a>
										</td>
										
										<td>
												<!-- Atkelta tas pats is show.blade.php -->
												{!! Form::open(['action' => ['OrdersController@destroy', $order->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
													{{Form::hidden ('_method', 'DELETE')}}
													{{Form::submit ('Trynti', ['class' => 'btn btn-danger'])}}
												{!!Form::close()!!}
										</td>

									</tr>
								@endforeach
					</table>
								@else
									<p>Neturite užsakymų</p>
								@endif
				</div>
            </div>
        </div>
    </div>
</div>

		{{$orders->links() }}

@endsection
