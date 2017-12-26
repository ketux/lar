@extends('layouts.app') 
 	
@section('content')

	
					<a href="http://localhost/laravelis/svari8/public/posts/create" class="btn btn-primary"> Naujas</a>

	<h1>Gaminiai</h1>
	
	<div class="row">
				<div class="col-md-8">
				<form method="POST" action='{{url("/table/search")}}'>
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
					@if(count ($posts) >0)
						   
						 <!--norint, kad rodytų tik konkretaus userio postus -->


						<table class="table table-striped">
							<thead>
							<tr>
									<th>@sortablelink('pavadinimas')</th>
									<th>@sortablelink('aprasymas')</th>
									<th>@sortablelink('kaina')</th>
									 <th>@sortablelink('Foto')</th>
									<th>@sortablelink('sukurta')</th>

								<th></th>
								<th></th>
								<th></th>
							</tr>
							</thead>	
								@foreach($posts as $post)
									<tr>
										<td><a href="/../laravelis/svari8/public/posts/{{$post->id}}">{{ $post->pavadinimas}}</a></td>
										<td>{{$post->aprasymas}}</td>
										<td>{{$post->kaina}}</td>
										<!--<td>{{$post->cover_image}}</td> -->
									<td>

										
									
												{!! Form::open(['action' => ['OrdersController@getClone', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
													
													{{Form::submit ('Order', ['class' => 'btn btn-success'])}}
												{!!Form::close()!!}
										</td>

										<td><a href="http://localhost/laravelis/svari8/public/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
										
										<td>
												<!-- Atkelta tas pats is show.blade.php -->
												{!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
													{{Form::hidden ('_method', 'DELETE')}}
													{{Form::submit ('Delete', ['class' => 'btn btn-danger'])}}
												{!!Form::close()!!}
										</td>
										</tr>

								@endforeach
								{{$posts->links() }}
							
								
								
									
					</table>

								@else
									<p>Nėra prekių</p>
								@endif
				
@endsection