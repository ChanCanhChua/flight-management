<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('css/libs/bootstrap/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">
  <script src="{{asset('js/libs/bootstrap/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>

  <title>Đăng Nhập </title>         
  <link href="{{ asset('css/admin/page/common.css') }}" rel="stylesheet">

  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" />
  <script type="text/javascript" src="index.js"></script>
  <script defer  src="{{asset('/js/libs/sweetalert2.all.min.js')}}" ></script>
  <script defer src="{{asset('/js/helper.js')}}" ></script>
  <style>
    .error {
      color: red
    }
  </style>
</head>
<body class="background">
  <div class="container">
  
    <div class="readersack">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h3>Đăng Nhập</h3>
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" id="handleAjax" action="{{url('admin/do-login')}}" name="postform">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{old('email')}}"  class="form-control" />

                
                @csrf
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"   class="form-control" />
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Đăng Nhập</button>
              
              </div>
            </form>
            <button class="btn btn-primary position-absolute top-0 end-0" onclick="openRegisterModal()">Đăng Ký</button>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
  

  <div class="modal" tabindex="-1" id="modalRegister">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Đăng Ký</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formRegisterUser">
        @csrf
          <div class="form-group">
            <label for="registerEmail">Email</label>
            <input type="email" class="form-control" name="email" id="registerEmail" placeholder="Nhập email của bạn">
          </div>
          <div class="form-group">
            <label for="registerPassword">Mật khẩu</label>
            <input type="password" name="password" class="form-control" id="registerPassword" placeholder="Nhập mật khẩu của bạn">
          </div>
          <div class="form-group">
            <label for="confirmPassword">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" class="form-control" id="confirmPassword" placeholder="Xác nhận mật khẩu">
          </div>
          <button type="button" id="formRegisterUserSubmit" class="btn btn-primary">Đăng Ký</button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
  function openRegisterModal() {
   const registerModal = new bootstrap.Modal(document.getElementById('modalRegister'));
   registerModal.show();
}



</script>
<script defer src="{{asset('js/admin/user.js')}}"></script>
</html>