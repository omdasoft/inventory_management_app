<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index() 
    {
        $response = $this->productService->productList();
        return json_decode($response);
    }

    public function view(int $id)
    {
        $response = $this->productService->productDetails($id);
        return json_decode($response);
    }
}
