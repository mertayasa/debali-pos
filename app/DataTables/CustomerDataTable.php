<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class CustomerDataTable
{
    static public function set($customer)
    {
        return Datatables::of($customer)
            ->addColumn('action', function ($customer) {
                $route_edit = route('customer.edit', $customer->id);
                $route_set_status_nonactive = route('customer.set_status', [$customer->id, 'nonactive']);
                $route_set_status_active = route('customer.set_status', [$customer->id, 'active']);
                
                $action_btn = '<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#formModal" x-on:click="$store.customer.edit(`'. $route_edit .'`)">Edit</button>';

                if($customer->status == 'active'){
                    return $action_btn.' <button class="btn btn-sm btn-danger" x-on:click="$store.customer.setStatus(`'. $route_set_status_nonactive .'`)">Set Inactive</button>';
                }

                return $action_btn.' <button class="btn btn-sm btn-info" x-on:click="$store.customer.setStatus(`'. $route_set_status_active .'`)">Set Active</button>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}