<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DEBALI</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .modal-dialog-bottom {
            display: flex;
            align-items: end;
            min-height: calc(100% - var(--bs-modal-margin) * 2);
        }

        .navbar-nav .nav-link.active {
            color: #ff0176;
            font-weight: 700;
        }
        .nav-link:hover {
            color: #ff0176;
            font-weight: 700;
        }
        button {
            font-weight: 700 !important;
        }
        .bg-danger {
            background-color: #ff0176;
        }
        .text-danger {
            color: #ff0176;
        }
        .btn-danger {
            background-color: #ff0176;
            border-color: #ff0176;
        }
        .btn-danger:hover {
            background-color: #d6146f;
            border-color: #d6146f;
        }

        .bg-info {
            background-color: #98DFF5;
        }
        .text-info {
            color: #98DFF5;
        }
        .btn-info {
            background-color: #98DFF5;
            border-color: #98DFF5;
        }
        .btn-info:hover {
            background-color: #94cddf;
            border-color: #94cddf;
        }

        .page-link{
            color: black;
        }
        
        .page-link.active, .active > .page-link{
            background-color: #98DFF5;
            border-color: #98DFF5;
            color: black;
        }

        .bg-warning {
            background-color: #FAF953;
        }
        .text-warning {
            color: #FAF953;
        }
        .btn-warning {
            background-color: #FAF953;
            border-color: #FAF953;
        }
        .btn-warning:hover {
            background-color: #e9e974;
            border-color: #e9e974;
        }
        .bg-success {
            background-color: #93F29F;
        }
        .text-success {
            color: #93F29F;
        }
        .btn-success {
            color: black;
            background-color: #93F29F;
            border-color: #93F29F;
        }
        .btn-success:hover {
            color: black;
            background-color: #9de0a6;
            border-color: #9de0a6;
        }
    </style>

    @stack('styles')
</head>

<body>
    <div id="app" x-data="{}">
        @include('layouts.includes.navbar')

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
<script defer src="{{ asset('plugins/alpinejs/alpine.min.js') }}"></script>
<script>
    const baseUrl = "{{ url('/') }}"

    function deleteModel(deleteUrl, tableId = null, model = '', additional_warning = '', additionalMethod = null) {
        Swal.fire({
            title: "Warning",
            text: `Destroy data ${model}? ${additional_warning}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#169b6b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(deleteUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        method: 'DELETE',
                    })
                    .then(function(response) {
                        const data = response.json()
                        if (response.status != 200) {
                            throw new Error()
                        }

                        return data
                    })
                    .then(data => {

                        if (tableId != null) {
                            $('#' + tableId).DataTable().ajax.reload()
                        } else {
                            return Swal.fire({
                                    title: 'Success',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                })
                                .then((result) => {
                                    if (additionalMethod != null) {
                                        additionalMethod()
                                    }

                                    if (result.isConfirmed) {
                                        window.location.reload()
                                    }
                                })
                        }

                        if (additionalMethod != null) {
                            additionalMethod.apply(this, [data.args])
                        }
                        Swal.fire('Success', data.message, 'success')
                    })
                    .catch((error) => {
                        Swal.fire('Error', "Data failed to delete", 'error')
                    })
            }
        })
    }

    function isNull(value) {
        if (value == '' || value == undefined || value == null) {
            return true
        }

        return false;
    }

    function strict2Decimal(element) {
        let value = element.value;
        element.value = (value.indexOf(".") >= 0) ? (value.substr(0, value.indexOf(".")) + value.substr(value.indexOf("."), 4)) : value
    }

    function rmStringFromNumber(value) {
        return value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')
    }

    document.body.addEventListener('input', function(element) {
        if (element.target.classList.contains('number-decimal')) {
            element.target.value = rmStringFromNumber(element.target.value)
            strict2Decimal(element.target)
        }
    })

    function showSwalAlert(type, message) {
        const title = type == 'success' ? 'Success' : (type == 'error' ? 'Oppps..' : 'Warning')
        return Swal.fire({
            title: title,
            html: message,
            icon: type,
        })
    }

    function clearFlash() {
        Alpine.store('global').isFlash = false
        Alpine.store('global').flashData = []
    }

    document.addEventListener('alpine:init', () => {
        Alpine.store('global', {
            swalMessage: 'Unexpected system error',
            isFlash: false,
            flashClass: 'error',
            flashData: [],
            showFlash: function(message, flashType) {
                this.isFlash = true
                switch (flashType) {
                    case 'success':
                        this.flashClass = 'bg-success'
                        break
                    case 'error':
                        this.flashClass = 'bg-danger'
                        break
                    case 'warning':
                        this.flashClass = 'bg-warning'
                        break
                    case 'info':
                        this.flashClass = 'bg-info'
                        break
                    default:
                        this.flashClass = 'bg-danger'
                        break
                }

                console.log('asdssad');
                
                if (typeof message === 'object') {
                    this.flashData = message
                } else {
                    this.flashData.push(message)
                }
            },
            clearForm(formId){
                const getAllFormElements = element => Array.from(element.elements).filter(tag => ["select", "textarea", "input"].includes(tag.tagName.toLowerCase()));
                const formInput = getAllFormElements(document.getElementById(formId))
                for (let index = 0; index < formInput.length; index++) {
                    const input = formInput[index]
                    switch (input.type) {
                        case 'password':
                        case 'select-multiple':
                        case 'select-one':
                        case 'text':
                        case 'textarea':
                            input.value = '';
                        case 'radio':
                        case 'checkbox':
                            input.checked = false;
                    }
                }
            }
        })
    })
</script>

@stack('scripts')

</html>
