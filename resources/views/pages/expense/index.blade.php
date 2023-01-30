@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <span>Expense</span>
                </div>
                <div class="col text-end">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#formModal" x-on:click="$store.expense.create($event)">Create New</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            @include('layouts.includes.flash')
            @include('pages.expense.datatable')
            @include('pages.expense.crud')
        </div>
    </div>
@endsection
