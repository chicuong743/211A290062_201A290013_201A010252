@extends('main')
@section('h1')

                                <h1>Thêm Sản Phẩm</h1>

@endsection
@section('content')


<form action="/product/add" enctype="multipart/form-data" method="post">
    <div class="admin-content-main-content-product-add">
        <div class="admin-content-main-content-left">
            <div class="admin-content-main-content-two-input">
                <input type="text" value="{{old('masp')}}" name="masp" placeholder=" Mã sản phẩm ">
                <input type="text" value="{{old('name')}}" name="name" placeholder=" Tên sản Phẩm ">
                <input type="text" value="{{old('type')}}" name="type" placeholder="Phân loại">

            </div>
            <div class="admin-content-main-content-two-input">
                <input type="text"value="{{old('price')}}" name="price" placeholder=" Giá Bán ">
                <input type="text" value="{{old('firm')}}" name="firm" placeholder="Hãng sản phẩm">
                <input type="number" value="{{old('number')}}" name="number" placeholder="Số lượng nhập">
            </div>
            <textarea class="editor_detail"value="{{old('detail')}}" name="detail" id="" >Chi tiết sản phẩm </textarea>
            <button type="submit" class="main-btn">Thêm Sản Phẩm</button>
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
