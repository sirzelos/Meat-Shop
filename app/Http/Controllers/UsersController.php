<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Address;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function profile(){
          $user = Auth::user();
          $address = $user->addresses()->latest()->first();
           return view('users.profile',['user'=>$user,'address'=>$address]);
       }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
      if(Gate::denies('index-user',User::class)){
           return redirect()->route('home');
       }
      $users = DB::table('users')->where('role','=','CUSTOMER')
          ->skip(15 * ($page-1))->take(15)->get();
      $count = DB::table('users')->where('role','=','CUSTOMER')->count();
      $page_count = $count / 15;
      return view('users.index',['users' => $users , 'page_count' => $page_count]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if(Gate::denies('show-user',User::class)){
          $user = Auth::user();
          $address = $user->addresses()->latest()->first();
          return redirect()->route('profile',['user'=>$user,'address'=>$address]);
       }
      $user = User::findOrFail($id);
      $address = $user->addresses()->latest()->first();
      $orders = DB::table('orders')
               ->where('user_id', $id)
               ->orderBy('created_at', 'desc')
               ->get();
      return view('users.show',['user' => $user,'orders' => $orders,'address' =>$address]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('users.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
     $validatedData = $request->validate([

       'first_name' => [ 'string', 'min:3'],
       'last_name' => [ 'string', 'min:3'],
        'image' => 'image|mimes:jpeg,png,jpg',

     ]);
     $user =Auth::user();
     if ($files = $request->file('image')) {
         $destinationPath = '../public/img/profile';
         $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
         $files->move($destinationPath, $profileImage);
         $user->picture = $profileImage;
     }
     $user->first_name = $request->first_name;
     $user->last_name = $request->last_name;
     $user->save();
     $user = Auth::user();
     $address = $user->addresses()->latest()->first();
      return view('users.profile',['user'=>$user,'address'=>$address,'message' =>'แก้ไขเรียบร้อย']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $user->delete();
        $page =1;
        $users = DB::table('users')->where('role','=','CUSTOMER')
            ->skip(15 * ($page-1))->take(15)->get();
        $count = DB::table('users')->where('role','=','CUSTOMER')->count();
        $page_count = $count / 15;
        return view('users.index',['users' => $users , 'page_count' => $page_count,'message' =>'ลบเรียบร้อย']);
    }
}
