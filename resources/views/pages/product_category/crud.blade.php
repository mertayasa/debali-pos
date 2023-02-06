<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel" x-text="$store.product_category.state"></h5>
            </div>
            <div class="modal-body p-2">
                <form action="" id="productCateForm" x-on:submit.prevent="$store.product_category.crudAction($event)">
                    <div class="col">
                        {!! Form::label('name', 'Product Category Name', []) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'x-model' => '$store.product_category.productCategoryData.name']) !!}
                        <small>Use coma separator (,) to insert multiple data</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeModalBtn" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" x-on:click="$store.global.clearForm('productCateForm')">Close</button>
                <button type="button" class="btn btn-sm btn-primary" x-on:click="$store.product_category.crudAction(event)">Save</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        const form = document.getElementById('createForm')

        document.addEventListener('alpine:init', () => {
            Alpine.store('product_category', {
                productCategoryData: {},
                storeUrl: "{{ route('product_category.store') }}",
                updateUrl: '',
                state: '',
                crudAction(event){
                    this.state == 'Update Data' ? this.update(event) : this.store(event)
                },
                create(event) {
                    this.state = 'Create Data'
                },
                store(event) {
                    let formData = new FormData(document.getElementById('productCateForm'))
                    clearFlash()

                    Swal.fire({
                        html: '<i class="fas fa-circle-notch fa-spin fa-3x mb-3"></i> <br> Proccessing Data',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    })

                    fetch(this.storeUrl, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            method: 'POST',
                            body: formData,
                        })
                        .then(function(response) {
                            const data = response.json()
                            if (response.status == 200) {
                                return data
                            }

                            if (response.status == 422) {
                                data.then((res) => {
                                    const message = res.message
                                    Alpine.store('global').showFlash(res.message, 'error')
                                })

                                Alpine.store('global').swalMessage = 'Validation error'
                                throw new Error()
                            }

                            return data.then(data => {
                                Alpine.store('global').swalMessage = data.message ||
                                    'Unexpected error'
                                throw new Error()
                            })
                        })
                        .then(data => {
                            Swal.close()
                            document.getElementById('closeModalBtn').click()
                            $('#product_category_dataTable').DataTable().ajax.reload()
                            Alpine.store('global').showFlash(data.message, 'success')
                        })
                        .catch((error) => {
                            Alpine.store('global').showFlash(Alpine.store('global').swalMessage, 'error')
                            Swal.close()
                            return showSwalAlert('error', Alpine.store('global').swalMessage)
                        })
                },
                edit(url) {
                    this.state = 'Update Data'
                    this.updateUrl = ''
                    clearFlash()

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            method: 'GET',
                        })
                        .then(function(response) {
                            const data = response.json()
                            if (response.status == 200) {
                                return data
                            }

                            if (response.status == 422) {
                                data.then((res) => {
                                    const message = res.message
                                    Alpine.store('global').showFlash(res.message, 'error')
                                })

                                Alpine.store('global').swalMessage = 'Validation error'
                                throw new Error()
                            }

                            return data.then(data => {
                                Alpine.store('global').swalMessage = data.message || 'Unexpected error'
                                throw new Error()
                            })
                        })
                        .then(data => {
                            this.productCategoryData = data.data
                            this.updateUrl = data.update_url
                        })
                        .catch((error) => {
                            Alpine.store('global').showFlash(Alpine.store('global').swalMessage, 'error')
                            Swal.close()
                            return showSwalAlert('error', Alpine.store('global').swalMessage)
                        })
                }, 
                update(event) {
                    let formData = new FormData(document.getElementById('productCateForm'))
                    formData.append('_method', 'PATCH')
                    clearFlash()

                    Swal.fire({
                        html: '<i class="fas fa-circle-notch fa-spin fa-3x mb-3"></i> <br> Proccessing Data',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    })

                    fetch(this.updateUrl, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            method: 'POST',
                            body: formData,
                        })
                        .then(function(response) {
                            const data = response.json()
                            if (response.status == 200) {
                                return data
                            }

                            if (response.status == 422) {
                                data.then((res) => {
                                    const message = res.message
                                    Alpine.store('global').showFlash(res.message, 'error')
                                })

                                Alpine.store('global').swalMessage = 'Validation error'
                                throw new Error()
                            }

                            return data.then(data => {
                                Alpine.store('global').swalMessage = data.message || 'Unexpected error'
                                throw new Error()
                            })
                        })
                        .then(data => {
                            Swal.close()
                            document.getElementById('closeModalBtn').click()
                            $('#product_category_dataTable').DataTable().ajax.reload()

                            Alpine.store('global').showFlash(data.message, 'success')
                        })
                        .catch((error) => {
                            Alpine.store('global').showFlash(Alpine.store('global').swalMessage, 'error')
                            Swal.close()
                            return showSwalAlert('error', Alpine.store('global').swalMessage)
                        })
                },
                setStatus(url) {
                    Swal.fire({
                        title: "Warning",
                        text: `Change status ?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#169b6b',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let formData = new FormData()
                            formData.append('_method', 'PATCH')
                            clearFlash()

                            fetch(url, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                },
                                method: 'POST',
                                body: formData
                            })
                            .then(function(response) {
                                const data = response.json()
                                if (response.status == 200) {
                                    return data
                                }
        
                                if (response.status == 422) {
                                    data.then((res) => {
                                        const message = res.message
                                        Alpine.store('global').showFlash(res.message, 'error')
                                    })
        
                                    Alpine.store('global').swalMessage = 'Validation error'
                                    throw new Error()
                                }
        
                                return data.then(data => {
                                    Alpine.store('global').swalMessage = data.message || 'Unexpected error'
                                    throw new Error()
                                })
                            })
                            .then(data => {
                                $('#product_category_dataTable').DataTable().ajax.reload()
        
                                Alpine.store('global').showFlash(data.message, 'success')
                            })
                            .catch((error) => {
                                Alpine.store('global').showFlash(Alpine.store('global').swalMessage, 'error')
                                Swal.close()
                                return showSwalAlert('error', Alpine.store('global').swalMessage)
                            })
                        }
                    })
                }, 
            })
        })
    </script>
@endpush
