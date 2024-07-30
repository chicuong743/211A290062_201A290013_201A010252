@extends('main')
@section('h1')

                        <h1>Danh sách Sản Phẩm</h1>

@endsection
@section('content')
                <div class="admin-content-main-content-product-list">
                            <table>
                                <thead>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên</th>
                                    <th>Loại</th>
                                    <th>Hãng</th>
                                    <th>Giá Bán</th>
                                    <th>Chi tiết SP</th>
                                    <th>Số lượng tồn</th>
                                    <th>Ngày Đăng</th>
                                    <th>Tùy Chỉnh</th>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product  )
                                        <tr>
                                            <td>{{$product->masp}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->type}}</td>
                                            <td>{{$product->firm}}</td>
                                            <td>{{number_format($product->price)}}</td>
                                            <td>{!!$product->detail!!}</td>
                                            <td>{{$product->number}}</td>
                                            <td>{{$product->updated_at}}</td>
                                            <td>
                                                <a class="edit-class" href="/product/edit/{{$product->id}}">Sữa</a>
                                                |
                                                <a onclick="removeRow(product_id=<?php echo +$product->id?>,url='/product/delete')"  class="delete-class" href="">Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
@endsection
@section('footer')
    <script src="{{asset('asset/js/script.js')}}"></script>
    <script src="{{asset('asset/js/product_ajax.js')}}"></script>
@endsection
