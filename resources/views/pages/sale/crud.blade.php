@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <span>Sale / Create</span>
                </div>
            </div>
        </div>

        <div class="card-body">
            @include('layouts.includes.flash')
            @include('pages.sale.form')
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <span>Product</span>
                </div>
                <div class="col text-end">
                    <button class="btn btn-sm btn-primary">Add Product</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('pages.sale.form_product')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('sale', {
                state: "",
                saleData: {
                    customer_id: '',
                    shipping_cost: 0,
                    note: '-',
                    saleDetails: [],
                },
                init() {
                    this.select2Alpine()
                },
                select2Alpine() {
                    // add x-ref="select" to select2 element
                    // this.select2 = $(this.$refs.select).select2()

                    this.select2 = $('.select2').select2()
                    this.saleData.customer_id = this.select2.val() // assign initial value on load

                    this.select2.on("select2:select", event => {
                        this.saleData.customer_id = event.target.value
                    })

                    console.log(this.saleData)

                    //   this.$watch("selectedCity", value => {
                    //     this.select2.val(value).trigger("change");
                    //   })

                }
            })
        })
    </script>
@endpush
