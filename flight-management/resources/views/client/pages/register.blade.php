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
  <button class="btn-authen" > <a href="" class="link-login">Đăng Nhập</a></button>
  <button class="btn-authen"  >Đăng Ký</button>
</div>