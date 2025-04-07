<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng Nhập </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/client/page/login.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/fontawesome-free-6.6.0-web/css/all.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="{{asset('css/libs/bootstrap/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">
    <script src="{{asset('js/libs/bootstrap/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body>

<div class="container-login"> 


  <div class="out-login">
    <!-- Form đăng nhập -->
    <form method="POST" action="{{ route('login') }}" id="loginForm">
      @csrf  <!-- CSRF Token để bảo vệ form -->
      
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
      </div>
      
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Remember me</label>
      </div>
      
      <button type="submit" class="btn btn-primary">Submit</button>

      <div class="form-group d-flex justify-content-between mt-3">
        <a href="{{ route('client.pages.home') }}" class="btn btn-secondary">Về trang chủ</a>
        <a href="{{ route('client.register') }}" class="btn btn-link">Chưa có tài khoản? Đăng ký</a>
      </div>

    </form>

  </div>
</div>


</body>
</html>