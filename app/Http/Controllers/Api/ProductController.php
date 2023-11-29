<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Salla\SallaService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(protected SallaService $sallaService)
    {}

    public function index() 
    {
        $products = $this->sallaService->getProducts();
        if($products && $products['status'] == 200) {
            return response()->json(['status' => 200, 'data' => $products['data'], 'metadata' => $products['metadata']]);
        } else {
            return response()->json(['status' => $products['status'], 'data' => $products['error'], 'metadata' => []]);
        }
    }

    public function show(int $id)
    {
        $product = $this->sallaService->getProduct($id);
        if($product && $product['status'] == 200) {
            return response()->json(['status' => 200, 'data' => $product['data']]);
        } else {
            return response()->json(['status' => $product['status'], 'data' => $product['error']]);
        }
    }
}
