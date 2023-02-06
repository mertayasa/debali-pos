<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">Qty</th>
                <th>Product</th>
                <th class="text-end">Price (Rp)</th>
                <th class="text-end">Subtotal (Rp)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">3</td>
                <td>
                    Product 1 <br>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </td>
                <td class="text-end">1.000</td>
                <td class="text-end">3.000</td>
                <td>
                    <a href="#" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i> </a>
                    <a href="#" class="btn btn-sm btn-danger"> <i class="fas fa-trash"></i> </a>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="text-end"> <b>Ongkir</b> </td>
                <td class="text-end">0</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="text-end"> <b>Total</b> </td>
                <td class="text-end">3.000</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <p>Note : Lorem ipsum dolor sit amet consectetur adipisicing  </p>
</div>

{{-- <div class="modal fade modal-lg" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel" x-text="$store.supplier.state"></h5>
            </div>
            <div class="modal-body p-2">
                <form action="" id="supplierCateForm" x-on:submit.prevent="$store.supplier.crudAction($event)">
                    <div class="col">
                        {!! Form::label('name', 'Supplier Name', []) !!}
                        {!! Form::text('name', null, ['class' => 'form-control mb-2', 'id' => 'name', 'x-model' => '$store.supplier.supplierData.name']) !!}
                    </div>

                    <div class="col">
                        {!! Form::label('phone', 'Supplier WA', []) !!}
                        {!! Form::text('phone', null, ['class' => 'form-control mb-2', 'id' => 'phone', 'x-model' => '$store.supplier.supplierData.phone']) !!}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeModalBtn" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" x-on:click="$store.global.clearForm('supplierCateForm')">Close</button>
                <button type="button" class="btn btn-sm btn-primary" x-on:click="$store.supplier.crudAction(event)">Save</button>
            </div>
        </div>
    </div>
</div> --}}
