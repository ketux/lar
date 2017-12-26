@extends('layouts.app')

@section('content')

<!DOCTYPE html>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>


					<a href="http://localhost/laravelis/svari8/public/posts/create" class="btn btn-primary"> Naujas</a><br><br>

<head>

    <title>Duomenų lentelė</title>

    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">

    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">

    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>

    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

</head>

<body>


<div class="container">
					
  <table id="posts" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Pavadinimas</th>
            <th>Aprašymas</th>
            <th>Kaina</th>
			<th>Veiksmas</th>
				
        </tr>	
		<tbody>
</tbody>



		
    </thead>
	
	

</div>
								

<script type="text/javascript">

$(document).ready(function() {

    oTable = $('#posts').DataTable({

        "processing": true,

        "serverSide": true,

        "ajax": "{{ route('datatable.getposts') }}",

        "columns": [

            {data: 'id', name: 'id'},

            {data: 'pavadinimas', name: 'pavadinimas'},

            {data: 'aprasymas', name: 'aprasymas'},

            {data: 'kaina', name: 'kaina'},
			//{ data: 'actions', name: 'actions', orderable: false, searchable: false },
			
			
        ]

		
    });
	
	
});




</script>

<td>button</td>
</body>


					@if(count ($posts) > 0)
					<table class="table table-striped">
							@foreach($posts as $post)
									<tr>
									<td>		
												{!! Form::open(['action' => ['OrdersController@store', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}						
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


				</div>
			</div>
		</div>
	</div>
</div>





