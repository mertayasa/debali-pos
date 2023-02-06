<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class SaleDataTable
{
    static public function set($sale)
    {
        return Datatables::of($sale)
            ->addColumn('action', function ($sale) {
                $route_edit = route('sale.edit', $sale->id);
                $route_set_payment_status_void = route('sale.set_status', [$sale->id, 'void']);
                $route_set_payment_status_active = route('sale.set_status', [$sale->id, 'active']);
                
                $route_set_status_void = route('sale.set_status', [$sale->id, 'void']);
                $route_set_status_active = route('sale.set_status', [$sale->id, 'active']);
                
                $action_btn = '<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#formModal" x-on:click="$store.sale.edit(`'. $route_edit .'`)">Edit</button>';

                if($sale->status == 'active'){
                    $action_btn.' <button class="btn btn-sm btn-danger" x-on:click="$store.sale.setStatus(`'. $route_set_status_void .'`)">Set Void</button>';
                }
                if($sale->status == 'void'){
                    $action_btn.' <button class="btn btn-sm btn-info" x-on:click="$store.sale.setStatus(`'. $route_set_status_active .'`)">Set Active</button>';
                }

                if($sale->payment_status == 'paid'){
                    $action_btn.' <button class="btn btn-sm btn-danger" x-on:click="$store.sale.setStatus(`'. $route_set_payment_status_void .'`)">Set Unpaid</button>';
                }
                if($sale->payment_status == 'unpaid'){
                    $action_btn.' <button class="btn btn-sm btn-info" x-on:click="$store.sale.setStatus(`'. $route_set_payment_status_active .'`)">Set Paid</button>';
                }

            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}