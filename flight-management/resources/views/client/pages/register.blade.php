<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng Ký</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/client/page/login.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/fontawesome-free-6.6.0-web/css/all.min.css') }}">
  <link href="{{ asset('css/libs/bootstrap/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
  <script src="{{ asset('js/libs/bootstrap/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
</head>
<body>

<div class="container-login">
  <div class="out-login">
    <!-- Form đăng ký -->
    <form method="POST" action="{{ route('client.register') }}">
      @csrf  <!-- CSRF Token để bảo vệ form -->

      <div class="form-group">
        <label for="name">Tên</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên của bạn" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Nhập email của bạn" required>
      </div>

      <div class="form-group">
        <label for="password">Mật khẩu</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu của bạn" required>
      </div>

      <div class="form-group">
        <label for="password_confirmation">Xác nhận mật khẩu</label>
        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Xác nhận mật khẩu" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>

      <!-- Nút quay lại trang chủ và đăng nhập -->
      <div class="form-group d-flex justify-content-between mt-3">
        <a href="{{ route('client.pages.home') }}" class="btn btn-secondary">Về trang chủ</a>
        <a href="{{ route('login') }}" class="btn btn-link">Đã có tài khoản? Đăng nhập</a>
      </div>
      
    </form>
  </div>
</div>

<!-- Hiển thị lỗi nếu có -->
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

</body>
</html>
