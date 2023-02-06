<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class SupplierDataTable
{
    static public function set($supplier)
    {
        return Datatables::of($supplier)
            ->addColumn('action', function ($supplier) {
                $route_edit = route('supplier.edit', $supplier->id);
                $route_set_status_nonactive = route('supplier.set_status', [$supplier->id, 'nonactive']);
                $route_set_status_active = route('supplier.set_status', [$supplier->id, 'active']);
                
                $action_btn = '<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#formModal" x-on:click="$store.supplier.edit(`'. $route_edit .'`)">Edit</button>';

                if($supplier->status == 'active'){
                    return $action_btn.' <button class="btn btn-sm btn-danger" x-on:click="$store.supplier.setStatus(`'. $route_set_status_nonactive .'`)">Set Inactive</button>';
                }

                return $action_btn.' <button class="btn btn-sm btn-info" x-on:click="$store.supplier.setStatus(`'. $route_set_status_active .'`)">Set Active</button>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}