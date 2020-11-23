<?php

namespace App\Http\Controllers;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Gate;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
         $this->middleware('auth');
     }
    public function index()
    {
      if(Gate::denies('index-report',Report::class)){
           return redirect()->route('products.index');
       }
      $total = 0;
      $products = DB::table('products')
              ->orderBy('sales', 'desc')
              ->get();
      foreach ($products as $product ) {
        $total+=(($product->sales)*($product->unit_price));
      }


      return view('reports.index',['products' => $products,'total'=>$total]);
    }
    public function search(Request $request)
    {
      $total =DB::table('sales_histories')
           ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
           ->sum('total_price');

      $total1 =DB::table('sales_histories')->where('product_id', 1)
           ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
           ->sum('total_price');
      $total2 =DB::table('sales_histories')->where('product_id', 2)
            ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
           ->sum('total_price');
      $total3=DB::table('sales_histories')->where('product_id', 3)
            ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
           ->sum('total_price');
      $total4 =DB::table('sales_histories')->where('product_id', 4)
                    ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
                           ->sum('total_price');
      $total5 =DB::table('sales_histories')->where('product_id', 5)
                    ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
                 ->sum('total_price');
      $total6 =DB::table('sales_histories')->where('product_id', 6)
                                    ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
                                   ->sum('weight');
                                   $weight1 =DB::table('sales_histories')->where('product_id', 1)
                                        ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
                                        ->sum('weight');
                                   $weight2 =DB::table('sales_histories')->where('product_id', 2)
                                         ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
                                        ->sum('weight');
                                   $weight3=DB::table('sales_histories')->where('product_id', 3)
                                         ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
                                        ->sum('weight');
                                    $weight4 =DB::table('sales_histories')->where('product_id', 4)
                                                 ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
                                                        ->sum('weight');
                                    $weight5 =DB::table('sales_histories')->where('product_id', 5)
                                                 ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
                                              ->sum('weight');
                                    $weight6=DB::table('sales_histories')->where('product_id', 6)
                                                                 ->whereBetween('sales_date', [$request->input('from'), $request->input('to')])
                                                                ->sum('weight');
            $form=$request->input('from');
            $to = $request->input('to');

      return view('reports.search',['total'=>$total,'form'=>$form,'to'=>$to,'total1'=>$total1,'total2'=>$total2,'total3'=>$total3,'total4'=>$total4,'total5'=>$total5,'total6'=>$total6
    ,'weight1'=>$weight1,'weight2'=>$weight2,'weight3'=>$weight3,'weight4'=>$weight4,'weight5'=>$weight5,'weight6'=>$weight6]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
