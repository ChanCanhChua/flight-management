<div class="shadow bg-white p-3">
    <div class="d-flex gap-2 align-items-center">
        <h2 class="flex-grow-1">{{$pageName ??''}}</h2>
        <!-- Modal Đăng Nhập -->
<div class="modal" tabindex="-1" id="modalLogin">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Đăng Nhập</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formLoginUser"   method="GET">
        @csrf
          <div class="form-group">
            <label for="loginEmail">Email</label>
            <input type="email" name="email" class="form-control" id="loginEmail" placeholder="Nhập email của bạn">
          </div>
          <div class="form-group">
            <label for="loginPassword">Mật khẩu</label>
            <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Nhập mật khẩu của bạn">
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="rememberLogin">
            <label class="form-check-label" for="rememberLogin">Ghi nhớ đăng nhập</label>
          </div>
          <button type="button" id="formLoginUserSubmit" class="btn btn-primary">Đăng Nhập</button>
        </form>
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
 
<div class="auth-user">
<form method="GET" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
</div>



        <script>
           

function openRegisterModal() {
  const registerModal = new bootstrap.Modal(document.getElementById('modalRegister'));
  registerModal.show();
}

        </script>

        <div class="rounded-circle" style="width: 18px; height: 18px">
            <svg viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#494c4e" d="M9 0a9 9 0 0 0-9 9 8.654 8.654 0 0 0 .05.92 9 9 0 0 0 17.9 0A8.654 8.654 0 0 0 18 9a9 9 0 0 0-9-9zm5.42 13.42c-.01 0-.06.08-.07.08a6.975 6.975 0 0 1-10.7 0c-.01 0-.06-.08-.07-.08a.512.512 0 0 1-.09-.27.522.522 0 0 1 .34-.48c.74-.25 1.45-.49 1.65-.54a.16.16 0 0 1 .03-.13.49.49 0 0 1 .43-.36l1.27-.1a2.077 2.077 0 0 0-.19-.79v-.01a2.814 2.814 0 0 0-.45-.78 3.83 3.83 0 0 1-.79-2.38A3.38 3.38 0 0 1 8.88 4h.24a3.38 3.38 0 0 1 3.1 3.58 3.83 3.83 0 0 1-.79 2.38 2.814 2.814 0 0 0-.45.78v.01a2.077 2.077 0 0 0-.19.79l1.27.1a.49.49 0 0 1 .43.36.16.16 0 0 1 .03.13c.2.05.91.29 1.65.54a.49.49 0 0 1 .25.75z"></path> </g></svg>
        </div>
    </div>
</div>


