<?php

namespace App\Http\Controllers;

use App\DataTables\ProductCategoryDataTable;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return view('pages.product_category.index');
    }

    public function datatable()
    {
        $product_categories = ProductCategory::latest();
        return ProductCategoryDataTable::set($product_categories);
    }

    public function store(Request $request)
    {
        try{
            ProductCategory::create($request->all());
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

    public function edit(ProductCategory $productCategory)
    {
        return response([
            'data' => $productCategory,
            'update_url' => route('product_category.update', $productCategory->id)
        ]);
    }

    public function list()
    {
        return response([
            'data' => ProductCategory::active()->latest()->get(['name', 'id'])->prepend(['name' => 'Select Category'])
        ]);
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        try{
            $productCategory->update($request->all());
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

    public function setStatus(ProductCategory $productCategory, $status)
    {
        try{
            $productCategory->update([
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
