<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Pay;
use App\Order;
use App\User;
use Gate;

class PaysController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index($page = 1){
        $user = Auth::user();
        $orders = Order::all()->skip(15 * ($page - 1))->take(15);
        if (Auth::user()->isAdmin()){
            $pays = pay::all()->sortByDesc('id')->skip(($page-1)*15)->take(15);
            $count = pay::all()->count();
        } else if (Auth::user()->isCustomer()){
            $pays = pay::all()->where('user_id',Auth::user()->id)->sortByDesc('id')->skip(($page-1)*15)->take(15);
            $count = pay::all()->where('user_id',Auth::user()->id)->count();
        }
        $page_count = $count / 15;
        return view('pays.index', ['pays' => $pays,'orders' => $orders , 'page_count' => $page_count]);
    }
    public function show($id){
        $pays = pay::findOrFail($id);
        if(Gate::denies('show-pay',$pays)){
            return redirect()->route('pays.index');
        }
        $user = Auth::user();
        $orders = Order::all();
        return view('pays.show', ['pay' => $pays,'orders' => $orders]);
    }
    public function create(){
        $user = Auth::user();
        $orders = $user->orders()->get();
        //$order_details = $user->order_details()->get();
        return view('pays.create',['orders' => $orders]);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'order_id' => ['required' , 'min:1'],
            'user_id' => ['required' , 'max:500'],
            'bank' => ['required' , 'max:500'],
            'refer_number' => ['required' ,'alpha_dash','min:10', 'max:30'],
            'pay_time' => ['required' , 'min:1'],
            'first_name' => ['required' ,'alpha_dash', 'max:500'],
            'last_name' => ['required' ,'alpha_dash', 'max:500'],
            'price' => ['required' , 'min:1', 'numeric', 'gt:-1'],
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $pay = new Pay;
        if ($files = $request->file('image')) {
            $destinationPath = '../public/img/payimages';
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $pay->picture = $profileImage;
        }
        $pay->order_id = $validatedData['order_id'];
        $pay->user_id = $validatedData['user_id'];
        $pay->bank = $validatedData['bank'];
        $pay->refer_number = $validatedData['refer_number'];
        $pay->pay_time = $validatedData['pay_time'];
        $pay->first_name = $validatedData['first_name'];
        $pay->last_name = $validatedData['last_name'];
        $pay->price = $validatedData['price'];
        $pay->save();
        $pay = DB::table('orders')
              ->where('id', $pay->order_id)
              ->update(['status' => 'กำลังตรวจสอบการชำระเงิน', 'pay_id' => $pay->id]);
              
        return redirect()->route('pays.index',['pay' => $pay]);
    }
    public function destroy(Pay $pay){
        $pay->delete();
        $pays = Pay::all();
        $this->authorize('delete', $pay);
        return redirect()->route('pays.index',['pays' => $pays]);
    }
}
