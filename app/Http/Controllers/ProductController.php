<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.product.index');
    }

    public function datatable()
    {
        $products = Product::with('product_category')->latest()->get();
        return ProductDataTable::set($products);
    }

    public function store(Request $request)
    {
        try{
            Product::create($request->all());
        }catch(Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return response([
                'message' => 'Unable to store data'
            ], 500);
        }

        return response([
            'message' => 'Success to store data'
        ]);
    }

    public function edit(Product $product)
    {
        return response([
            'data' => $product,
            'update_url' => route('product.update', $product->id)
        ]);
    }

    public function list()
    {
        return response([
            'data' => Product::pluck('name', 'id')
        ]);
    }

    public function update(Request $request, Product $product)
    {
        try{
            $product->update($request->all());
        }catch(Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return response([
                'message' => 'Unable to update data'
            ], 500);
        }

        return response([
            'message' => 'Success to update data'
        ]);
    }

    public function setStatus(Product $product, $status)
    {
        try{
            $product->update([
                'status' => $status
            ]);
        }catch(Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return response([
                'message' => 'Unable to update data'
            ], 500);
        }

        return response([
            'message' => 'Success to update data'
        ]);
    }
}
