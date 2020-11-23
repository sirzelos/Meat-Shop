<?php
namespace App\Http\Controllers;
use App\User;
use Auth;
use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\DB;
class CartsController extends Controller
{
  public function __construct(){
     $this->middleware('auth');
 }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
               'total_price' => $total_price
           ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'count' => ['required' , 'min:1' , 'max:255' , 'gt:0'],
            'pid' => ['required']
        ]);
        $product = Product::findOrFail($validatedData['pid']);
        $cart = Cart::where('user_id',Auth::user()->id)->where('product_id',$validatedData['pid'])->first();
        $in_cart = Cart::where('user_id',Auth::user()->id)->where('product_id',$validatedData['pid'])->count();
        if ($in_cart == 1){
            $old_count = $cart->count;
            $cart->count = $validatedData['count'] + $old_count;
            $cart->total_price = $product->unit_price * $cart->count;
            Cart::where('user_id',Auth::user()->id)
                ->where('product_id',$validatedData['pid'])
                ->update(['count' => $cart->count,'total_price' => $cart->total_price]);
        } else {
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $validatedData['pid'];
            $cart->count = $validatedData['count'];
            $cart->total_price = $product->unit_price * $validatedData['count'];
            $cart->save();
        }
        return redirect()->route('products.show',['product' => $product->id]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        if(Gate::denies('index-cart',Cart::class)){
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
        return view('carts.edit',[
            'carts' => $carts,
            'address' => $address ,
            'in_cart' => $in_cart ,
            'count' => $count,
            'total_price' => $total_price
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $validatedData = $request->validate([
            'count' => ['required' , 'min:1' , 'max:255'],
        ]);
        if ($validatedData['count'] <= 0){
            return $this->destroy($cart);
        }
        $cart->count = $validatedData['count'];
        $product = Product::findOrFail($cart->product_id);
        $cart->total_price = $cart->count * $product->unit_price;
        $cart->save();
        return $this->index();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();;
        return $this->index();
    }
}
