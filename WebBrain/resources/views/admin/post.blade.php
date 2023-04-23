@extends('admin.master')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($posts as $post)
        <tr>
            @php
            $files = explode(',', $post->file);
            @endphp

            <td>{{ $post->title }}</td>
            <td>{{ $post->description }}</td>
            <td>
                @foreach ($files as $file)

                <img src="/files/{{ $file }}" width="100px"><br> @endforeach
            </td>
            <td>
                <form action="{{route('deletePost',$post->id)}}" method="POST">

                    <!-- <a class="btn btn-primary" href="">Edit</a> -->

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</div>
@endsection