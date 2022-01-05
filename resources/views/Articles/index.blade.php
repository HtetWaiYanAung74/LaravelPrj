@extends("layouts.app");

@section("content")
<div class="container">

	@if(session('info')) 
	<div class="alert alert-success">
		{{session('info')}}
	</div>
	@endif

	@foreach($article as $value)
	<div class="card mb-2">
		<div class="card-body">
			<h5 class="card-title">{{$value['title']}}</h5>
			<div class="card-subtitle mb-2 text-muted small"> Posted 
					{{$value->created_at->diffForHumans()}}
			</div>
			<br>
			<p class="card-text"> {{ $value->content }} 
				<a class="card-link" href="{{ url("/articles/detail/$value->id") }}"> 
					View Detail &raquo; 
				</a>
			</p>
			
		</div>
	</div>
	@endforeach 
		
	{{ $article->links('pagination::bootstrap-4') }}
	
</div>

@endsection
	