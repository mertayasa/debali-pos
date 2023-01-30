<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerDataTable;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index()
    {
        return view('pages.customer.index');
    }

    public function datatable()
    {
        $customers = Customer::latest()->get();
        return CustomerDataTable::set($customers);
    }

    public function store(Request $request)
    {
        try{
            Customer::create($request->all());
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

    public function edit(Customer $customer)
    {
        return response([
            'data' => $customer,
            'update_url' => route('customer.update', $customer->id)
        ]);
    }

    public function list()
    {
        return response([
            'data' => Customer::pluck('name', 'id')
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        try{
            $customer->update($request->all());
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

    public function setStatus(Customer $customer, $status)
    {
        try{
            $customer->update([
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
