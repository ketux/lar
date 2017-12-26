@extends('layouts.app') 
 	
@section('content')

<!DOCTYPE html>

<html>

<head>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>

	<a href="/../laravelis/svari8/public/ieskau" class="btn btn-default"> Go back</a> 


<div class="container">

    <h3 class="text-center">Laravel 6 - Column sorting with pagination example from scratch</h3><br>
	
			<h1>Paieškos rezultatai</h1>
	
	<br><br><br>

    <table class="table table-bordered">

        <tr>

            <th width="80px">@sortablelink('id')</th>
            <th>@sortablelink('pavadinimas')</th>
            <th>@sortablelink('aprasymas')</th>
			<th>@sortablelink('kaina')</th>
			 <th>@sortablelink('Foto')</th>
            <th>@sortablelink('sukurta')</th>
			<th></th>

        </tr>

        @if($products->count())

            @foreach($products as $key => $product)

                <tr>

                    <td>{{ $product->id }}</td>
					<td><a href="/../laravelis/svari8/public/products/{{$product->id}}">{{ $product->pavadinimas}}</a></td>
                    <td>{{ $product->aprasymas }}</td>
					<td>{{ $product->kaina }}</td>
					<td>{{ $product->cover_image }}</td>
                    <td>{{ $product->created_at->format('d-m-Y') }}</td>
					
					<td>
                                                
                                                {!! Form::open(['action' => ['OrdersControllerProduct@getClone', $product->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                    
                                                    {{Form::submit ('Order', ['class' => 'btn btn-success'])}}
                                                {!!Form::close()!!}
                                        </td>

                                        <td><a href="/../laravelis/svari8/public/products/{{$product->id}}/edit" class="btn btn-default">Edit</a></td>
										
										<td>
											<!-- Atkelta tas pats is show.blade.php -->
											{!! Form::open(['action' => ['SearchPostsController@destroy', $product->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
											{{Form::hidden ('_method', 'DELETE')}}
											{{Form::submit ('Delete', ['class' => 'btn btn-danger'])}}
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