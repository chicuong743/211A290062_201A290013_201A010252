@extends('main')
@section('h1')

                        <h1>Cập Nhật Sản Phẩm </h1>

@endsection
@section('content')

<form action="" enctype="multipart/form-data" method="post">
    <div class="admin-content-main-content-product-add">
        <div class="admin-content-main-content-left">
            <div class="admin-content-main-content-two-input">
                <input type="text" value="{{$product->masp}}" name="masp" placeholder=" Mã sản Phẩm ">
                <input type="text" value="{{$product->name}}" name="name" placeholder=" Tên sản Phẩm ">
                <input type="text" value="{{$product->type}}" name="type" placeholder="Phân loại">
            </div>
            <div class="admin-content-main-content-two-input">
                <input type="text"value="{{$product->price}}" name="price" placeholder=" Giá Bán ">
                <input type="text" value="{{$product->firm}}" name="firm" placeholder="Hãng sản phẩm">
                <input type="number" value="{{$product->number}}" name="number" placeholder="Số lượng tồn">
            </div>
            <textarea class="editor_detail"value="" name="detail" id="" >{{$product->detail}}</textarea>
            <button type="submit" class="main-btn">Cập Nhật Sản Phẩm </button>
        </div>
    </div>
    @csrf
</form>

@endsection
@section('footer')
    <script src="{{asset('asset/js/script.js')}}"></script>
    <script src="{{asset('asset/ckeditor5/ckeditor.js')}}"></script>
    <script src="{{asset('asset/ckeditor5/script.js')}}"></script>
    <script src="{{asset('asset/js/product_ajax.js')}}"></script>
@endsection
