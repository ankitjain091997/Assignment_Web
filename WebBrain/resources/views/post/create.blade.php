@extends('home')
@section('content')
<div class="row my-3">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow">
            <div class="card-header bg-primary">
                <h3 class="text-light fw-bold">Add New Post</h3>
            </div>
            <div class="card-body p-4">
                <form action="{{route('submitPost')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-2">
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror" placeholder="Title"
                            value="{{ old('title') }}">
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="my-2">
                        <span>choose multiple file</span>
                        <input type="file" multiple name="file[]" id="file" accept="image/*"
                            class="form-control @error('file') is-invalid @enderror" placeholder="choose multiple file">
                        @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <textarea name="description" id="content" rows="6"
                            class="form-control @error('content') is-invalid @enderror"
                            placeholder="Post Content">{{ old('content') }}</textarea>
                        @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <input type="submit" value="Add Post" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection