<?php

namespace App\Http\Controllers\Client;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Console\Logger\ConsoleLogger;

class ClientController extends Controller
{
    public function homeClient()
    {
        return view('client.home');
    }
    public function account()
    {
        $user = Sentinel::getUser(); // Lấy thông tin người dùng đã đăng nhập
        return view('client.accounts.account', compact('user'));
    }

    public function accountDetail()
    {
        $user = Sentinel::getUser(); // Lấy user đang đăng nhập
        return view('client.accounts.accountDetail', compact('user'));
    }
}
