@extends('layouts.app') 
 	
@section('content')

	<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
						
						<a href="/../laravelis/svari7/public/posts/create" class="btn btn-primary"> Naujas</a>


	<h1>Gaminiai</h1>
	
	<div class="row">
				<div class="col-md-8">
				<form method="POST" action='{{url("/posts/search")}}'>
				{{csrf_field() }}
					<div class="input-group">
						<input type="text" name="search" class="form-control" placeholder="Paieska">
						<span class="input-group-btn">
						<button type="submit" class="btn btn-default">Pirmyn </button>
						</span>
					</div>
					</form>
				</div>
	<br><br><br>

	@if(count ($posts)>0)
		@foreach($posts as $post)
		
		
			<div class="well"> 
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<img style="width:250px" src="http://localhost/laravelis/svari8/storage/app/public/cover_images/{{$post->cover_image}}">
					</div>
					
					<div class="col-md-8 col-sm-8">
						<h3><a href="http://localhost/laravelis/svari8/public/posts/{{$post->id}}">{{ $post->pavadinimas}}</a></h3>
						<small>Written on {{ $post->created_at}}</small>
					</div>
				
			</div
												<tr>																	
													<td>
																{!! Form::open(['action' => ['OrdersController@getClone', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}	
																{{Form::submit ('Order', ['class' => 'btn btn-success'])}}
																{!!Form::close()!!}
																
																<a href="/../laravelis/svari8/public/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
														</td>
											
														<td>
																<!-- Atkelta tas pats is show.blade.php -->
																{!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
																	{{Form::hidden ('_method', 'DELETE')}}
																	{{Form::submit ('Delete', ['class' => 'btn btn-danger'])}}
																{!!Form::close()!!}
														</td>
												</tr>
														
											
			
		@endforeach

			<!-- paginacija -->
			{{$posts->links() }}
	@else
		<p>Nieko nera</p>
	@endif
@endsection

				</div>
			</div>
		</div>
	</div>
</div>