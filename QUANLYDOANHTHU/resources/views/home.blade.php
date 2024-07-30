@extends('main')
@section('h1')

        <h1>Quản lý doanh thu</h1>

@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('revenue.filter') }}" method="POST">
                            @csrf
                            <div style="padding:20px;"class="row">
                                <div style="padding:0 20px;" class="col">
                                    <label for="start_date">Từ ngày:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $startDate ?? '' }}" required>
                                </div>
                                <div style="padding:0 20px;" class="col">
                                    <label for="end_date">Đến ngày:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $endDate ?? '' }}" required>
                                </div>
                                <div  class="col">
                                    <label>&nbsp;</label>
                                    <button style="color:blue; " type="submit" class="btn btn-primary btn-block">Lọc</button>
                                </div>
                            </div>
                        </form>

                        @if (isset($orders) && $orders->isNotEmpty())
                            <div class="mt-3">
                                <h4 style="padding:10px 40px">Tổng doanh thu từ {{ $startDate->format('d-m-Y') }} đến {{ $endDate->format('d-m-Y') }} :   {{number_format($totalRevenue) }} VND</h4>
                            </div>
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày tạo</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->token }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->created_at->format('d-m-Y H:i:s') }}</td>
                                            <td>
                                                <a href="{{ route('order.detail', $order->id) }}">Xem chi tiết</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Không có đơn hàng nào trong khoảng thời gian này.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{asset('asset/js/script.js')}}"></script>
@endsection
