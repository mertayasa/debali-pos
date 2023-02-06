@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <span>Sale</span>
                </div>
                <div class="col text-end">
                    <a class="btn btn-sm btn-primary" href="{{ route('sale.create') }}" >Create New</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            @include('layouts.includes.flash')
            @include('pages.sale.datatable')
        </div>
    </div>
@endsection
