@extends('layout.admin')
@section('content')
    <div>
        <table id="example" class="table" width="100%">
            <thead >
                <tr class="border-1">
                    <th class="border-1">id</th>
                    <th class="border-1">Tên sân bay</th>
                    <th class="border-1">Thành phố</th>
                    <th class="border-1">Thao tác</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="modal fade" id="createAirportModal" tabindex="-1" aria-labelledby=createAirportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createAirportModalLabel">Tạo sân bay</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formCreateAirport">
                        @csrf
                        <div class="mb-3">
                            <label for="airportInput" class="form-label">Tên sân bay</label>
                            <input type="text" class="form-control" id="airportInput" name="name" placeholder="Vui lòng nhập tên sân bay">
                        </div>
                        <label for="citySelect" class="form-label">Thành phố</label>
                        <select class="w-100" aria-label=""  name="city_id" id="citySelect" >
                            <option selected  value="null">Chọn thành phố</option>
                            @forelse ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @empty
                                <option value="">Không có dữ liệu</option>
                            @endforelse


                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn bg-purple text-white" form="formCreateAirport">Lưu</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')
    <link href="{{ asset('css/admin/page/list-airport.css') }}" rel="stylesheet">
    <script defer src="{{asset('js/admin/list-airport.js')}}"></script>
@endpush

