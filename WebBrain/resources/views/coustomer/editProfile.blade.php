@extends('home')
@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row my-3">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow">
            <div class="card-header bg-primary">
                <h3 class="text-light fw-bold">Update Coustomer Details</h3>
            </div>
            <div class="card-body p-4">
                <form action="{{route('updateProfile')}}" method="POST">
                    @csrf
                    <div class="my-2">
                        <input type="hidden" name="id" value="{{ $user->id}}">
                        <input type="text" name="first_name" id="title"
                            class="form-control @error('first_name') is-invalid @enderror" placeholder="First name"
                            value="{{ $user->first_name}}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <input type="text" name="last_name" id="title"
                            class="form-control @error('title') is-invalid @enderror" placeholder="Last Name"
                            value="{{ $user->last_name}}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-2">
                        <input type="email" name="email" id="title"
                            class="form-control @error('email') is-invalid @enderror" placeholder="First name"
                            value="{{ $user->email}}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-2">
                        <input type="number" name="mobile" id="title"
                            class="form-control @error('mobile') is-invalid @enderror" placeholder="mobile"
                            value="{{ $user->mobile}}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-2">
                        <input type="text" name="address" id="title"
                            class="form-control @error('address') is-invalid @enderror" placeholder="address"
                            value="{{ $user->address}}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-2">
                        <input type="submit" value="update " class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection