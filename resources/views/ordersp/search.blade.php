@extends('layouts.app') 
 	
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
	

	<h1>Paieškos rezultatai</h1>
	
	

	<div class="panel-body">
					@if(count ($orders) >0)
						   
						 <!--norint, kad rodytų tik konkretaus userio postus -->


						<table class="table table-striped">
							<thead>
							<tr>
								<th>Pavadinimas</th>
								<th>Aprasymas</th>
								<th>Kaina</th>
								<th>Foto</th>

								<th></th>
								<th></th>
							</tr>
							</thead>	
								@foreach($orders as $order)
									<tr>
										<td><a href="/../laravelis/svari8/public/ordersp/{{$order->id}}">{{ $order->pavadinimas}}</a></td>
										<td>{{$order->aprasymas}}</td>
										<td>{{$order->kaina}}</td>
										<!--<td>{{$order->cover_image}}</td> -->
									
										<td>
                                                
                                                {!! Form::open(['action' => ['OrdersControllerProduct@getClone', $order->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                    
                                                    {{Form::submit ('Order', ['class' => 'btn btn-success'])}}
                                                {!!Form::close()!!}
                                        </td>

                                        <td><a href="/../laravelis/svari8/public/ordersp/{{$order->id}}/edit" class="btn btn-default">Edit</a></td>
									
									<td>
												<!-- Atkelta tas pats is show.blade.php -->
												{!! Form::open(['action' => ['OrdersControllerProduct@destroy', $order->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
													{{Form::hidden ('_method', 'DELETE')}}
													{{Form::submit ('Delete', ['class' => 'btn btn-danger'])}}
												{!!Form::close()!!}
										</td>
										
										</tr>

								@endforeach
								
							
								
								
									
					</table>

								@else
									<p>Nėra prekių</p>
								@endif
				
@endsection

	
			</div>
		</div>
	</div>
</div>