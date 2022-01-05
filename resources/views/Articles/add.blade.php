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
	<form method="POST" action="">
		<!-- cross-site request forgery -->
		@csrf
		<div class="form-group">
			<label>Title</label>
			<input type="text" name="title" class="form-control">
		</div>
		<div class="form-group">
			<label>Content</label>
			<textarea name="content" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label>Category ID</label>
			<select class="form-control" name="category_id">
				@foreach($category as $value)
				<option value="{{ $value->id }}">{{ $value->name }}</option>
				@endforeach
			</select>
		</div>
		<br>
		<input type="submit" name="submit" value="Add Article" class="btn btn-primary">
	</form>
</div>

@endsection