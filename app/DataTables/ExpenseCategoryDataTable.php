<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ExpenseCategoryDataTable
{
    static public function set($expense_category)
    {
        return Datatables::of($expense_category)
            ->addColumn('action', function ($expense_category) {
                $route_edit = route('expense_category.edit', $expense_category->id);
                $route_set_status_nonactive = route('expense_category.set_status', [$expense_category->id, 'nonactive']);
                $route_set_status_active = route('expense_category.set_status', [$expense_category->id, 'active']);
                
                $action_btn = '<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#formModal" x-on:click="$store.expense_category.edit(`'. $route_edit .'`)">Edit</button>';

                if($expense_category->status == 'active'){
                    return $action_btn.' <button class="btn btn-sm btn-danger" x-on:click="$store.expense_category.setStatus(`'. $route_set_status_nonactive .'`)">Set Inactive</button>';
                }

                return $action_btn.' <button class="btn btn-sm btn-info" x-on:click="$store.expense_category.setStatus(`'. $route_set_status_active .'`)">Set Active</button>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}