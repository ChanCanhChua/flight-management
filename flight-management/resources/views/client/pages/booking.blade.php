@extends('layout.client')
@section('content') 
<div class="container">

<a href="{{ route('client.pages.home') }}" class="btn btn-secondary mb-3">
    <i class="fa-solid fa-arrow-left"></i> Quay về Trang Chủ
</a>

            
<form id="flightForm" class="container-searching" action="{{ route('booking.index') }}">
                    <select class="form-select" aria-label="Default select example" name="origin_ap">
                        @if(!$currentOriginAP)
                        <option value="" selected> Chọn Nơi Đi <i class="fa-solid fa-plane-departure"></i> </option>
                        @endif
                        @forelse ($origin_aps as $airport)
                                    <option value="{{$airport->id}}" 
                                    @if($currentOriginAP == $airport->id) 
                                    selected 
                                    @endif
                                    >{{$airport->city->name}}</option>
                                @empty
                                    <option value="">Không có dữ liệu</option>
                        @endforelse
                    </select>

                    <select class="form-select" aria-label="Default select example" name="destination_ap">
                        @if(!$currentDestinationAP)
                        <option  value="" selected>Chọn Nơi Đến</option>
                        @endif
                        @forelse ($destination_aps as $airport)
                                    <option value="{{$airport->id}}"
                                    @if($currentDestinationAP == $airport->id)
                                    selected 
                                    @endif
                                    >{{$airport->city->name}}</option>
                                @empty
                                    <option value="">Không có dữ liệu</option>
                        @endforelse
                    </select>

                        <input type="text" name="flight_time"  id="flight_time" class="date-searching flatpickr my-auto" placeholder="Chọn ngày đi">

                    <select class="form-select" aria-label="Default select example" name="quantity">
                        @if(!$quantity)
                            <option value="" selected>Chọn số lượng vé</option>
                        @endif
                        @for ($i = 1; $i <= 100; $i++)
                            <option  
                            @if($quantity == $i)
                                selected 
                            @endif
                            value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>

                    <button type="submit" class="btn-searching w-100">Tìm Vé</button>
                </form>
</div>
</div>
<div class="container-ticket d-flex">
    
    @include('client.partials.booking.flight-list', ['$flight_list' => $flight_list])
</div>

@endsection

@push('head')
    <link href="{{ asset('css/client/page/datve.css') }}" rel="stylesheet">
    
    <script defer src="{{asset('js/client/booking.js')}}"></script>

@endpush