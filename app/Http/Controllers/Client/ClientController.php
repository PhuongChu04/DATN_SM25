<?php

namespace App\Http\Controllers\Client;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;
use Symfony\Component\Console\Logger\ConsoleLogger;

class ClientController extends Controller
{
    protected $categoryService;
    protected $productService;
    protected $productVariantService;
    public function __construct(ProductService $productService, ProductVariantService $productVariantService, CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->productVariantService = $productVariantService;
    }

    
    public function homeClient()
    {
         $categories = $this->categoryService->getAllCategories();
        //  dd($categories);
    return view('client.home', compact('categories'));
       
      
    }
    public function account()
    {
        $user = Sentinel::getUser(); // Lấy thông tin người dùng đã đăng nhập
        return view('client.accounts.account', compact('user'));
    }

  

   
}


