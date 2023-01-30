<?php

namespace App\Http\Controllers;

use App\DataTables\ExpenseCategoryDataTable;
use App\Models\ExpenseCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        return view('pages.expense_category.index');
    }

    public function datatable()
    {
        $expense_categories = ExpenseCategory::latest();
        return ExpenseCategoryDataTable::set($expense_categories);
    }

    public function store(Request $request)
    {
        try{
            ExpenseCategory::create($request->all());
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

    public function edit(ExpenseCategory $expenseCategory)
    {
        return response([
            'data' => $expenseCategory,
            'update_url' => route('expense_category.update', $expenseCategory->id)
        ]);
    }

    public function list()
    {
        return response([
            'data' => ExpenseCategory::active()->latest()->get(['name', 'id'])->prepend(['name' => 'Select Category'])
        ]);
    }

    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        try{
            $expenseCategory->update($request->all());
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

    public function setStatus(ExpenseCategory $expenseCategory, $status)
    {
        try{
            $expenseCategory->update([
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
