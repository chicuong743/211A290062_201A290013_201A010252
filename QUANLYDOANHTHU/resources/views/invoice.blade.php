<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hóa Đơn</title>
    <style>
        body {
            font-family: DejaVu Sans;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Hóa Đơn</h1>
    <p>Mã khách hàng: {{ $order->token }}</p>
    <p>Tên khách hàng: {{ $order->name }}</p>
    <p>Số điện thoại: {{ $order->phone }}</p>
    <table>
        <thead>
            <tr>
                <th>Mã SP</th>
                <th>Tên SP</th>
                <th>Đơn Giá</th>
                <th>Số Lượng</th>
                <th>Thành Tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
                <tr>
                    <td>{{ $item['masp'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ number_format($item['price']) }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['price'] * $item['quantity']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Tổng: {{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart))) }} VND</p>
</body>
</html>
