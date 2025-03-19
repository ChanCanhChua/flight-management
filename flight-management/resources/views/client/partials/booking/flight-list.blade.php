<div class="flight-list">
    @forelse ($flight_list as $item)
        <div class="flight" data-id="{{$item->id}}" data-time="{{$current_flight_time}}">
            <div class="details">
                <div class="airline">{{$item->flight->originAirport->name}} đến {{$item->flight->destinationAirport->name}} </div>
                <div class="time">Giờ bay dự kiến {{$item->duration}} tiếng</div>
                <div class="route">
                    <span class="text-danger">Thời gian bắt đầu:</span>
                    {{\Carbon\Carbon::parse($current_flight_time.' '.$item->flight_time)->format('Y-m-d g:iA')}}
                </div>
                
                <div class="stops">
                    <span class="text-success">Thời gian kết thúc:</span>
                {{\Carbon\Carbon::parse($item->flight_time)->addHours($item->duration)->format('Y-m-d g:iA')}}
                </div>
                @if($item->remaining_seats > 0)
                <div class="route quantity-remain" data-remain="{{$item->remaining_seats}}">Số lượng còn: <span>{{$item->remaining_seats}}</span></div>
                @else
                <div class="text-danger">Hết vé</div>
                @endif

                <!--  <div class="layover">2h 45m in HNL</div> -->
            </div>
            <div class="wrap-action d-flex flex-column">
                <div class="price my-auto" data-price="{{$item->flight->price}}">{{number_format($item->flight->price, 0, ',', '.')}} <span>VNĐ</span></div>
                <div class="action-item d-flex align-items-center invisible">
                    <button class="btn text-danger btn-remove"><i class="fa-solid fa-trash"></i></button>
                    <p class="d-flex align-items-center gap-2 mb-0">
                        <button class="btn minus"><i class="fa-solid fa-minus"></i></button>
                        <input width="fit-content" class="text-center qty border-0 "   style="max-width: 40px;" id="qty1" type="number" value="1" />
                        <button class="btn add"><i class="fa-solid fa-plus"></i></button>
                    </p>
                    
                </div>
            </div>
            <button class="search-btn btn-choosing my-auto"    
            @if($item->remaining_seats <= 0) disabled  @endif>Chọn Vé</button>            </div>
    @empty
    <div class="text-center my-auto">Không tìm thấy vé</div>
    @endforelse
</div>
<div class="flight-list2">
    <div id="selected-flight"></div>
    <div class="show_text__details">
        <div class="d-flex fw-bold justify-content-between"> Tiền vé: <span class="text-show price" id="booking-price">0 VNĐ</span></div>
        <div class="d-flex fw-bold justify-content-between"> Thuế vé (10%): <p class="text-show" id="vat-price">0 VNĐ</p></div>
        <div class="d-flex fw-bold justify-content-between"> Tổng vé: <p class="text-show" id="total-price">0 VNĐ</p> </div>
    </div>

    <div class="confirm-ticket"> 
        <button class="confirm-button d-none" data-bs-toggle="modal" data-bs-target="#passengerModal">Xác Nhận</button>
    </div>
    
</div>
@include('client.partials.booking.user-info')

    <script  src="{{asset('js/client/flight-list.js')}}"></script>
