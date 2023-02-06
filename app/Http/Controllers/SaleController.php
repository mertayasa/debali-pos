<?php

namespace App\Http\Controllers;

use App\DataTables\SaleDataTable;
use App\Models\Customer;
use App\Models\Sale;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    public function index()
    {
        return view('pages.sale.index');
    }

    public function datatable()
    {
        $sales = Sale::with('customer', 'discounts', 'sale_details')->latest()->get();
        return SaleDataTable::set($sales);
    }

    public function create()
    {
        $customers = Customer::pluck('name', 'id')->prepend('Select Customer', '');
        $data = [
            'customers' => $customers,
        ];

        return view('pages.sale.crud', $data);
    }

    public function store(Request $request)
    {
        try{
            Sale::create($request->all());
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

    public function edit(Sale $sale)
    {
        return response([
            'data' => $sale,
            'update_url' => route('sale.update', $sale->id)
        ]);
    }

    public function list()
    {
        return response([
            'data' => Sale::pluck('name', 'id')
        ]);
    }

    public function update(Request $request, Sale $sale)
    {
        try{
            $sale->update($request->all());
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

    public function setStatus(Sale $sale, $status)
    {
        try{
            $sale->update([
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
