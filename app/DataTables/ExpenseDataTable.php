<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ExpenseDataTable
{
    static public function set($expense)
    {
        return Datatables::of($expense)
            ->addColumn('action', function ($expense) {
                $route_edit = route('expense.edit', $expense->id);
                $route_set_status_nonactive = route('expense.set_status', [$expense->id, 'nonactive']);
                $route_set_status_active = route('expense.set_status', [$expense->id, 'active']);
                
                $action_btn = '<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#formModal" x-on:click="$store.expense.edit(`'. $route_edit .'`)">Edit</button>';

                if($expense->status == 'active'){
                    return $action_btn.' <button class="btn btn-sm btn-danger" x-on:click="$store.expense.setStatus(`'. $route_set_status_nonactive .'`)">Set Inactive</button>';
                }

                return $action_btn.' <button class="btn btn-sm btn-info" x-on:click="$store.expense.setStatus(`'. $route_set_status_active .'`)">Set Active</button>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}