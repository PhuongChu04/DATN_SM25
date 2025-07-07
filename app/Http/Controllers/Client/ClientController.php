<?php

namespace App\Http\Controllers\Client;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\Console\Logger\ConsoleLogger;

class ClientController extends Controller
{
    public function homeClient()
    {
        $categories = Category::all();
        $products=Product::latest()->take(10)->get();
        return view('client.home',compact('categories', 'products'));
    }
    public function account()
    {
        $user = Sentinel::getUser(); // Lấy thông tin người dùng đã đăng nhập
        return view('client.accounts.account', compact('user'));
    }

   
}
