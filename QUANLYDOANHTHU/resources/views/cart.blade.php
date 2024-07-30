@extends('main')
@section('h1')
    <h1>Tạo Hóa Đơn</h1>
@endsection
@section('content')
<div class="admin-content-main-content-product-add"></div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
@endif

        <div class="left">
            <div class="top_left">
            <form action="/cart/add" method="POST">
                <label for="masp">Mã sản phẩm: </label>
                <input id="product_masp"type="text" name="product_masp" placeholder="   Mã sản phẩm">
                <label for="quantity">Số lượng:</label>
                <input type="number" id="quantity" name="quantity" required min="1">
                <button type="submit">Thêm <i class="ri-add-circle-line"></i></button>
            @csrf
            </form>
            </div>
            <div class="between_left">
                <div>
                    <table>
                        <thead>
                            <th>Mã SP</th>
                            <th>Tên SP</th>
                            <th>Đơn Giá</th>
                            <th>Số Lượng</th>
                            <th>Thành Tiền</th>
                            <th>Tùy biến</th>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item )
                            <tr>
                                <td>{{ $item['masp'] }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{number_format($item['price'])}}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ number_format($item['price'] * $item['quantity']) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="masp" value="{{ $item['masp'] }}">
                                        <button type="submit" class="delete-class">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    <table>
                        <thead>
                            <th>Tổng</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{number_format($total)  }}</td>
                            </tr>
                        </tbody>
                    </table>
                <button class="bt">Cập nhật <i class="ri-loop-left-fill"></i></button>
                </div>
            </div>
        </div>
        <div class="right">
            <form action="/cart/checkout" method="POST">
                <div class="makh"><span>Mã Khách Hàng: {{ $token }} </span></div>
                <label for="name">Tên khách hàng: </label><input type="text" name="name" placeholder="   Tên khách hàng" required>
                <br>
                <label for="phone">Sđt khách hàng: </label><input type="number" name="phone" placeholder="   Sđt" required>
                <br>
                <button type="submit" class="bt">Xuất Hóa Đơn</button>
             @csrf
            </form>
            <form action="{{ route('order.create') }}" method="POST">
                <button class="bt"type="submit">Tạo mới <i class="ri-loop-left-fill"></i></button>
            @csrf
            </form>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{asset('asset/js/script.js')}}"></script>
@endsection
