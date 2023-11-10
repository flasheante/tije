<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // If filter exists
        $supplierId = $request->input('supplierId');
        if($supplierId){
            $products = Products::when($supplierId, function ($query) use ($supplierId) {
                return $query->where('supplier_id', $supplierId);
            })->get();
        }else{
            $products = Products::all();
        }
        // Response to json
        return response()->json($products); 
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
