<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ProductDataTable
{
    static public function set($product)
    {
        return Datatables::of($product)
            ->addColumn('action', function ($product) {
                $route_edit = route('product.edit', $product->id);
                $route_set_status_nonactive = route('product.set_status', [$product->id, 'nonactive']);
                $route_set_status_active = route('product.set_status', [$product->id, 'active']);
                
                $action_btn = '<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#formModal" x-on:click="$store.product.edit(`'. $route_edit .'`)">Edit</button>';

                if($product->status == 'active'){
                    return $action_btn.' <button class="btn btn-sm btn-danger" x-on:click="$store.product.setStatus(`'. $route_set_status_nonactive .'`)">Set Inactive</button>';
                }

                return $action_btn.' <button class="btn btn-sm btn-info" x-on:click="$store.product.setStatus(`'. $route_set_status_active .'`)">Set Active</button>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}