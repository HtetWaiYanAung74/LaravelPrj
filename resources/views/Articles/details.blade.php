@extends("layouts.app")

@section("content")

<div class="container">

	@if($errors->any())
	<div class="alert alert-warning">
		<ol>
			@foreach($errors->all() as $value)
			<li> {{$value}} </li>
			@endforeach
		</ol>
	</div>
	@endif

	@if(session('info'))
	<div class="alert alert-success">
		{{ session('info') }}
	</div>
	@endif

	<div class="card mb-2">
		<div class="card-body">
			<h5 class="card-title">{{ $detail->title }}</h5>
			<div class="card-subtitle mb-2 text-muted small">
				Category : <b>{{ $detail->category->name }}</b> <br>
					{{ $detail->created_at->diffForHumans() }}
			</div>
			<p class="card-text"> {{ $detail->content }} </p>
			<a class="btn btn-warning" href="{{ url("/articles/update/$detail->id") }}"> Update </a>
			<a class="btn btn-danger" href="{{ url("/articles/delete/$detail->id") }}"> Delete </a>
		</div>
	</div>

	<ul class="list-group">
		<li class="list-group-item active">
			<b> Comments : ( {{count($detail->comment)}} ) </b> <br>
		</li>

		@foreach($detail->comment as $value)
		<li class="list-group-item active">
			{{ $value->body }}
			<a class="close" href="{{ url("/comment/delete/$value->id") }}">&times;</a>
			<div class="small">
				By <b> {{ $value->user->name }} </b>
				, {{ $value->created_at->diffForHumans() }}
			</div>
		</li>
		@endforeach
	</ul>

	<form method="POST" action="{{ url('/comment/add') }}">
		@csrf
		<input type="hidden" name="article_id" value="{{ $detail->id }}">
		<textarea name="body" class="form-control" placeholder="write your review....."></textarea>
		<input type="submit" name="submit" value="Add Comment" class="btn btn-info">
	</form>

</div>

@endsection