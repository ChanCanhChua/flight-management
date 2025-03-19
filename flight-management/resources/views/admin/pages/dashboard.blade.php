@extends('layout.admin')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <i class="fa-solid fa-plane-circle-check"></i>
                    <h5 class="card-title">Số vé bán</h5>
                    <p class="card-text counter"  data-count="1324">0</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">Tổng Doanh Thu</h5>
                    <p class="card-text counter" data-count="1234">0</p>
                </div>
            </div>
        </div>

    </div>
@stop
