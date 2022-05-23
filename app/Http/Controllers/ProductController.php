<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{
    public function index()
    {
        $user = Session::get('user');
        return view('product', compact('user'));
    }
}
