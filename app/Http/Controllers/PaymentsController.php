<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index() {
        return view('payments.payments');
    }

}
