<html>

<head>
    <title> Login In </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .root {
            width: 600px;
            margin: 0 auto;
            margin-top: 200px;
            border: 1px solid #ccc;
        }
    </style>
</head>



<body>
    <div class="root">
        <br />
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </div>


        @endif
        <form method="POST" action="{{ route('login.register') }}" enctype="multipart/form-data">
            @csrf
            <div style="margin-left: 20px;">
                <div class="form-group" id="name-field" style="display: none;">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{old('name')}}">

                </div>
                <div class="form-group" id="image-field" style="display: none;">
                    <label for="name">image</label> <input id="name" type="file" value="{{old('file')}}" name="file">


                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input id="email" type="email" name="email" value="{{old('email')}}" autofocus>

                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" value="{{old('password')}}" required autofocus>

                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="register" id="register">
                    <label class="form-check-label" for="register">Register</label>
                    <span> (if you not register then click on register)</span>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('register').addEventListener('change', function() {
            document.getElementById('name-field').style.display = this.checked ? 'block' : 'none';
            document.getElementById('image-field').style.display = this.checked ? 'block' : 'none';
        });
    </script>

</body>

</html>