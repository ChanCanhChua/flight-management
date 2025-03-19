<div class="modal fade" id="passengerModal" tabindex="-1" aria-labelledby="passengerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="passengerModalLabel">Thông Tin Hành Khách</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>
      <div class="modal-body">
        <form id="passengerForm" class="needs-validation" novalidate>
            @csrf
          <div class="form-floating mb-3">
            <input type="text" name="passenger_name" class="form-control" id="floatingPassengerName" placeholder="Tên Hành Khách" required>
            <label for="floatingPassengerName">Tên Hành Khách</label>
            <div class="invalid-feedback">
                    Vui lòng nhập tên khách hàng
            </div>
          </div>
          <div class="form-floating mb-3">
          <input 
                type="tel" 
                class="form-control" 
                id="floatingPassengerTel" 
                placeholder="Số Điện Thoại Hành Khách" 
                name="passenger_tel"
                pattern="^\+?[0-9]{10,15}$" 
                title="Số điện thoại phải có từ 10 đến 15 chữ số và có thể bắt đầu bằng dấu '+'." 
                required>
            <label for="floatingPassengerTel">Số Điện Thoại</label>
            <div class="invalid-feedback">
            Vui lòng nhập số điện thoại hợp lệ
            </div>
          </div>
          <div class="form-floating mb-3">
            <input type="email" name="passenger_email"
            class="form-control" id="floatingPassengerEmail" placeholder="Email Hành Khách" required>
            <label for="floatingPassengerEmail">Email</label>
            <div class="invalid-feedback">
                    Vui lòng nhập email
            </div>
          </div>
         
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="submit" form="passengerForm" class="btn btn-primary">Lưu Thông Tin</button>
      </div>
    </div>
  </div>
</div>
<script  src="{{asset('js/client/validate-bootstrap.js')}}"></script>
