<?php

namespace App\Http\Controllers;

use App\DataTables\SupplierDataTable;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    public function index()
    {
        return view('pages.supplier.index');
    }

    public function datatable()
    {
        $suppliers = Supplier::latest()->get();
        return SupplierDataTable::set($suppliers);
    }

    public function store(Request $request)
    {
        try{
            Supplier::create($request->all());
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

    public function edit(Supplier $supplier)
    {
        return response([
            'data' => $supplier,
            'update_url' => route('supplier.update', $supplier->id)
        ]);
    }

    public function list()
    {
        return response([
            'data' => Supplier::pluck('name', 'id')
        ]);
    }

    public function update(Request $request, Supplier $supplier)
    {
        try{
            $supplier->update($request->all());
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

    public function setStatus(Supplier $supplier, $status)
    {
        try{
            $supplier->update([
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
