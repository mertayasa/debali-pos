<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ProductCategoryDataTable
{
    static public function set($product_category)
    {
        return Datatables::of($product_category)
            ->addColumn('action', function ($product_category) {
                $route_edit = route('product_category.edit', $product_category->id);
                $route_set_status_nonactive = route('product_category.set_status', [$product_category->id, 'nonactive']);
                $route_set_status_active = route('product_category.set_status', [$product_category->id, 'active']);
                
                $action_btn = '<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#formModal" x-on:click="$store.product_category.edit(`'. $route_edit .'`)">Edit</button>';

                if($product_category->status == 'active'){
                    return $action_btn.' <button class="btn btn-sm btn-danger" x-on:click="$store.product_category.setStatus(`'. $route_set_status_nonactive .'`)">Set Inactive</button>';
                }

                return $action_btn.' <button class="btn btn-sm btn-info" x-on:click="$store.product_category.setStatus(`'. $route_set_status_active .'`)">Set Active</button>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}