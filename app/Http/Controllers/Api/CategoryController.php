<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Salla\SallaService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private SallaService $sallaService) 
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->sallaService->getCategories();
        if($categories && $categories['status'] == 200) {
            return response()->json(['status' => 200, 'data' => $categories['data'], 'metadata' => $categories['metadata']]);
        } else {
            return response()->json(['status' => $categories['status'], 'data' => $categories['error'], 'metadata' => []]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
