@extends("layouts.app")

@section("content")

<div class="container">

	<form method="POST" action="{{url('/articles/update/'.$edit['id'])}}">
		<!-- cross-site request forgery -->
		@csrf
		<div class="form-group">
			<label>Title</label>
			<input type="text" name="title" class="form-control" value="{{$edit->title}}">
		</div>
		<div class="form-group">
			<label>Content</label>
			<textarea name="content" class="form-control">{{$edit->content}}</textarea>
		</div>
		<div class="form-group">
			<label>Category</label>
			<select class="form-control" name="category_id">
				<option value="{{ $edit->category->id }}"> {{ $edit->category->name }}	
				@foreach($category as $value)
				</option>
				<option value="{{ $value->id }}">{{ $value->name }}</option>
				@endforeach
			</select>
		</div>
		<br>
		<input type="submit" name="submit" value="Update Article" class="btn btn-primary">
	</form>
</div>

@endsection