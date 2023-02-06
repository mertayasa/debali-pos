<div class="row">
    <div class="col-12 col-lg-6">
        <div class="form-group">
            {!! Form::label('customer_id', 'Customer', []) !!}
            {!! Form::select('customer_id', $customers, null, ['class' => 'form-control select2']) !!}
        </div>
    </div>
</div>