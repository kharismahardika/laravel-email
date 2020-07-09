<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductMail;
use App\Mail\HelloMail;
use Illuminate\Http\Request;
use App\Product;

class EmailController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function dataEmail()
    {
        $products = Product::all();
        return view('data-email', compact('products'));
    }

    public function send(Request $request)
    {
        Mail::to('kharismahardikaa@yahoo.com')->send(new HelloMail($request->body));
        return back();
    }

    public function sendProductEmail($id)
    {
        $product = Product::findOrFail($id);
        Mail::to($product->customer_email)->send(new ProductMail($product));
    }
}
