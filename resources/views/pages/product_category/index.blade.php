@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <span>Product Category</span>
                </div>
                <div class="col text-end">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#formModal" x-on:click="$store.product_category.create($event)">Create New</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            @include('layouts.includes.flash')
            @include('pages.product_category.datatable')
            @include('pages.product_category.crud')
        </div>
    </div>
@endsection
