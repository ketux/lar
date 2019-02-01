@extends('layouts.app') 
 	
@section('content')

<!DOCTYPE html>

<html>

<head>

    <title>Laravel 5 - Column sorting with pagination example from scratch</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>

	<a href="/../nfq2/public/ieskau" class="btn btn-default"> Go back</a> 


<div class="container">

    <h3 class="text-center">Laravel 5 - Column sorting with pagination example from scratch</h3><br>
	
			<div class="row">
				<div class="col-md-8">
				<form method="POST" action='{{url("/search")}}'>
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

    <table class="table table-bordered">

        <tr>

            <th width="80px">@sortablelink('id')</th>
            <th>@sortablelink('pavadinimas')</th>
            <th>@sortablelink('aprasymas')</th>
			<th>@sortablelink('kaina')</th>
			 <th>@sortablelink('Foto')</th>
            <th>@sortablelink('sukurta')</th>
			
			<th>
			<th>Veiksmai</th>
			</th>

        </tr>

        @if($products->count())

            @foreach($products as $key => $product)

                <tr>

                    <td>{{ $product->id }}</td>
                    <td>{{ $product->pavadinimas }}</td>
                    <td>{{ $product->aprasymas }}</td>
					<td>{{ $product->kaina }}</td>
					<td>	<img style="width:50px" src="/../nfq2/storage/app/public/cover_images/{{$post->cover_image}}">
	</td>                    
					<td>{{ $product->created_at->format('d-m-Y') }}</td>
					
					<td>
						<!-- Atkelta tas pats is show.blade.php -->
						{!! Form::open(['action' => ['SearchPostsController@destroy', $product->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
						{{Form::hidden ('_method', 'DELETE')}}
						{{Form::submit ('Trynti', ['class' => 'btn btn-danger'])}}
						{!!Form::close()!!}
					</td>

                </tr>

            @endforeach

        @endif

    </table>

   

</div>

</body>
</html>

@endsection