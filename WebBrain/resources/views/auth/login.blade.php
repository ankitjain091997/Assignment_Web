<html>

<head>
    <title> Login In </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
    .box {
        width: 600px;
        margin: 0 auto;
        margin-top: 200px;
        border: 1px solid #ccc;
    }
    </style>
</head>

<body>
    <br />
    <div class="container box">
        <h3 align="center"> Login in Webtrain</h3><br />


        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="post" action="{{route('login')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Enter Email</label>
                <input type="email" name="email" class="form-control" />
            </div>
            <div class="form-group">
                <label>Enter Password</label>
                <input type="password" name="password" class="form-control" />
            </div>
            <div class="form-group">
                <input type="submit" name="login" class="btn btn-primary" value="Login" />
            </div>
        </form>
        <div class="form-group">
            <a href="{{route('registration')}}" class="btn btn-success">Registration
                </button></a>
        </div>
    </div>
</body>

</html>