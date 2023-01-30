<?php

namespace App\Http\Controllers;

use App\DataTables\ExpenseDataTable;
use App\Models\Expense;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExpenseController extends Controller
{
    public function index()
    {
        return view('pages.expense.index');
    }

    public function datatable()
    {
        $expenses = Expense::with('expense_category')->latest()->get();
        return ExpenseDataTable::set($expenses);
    }

    public function store(Request $request)
    {
        try{
            Expense::create($request->all());
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

    public function edit(Expense $expense)
    {
        return response([
            'data' => $expense,
            'update_url' => route('expense.update', $expense->id)
        ]);
    }

    public function list()
    {
        return response([
            'data' => Expense::pluck('name', 'id')
        ]);
    }

    public function update(Request $request, Expense $expense)
    {
        try{
            $expense->update($request->all());
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

    public function setStatus(Expense $expense, $status)
    {
        try{
            $expense->update([
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
