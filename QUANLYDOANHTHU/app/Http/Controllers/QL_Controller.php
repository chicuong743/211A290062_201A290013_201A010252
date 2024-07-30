<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\order;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;



class QL_Controller extends Controller
{
       public function home(){
        return view('home')  ;
    }
    public function add_product(){
        return view('product.add');
    }
    public function uploadProduct(Request $request){
        $product= new product;
        $product-> masp = $request -> input('masp');
        $product -> name = $request -> input('name');
        $product -> type = $request -> input('type');
        $product-> firm = $request -> input('firm');
        $product-> price = $request -> input('price');
        $product-> number= $request-> input ('number');
        $product-> detail =$request ->input('detail');
        $product -> save();
        return redirect('/product/create');
     }
    public function updateProduct(Request $request){
        $product= product::find($request->id);
        $product-> masp = $request -> input('masp');
        $product -> name = $request -> input('name');
        $product -> type = $request -> input('type');
        $product-> firm = $request -> input('firm');
        $product-> price = $request -> input('price');
        $product-> number = $request-> input ('number');
        $product-> detail =$request ->input('detail');
        $product -> save();
        return redirect('/product/create');
     }
     public function edit_product(Request $request){
        $product= product::find($request->id);
        return view('product.edit',[
            'product'=>$product,
        ]);
    }
     public function list_product(){
        $product = product::all();
        return view('product.list', [
            'products'=>$product
        ]);
    }
     public function delete_product(Request $request){
        product::find($request->product_id)->delete();
        return response()->json(['success'=> true]);
    }

    //order
    public function showCart()
    {

        $cart = Session::get('cart', []);
        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        },
        $cart));
        $token = Session::get('cart_token', '');

        return view('cart', compact('cart', 'total', 'token'));
    }

    public function addToCart(Request $request)
    {

        $masp = $request->input('product_masp');
        $quantity = $request->input('quantity');

        $product = Product::where('masp', $masp)->first();

        if (!$product) {
            return redirect()->back()->withErrors(['error' => 'Sản phẩm không tồn tại']);
        }

        if ($product->number < $quantity) {
            return redirect()->back()->withErrors(['error' => 'Không đủ hàng sản phẩm chỉ còn lại: ' . $product->number]);
        }

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            $token = bin2hex(random_bytes(16));
            Session::put('cart_token', $token);
        } else {
            $token = Session::get('cart_token');
        }
        $cart[$masp] = [
            'masp' => $product->masp,
            'name' => $product->name,
            'phone' => 'required|string',
            'price' => $product->price,
            'quantity' => $quantity,
        ];
        Session::put('cart', $cart);

        return redirect()->back();
    }
    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
                return redirect()->back()->withErrors(['error' => 'Giỏ hàng trống']);
            }

            $orderDetails = json_encode($cart);
            $token = Session::get('cart_token', '');
            $order = new order([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'order_detail' => $orderDetails,
                'statust' => order::where('phone', $request->input('phone'))->count() + 1,
                'token' => $token
            ]);
            $order->save();
            // Cập nhật số lượng tồn kho
            foreach ($cart as $item) {
                $product = Product::where('masp', $item['masp'])->first();
                if ($product) {
                    $product->number -= $item['quantity'];
                    $product->save();
                }
            }
            $pdf = Pdf::loadView('invoice', ['order' => $order, 'cart' => $cart]);
            // Lưu PDF vào server (tùy chọn)
            $pdf->save(storage_path("app/public/invoices/{$order->token}.pdf"));
            // Tải PDF về
            return $pdf->download("invoice_{$order->token}.pdf");

        }
        public function createOrder()
        {
            // Logic để tạo hóa đơn mới
            // Xóa giỏ hàng cũ
            Session::forget('cart');
            Session::forget('cart_token');
            return redirect()->back()->with('success', 'Tạo hóa đơn mới thành công');
        }
        //Session::forget('cart');
      //  Session::forget('cart_token');
        //return redirect('/cart')->with('success', 'Tạo Hóa Đơn Thành Công');

    public function removeFromCart(Request $request)
    {
        $masp = $request->input('masp');

        $cart = Session::get('cart', []);
        if (isset($cart[$masp])) {
            unset($cart[$masp]);
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }


    public function list_order(){
        $order = order::all();
        return view('order.list',[
            'orders'=>$order,
    ]);
    }
    public function detail_order($orderId){
        $order = order::find($orderId);

        if (!$order) {
            return redirect()->back()->withErrors(['error' => 'Đơn hàng không tồn tại']);
        }

        $order_detail = json_decode($order->order_detail, true);

        if (is_array($order_detail) && !empty($order_detail)) {
            $product_id = array_keys($order_detail);
            $products = Product::whereIn('masp', $product_id)->get();
        } else {
            $products = collect(); // Một bộ sưu tập rỗng
            $order_detail = [];
        }

        return view('order.detail', [
            'order' => $order,
            'products' => $products,
            'order_detail' => $order_detail
        ]);
    }


    public function revenueManagement(Request $request)
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('home', compact('orders'));
    }

    public function filterRevenue(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
        $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
                       ->orderBy('created_at', 'desc')
                       ->paginate(100000);

        $totalRevenue = 0;

        foreach ($orders as $order) {
            $orderDetails = json_decode($order->order_detail, true);
            foreach ($orderDetails as $detail) {
                $totalRevenue += $detail['price'] * $detail['quantity'];
            }
        }

        return view('home', compact('orders', 'totalRevenue', 'startDate', 'endDate'));
    }
}

