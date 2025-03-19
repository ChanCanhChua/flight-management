<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Readerstacks laravel 8 Custom login and registration </title>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" />
  <script type="text/javascript" src="index.js"></script>
  <style>
    .error {
      color: red
    }
  </style>
</head>
<body class="antialiased">
  <div class="container">
    <!-- main app container -->
    <div class="readersack">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h3>laravel 8 Custom Registration - Readerstacks</h3>

            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            <form method="post" id="handleAjax" action="{{url('admin/do-register')}}" name="postform">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" />
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control" />
                @csrf
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" />
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" />
              </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">REGISTER</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- credits -->
    <div class="text-center">
      <p>
        <a href="#" target="_top">laravel 8 Custom login and registration </a>
      </p>
      <p>
        <a href="https://readerstacks.com" target="_top">readerstacks.com</a>
      </p>
    </div>
  </div>
</body>

</html>