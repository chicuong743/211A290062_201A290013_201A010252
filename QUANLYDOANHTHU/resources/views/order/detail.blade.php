@extends('main')
@section('h1')

                        <h1>Chi tiết đơn hàng: <span>{{ $order->token}}</span></h1>

@endsection
@section('content')
                        <div class="admin-content-main-content-order-detail">
                            <table>
                                <thead>
                                    <th>Mã SP</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng </th>
                                    <th>Thành tiền </th>
                                </thead>
                                <tbody>
                                    @php
                                        $total=0;
                                    @endphp
                                    @foreach ($products as $product )
                                    @php
                                        $quantity = $order_detail[$product->masp]['quantity'];
                                        $price = $product->price * $quantity;
                                        $total += $price;
                                    @endphp
                                    <tr>
                                        <td>{{$product->masp}}</td>
                                        <td>{{ucwords($product->name)}}</td>
                                        <td>{{number_format($product->price)}}</td>
                                        <td>{{ $quantity }}</td>
                                        <td>{{number_format($price)}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">Tổng cộng</td>
                                        <td colspan="">{{number_format($total)}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
@endsection
@section('footer')
    <script src="{{asset('asset/js/script.js')}}"></script>

@endsection
