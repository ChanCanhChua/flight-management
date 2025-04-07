@extends('layout.admin')
@section('content')
    <div class="row">
        <div class="col-md-6 col-12">
            <h5 class="fw-bold text-center">Thông tin đặt vé</h5>
                <div class="form-group mb-3 flatpickr">
                    <label class="" for="flight_time">Ngày bay</label>
                    <input type="text" class="form-control" id="flight_time" name="flight_time" placeholder="Vui lòng nhập Giờ khởi hành">
                </div>
            
                <div class="form-group  mb-3">
                    <label for="originAPSelect" class="form-label">Sân bay khởi hành</label>
                    <select class="w-100 mb-3" aria-label=""  name="origin_ap_id" id="originAPSelect" >
                        <option selected  value="null">Chọn sân bay khởi hành</option>
                        @forelse ($airports as $airport)
                            <option value="{{$airport->id}}">{{$airport->name}}</option>
                        @empty
                            <option value="">Không có dữ liệu</option>
                        @endforelse
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="destinationAPSelect" class="form-label">Sân bay kết thúc</label>
                    <select class="w-100 mb-3" aria-label=""  name="destination_ap_id" id="destinationAPSelect" >
                        <option selected  value="null">Chọn sân bay kết thúc</option>
                        @forelse ($airports as $airport)
                            <option value="{{$airport->id}}">{{$airport->name}}</option>
                        @empty
                            <option value="">Không có dữ liệu</option>
                        @endforelse
                    </select>
                </div>
        </div>
        <div class="col-md-6 col-12">
            <h5 class="fw-bold text-center">Thông tin khách hàng</h5>

        </div>

    </div>
    <table id="example" class="table" width="100%">
            <thead >
            <tr class="border-1">
                <th class="border-1">id</th>
                <th class="border-1">Khởi hành</th>
                <th class="border-1">Kết thúc</th>
                <th class="border-1">Giá</th>
                <th class="border-1">Giờ khởi hành</th>
                <!-- <th class="border-1">Thao tác</th> -->
            </tr>
            </thead>
        </table>
    <div class="modal fade" id="createTicketModal" tabindex="-1" aria-labelledby=createTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createTicketModalLabel">Tạo chuyến bay</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formCreateFlight">
                        @csrf
                        <div class="mb-3">
                            <label for="originAPSelect" class="form-label">Khởi hành</label>
                            <select class="w-100" aria-label=""  name="origin_ap_id" id="originAPSelect" >
                                <option selected  value="null">Chọn sân bay khởi hành</option>
                                @forelse ($airports as $airport)
                                    <option value="{{$airport->id}}">{{$airport->name}}</option>
                                @empty
                                    <option value="">Không có dữ liệu</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="destinationAPSelect" class="form-label">Kết thúc</label>
                            <select class="w-100" aria-label=""  name="destination_ap_id" id="destinationAPSelect" >
                                <option selected  value="null">Chọn sân bay kết thúc</option>
                                @forelse ($airports as $airport)
                                    <option value="{{$airport->id}}">{{$airport->name}}</option>
                                @empty
                                    <option value="">Không có dữ liệu</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá tiền</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Vui lòng nhập giá tiền">
                        </div>
                        <div class="mb-3 flatpickr d-block">
                            <label for="flight_time" class="form-label">Giờ khởi hành</label>
                            <input type="text" class="form-control" id="flight_time" name="flight_time" placeholder="Vui lòng nhập Giờ khởi hành">
                        </div>
                        <div class="mb-3 d-block">
                            <label for="flight_time" class="form-label">Số ghế</label>
                            <input type="number" class="form-control" id="total_seat" name="total_seat" placeholder="Vui lòng nhập số ghế">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn bg-purple text-white" form="formCreateFlight">Lưu</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')
    <link href="{{ asset('css/admin/page/create-ticket.css') }}" rel="stylesheet">
    <script defer src="{{asset('js/admin/create-ticket.js')}}"></script>
@endpush

