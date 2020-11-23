<?php

namespace App\Http\Controllers;

use App\Cart;
use App\OrderDetail;
use App\Product;
use App\SalesHistory;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Address;
use Gate;


class OrdersController extends Controller
{
  public function __construct(){
     $this->middleware('auth');
 }
    public function index($page = 1) {
        if (Auth::user()->isAdmin()){
            $orders = Order::all()->skip(15 * ($page - 1))->take(15);
            $count = DB::table('orders')->count();
        } else if (Auth::user()->isCustomer()){
            $orders = Order::all()->where('user_id',Auth::user()->id)->sortByDesc('updated_at')->skip(15 * ($page - 1))->take(15);
            $count = DB::table('orders')->where('user_id',Auth::user()->id)->count();
        }
        $page_count = $count / 15;
        return view('orders.index',['orders'=>$orders , 'page_count' => $page_count,'status'=>'ทั้งหมด']);
    }
    public function show($id){

        $order = Order::findOrFail($id);
        if(Gate::denies('show-order',$order)){
            return $this->index(1);
        }
        $address = DB::table('addresses')->where('id',$order->address_id)->first();
        $order_details = DB::table('order_details')->where('order_id',$order->id)->get();
        return view('orders.show',['order'=>$order,'order_details'=>$order_details,'address'=>$address]);
    }
    public function store(Request $request){
        $in_cart = Cart::where('user_id',Auth::user()->id)->count();
        if ($in_cart == 0){
            $user = Auth::user();
            $address = $user->addresses()->latest()->first();
            $carts = $user->carts()->get();
            return view('carts.index',['carts' => $carts,'address' => $address]);
        }
        $carts = DB::table('carts')->where('user_id',Auth::user()->id)->get();
        foreach ($carts as $cart){
            $product = Product::findOrFail($cart->product_id);
            if ($product->count < $cart->count){
                if ( Gate::denies('index-cart',Cart::class)){
                    return redirect()->route('home');
                }
                $user = Auth::user();
                $address = $user->addresses()->latest()->first();
                $carts = $user->carts()->get();
                $in_cart = $user->carts()->count();
                $count = DB::table('carts')
                    ->where('user_id', Auth::user()->id)
                    ->count();
                $total_price = DB::table('carts')
                    ->where('user_id', Auth::user()->id)
                    ->sum('total_price');
                return view('carts.index',[
                    'carts' => $carts,
                    'address' => $address ,
                    'in_cart' => $in_cart ,
                    'count' => $count,
                    'total_price' => $total_price,
                    'message' => 'สิ้นค้าไม่พอกรุณาเชคสิ้นค้าที่สั่งกับสิ้นค้าใน stock'
                ]);
            }
        }
        $address = new Address;
        $address->user_id =  Auth::user()->id;
        $address->house_address = $request->input('house_address');
        $address->street = $request->input('street');
        $address->province = $request->input('province');
        $address->sub_district = $request->input('sub_district');
        $address->district = $request->input('district');
        $address->zip_code = $request->input('zip_code');
        $address->save();
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->total_price = 0;
        $order->address_id=$address->id;
        $order->save();
        foreach ($carts as $cart){
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->weight = $cart->count;
            $order_detail->product_id = $cart->product_id;
            $product = DB::table('products')->where('id',$cart->product_id)->first();
            $count = $product->count - $cart->count;
            $sales = $product->sales + $cart->count;
            DB::table('products')->where('id',$cart->product_id)->update(['count' => $count , 'sales' => $sales]);
            $order_detail->price = $product->unit_price * $cart->count;
            $order_detail->save();
            $temp_cart = Cart::findOrFail($cart->id);
            $temp_cart->delete();
        }
        $order->total_price = DB::table('order_details')->where('order_id',$order->id)->sum('price')+50;
        $order->save();
        return $this->index(1);
    }
    public function edit($id){
        $orders = order::findOrFail($id);
        $user = DB::table('users')->where('id',$orders->user_id)->first();
        if(Gate::denies('edit-order',$orders)){
            return $this->index(1);
        }
        return view('orders.edit', ['order' => $orders,'user' => $user]);
    }
    public function update(Request $request)
    {

        $order = Order::findOrFail($request->input('id'));
        $order->status = $request->input('status');
        if ($request->input('status') == 'ชำระเงินถูกต้องกำลังเตรียมส่ง'){
            $order_details = OrderDetail::where('order_id' , $order->id)->get();
            foreach($order_details as $order_detail){
                $sales_history = new SalesHistory();
                $sales_history->product_id = $order_detail->product_id;
                $sales_history->weight = $order_detail->weight;
                $sales_history->total_price = $order_detail->price;
                $sales_history->sales_date = now();
                $sales_history->save();
            }
        }
        $order->save();
        $page = 1;
        $orders = Order::all()->sortByDesc('updated_at')->skip(15 * ($page - 1))->take(15);
        $count = DB::table('orders')->count();
        $page_count = $count / 15;
        return view('orders.index',['orders'=>$orders , 'page_count' => $page_count,'message'=>'อัพเดตเรียบร้อย','status'=>'ทั้งหมด']);

    }
    public function destroy($id)
    {
      $order= Order::find($id);
      $order_details = DB::table('order_details')->where('order_id',$order->id)->get();
      foreach($order_details as $order_detail){
        $product = Product::withTrashed()->where('id',$order_detail->product_id)->first();
        $product->count = $product->count+$order_detail->weight;
        $product->sales = $product->sales-$order_detail->weight;
        $product->save();
      }

      $order->delete();
      $page =1;
      $orders = Order::all()->sortByDesc('updated_at')->skip(15 * ($page - 1))->take(15);
      $count = DB::table('orders')->count();
      $page_count = $count / 15;
      return view('orders.index',['orders'=>$orders , 'page_count' => $page_count,'message'=>'ลบเรียบร้อย','status'=>'ทั้งหมด']);
    }

    public function search(Request $request , $page = 1){
        $status= $request->input('select');
        if ($request->input('select') == "ทั้งหมด"){
            return $this->index();
        }
        if (Auth::user()->isAdmin()){
            $orders = Order::all()->where('status',$request->input('select'))->sortByDesc('updated_at')->skip(15 * ($page - 1))->take(15);
            $count = DB::table('orders')->where('status',$request->input('select'))->count();
        } else if (Auth::user()->isCustomer()){
            $orders = Order::all()->where('status',$request->input('select'))->where('user_id',Auth::user()->id)->sortByDesc('updated_at')->skip(15 * ($page - 1))->take(15);
            $count = DB::table('orders')->where('status',$request->input('select'))->where('user_id',Auth::user()->id)->count();
        }

        $page_count = $count / 15;
        return view('orders.search',['orders'=>$orders , 'page_count' => $page_count, 'status' => $status]);
    }
}
