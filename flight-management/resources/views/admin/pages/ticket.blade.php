@extends('layout.admin')
@section('content')
    <div>
        <table id="example" class="table" width="100%">
            <thead >
            <tr class="border-1">
                <th class="border-1">id</th>
                <th class="border-1">Code</th>
                <th class="border-1">Tên khách hàng</th>
                <th class="border-1">Email</th>
                <th class="border-1">Sđt</th>
                <th class="border-1">Số lượng đặt</th>
                <th class="border-1">Tổng giá đặt</th>
                <th class="border-1">Giờ bay</th>

            </tr>
            </thead>
        </table>
    </div>
@endsection

@push('head')
    <link href="{{ asset('css/admin/page/list-flight.css') }}" rel="stylesheet">
    <script defer src="{{asset('js/admin/list-flight.js')}}"></script>
    <script defer src="{{asset('js/admin/list-ticket.js')}}"></script>
@endpush

