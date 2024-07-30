@extends('main')
@section('h1')

                        <h1>Danh sách đơn hàng</h1>

@endsection
@section('content')
                        <div class="admin-content-main-content-order-list">
                            <table>
                                <thead>
                                    <th>Mã KH</th>
                                    <th>Tên KH</th>
                                    <th>Phone</th>
                                    <th>Chi tiết</th>
                                    <th>Số lần mua</th>
                                    <th>Ngày</th>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order )
                                    <tr>
                                        <td>{{$order->token}}</td>
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td><a class="edit-class" href="{{ route('order.detail', $order->id) }}">Chi tiết</a></td>
                                        <td>{{$order->statust}}</td>
                                        <td>{{$order->created_at}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
@endsection
@section('footer')
    <script src="{{asset('asset/js/script.js')}}"></script>

@endsection
