@extends('layouts.app') 
 	
@section('content')

	<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
			

	<h1>Paieškos rezultatai</h1>
	
	

	<div class="panel-body">
					@if(count ($posts) >0)
						   
						 <!--norint, kad rodytų tik konkretaus userio postus -->


						<table class="table table-striped">
							<thead>
							<tr>
								<th>Pavadinimas</th>
								<th>Aprasymas</th>
								<th>Kaina</th>
								<th>Foto</th>

								<th>
									<th>Veiksmai</th>
								</th>
								
							</tr>
							</thead>	
								@foreach($posts as $post)
									<tr>
										<td><a href="/../nfq2/public/posts/{{$post->id}}">{{ $post->pavadinimas}}</a></td>
										<td>{{$post->aprasymas}}</td>
										<td>{{$post->kaina}}</td>
										<td>	<img style="width:50px" src="/../nfq2/storage/app/public/cover_images/{{$post->cover_image}}">
									</tr>

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

										<td><a href="/../nfq2/public/posts/{{$post->id}}/edit" class="btn btn-default">Taisyti</a></td>
										
										<td>
												<!-- Atkelta tas pats is show.blade.php -->
												{!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
													{{Form::hidden ('_method', 'DELETE')}}
													{{Form::submit ('Trynti', ['class' => 'btn btn-danger'])}}
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