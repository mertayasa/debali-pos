@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
@endpush

<table class="table table-hover " width="100%" id="customer_dataTable"></table>

@push('scripts')
    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
    <script>
        let table
        let url = "{{ route('customer.datatable') }}"
        datatable(url)

        function datatable(url) {
            let columns = [{
                    data: 'DT_RowIndex',
                    name: 'no',
                    orderable: false,
                    searchable: false,
                    className: "text-start align-middle",
                    title: 'No'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    visible: false,
                    searchable: false,
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'Name',
                    orderable: false,
                    className: "text-start align-middle",
                },
                {
                    data: 'phone',
                    name: 'phone',
                    title: 'Phone',
                    orderable: false,
                    className: "text-start align-middle",
                },
                {
                    data: 'action',
                    name: 'action',
                    title: 'Action',
                    searchable: false,
                    orderable: false,
                    className: "text-start align-middle",
                },
            ]
            table = $('#customer_dataTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: url,
                // searching: false,
                // lengthChange: false,
                columns: columns,
                order: [
                    [1, "DESC"]
                ],
                columnDefs: [
                    // { width: 300, targets: 1 },
                    {
                        targets: '_all',
                        className: 'align-middle'
                    },
                    {
                        responsivePriority: 1,
                        targets: 1
                    },
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Search"
                },
            });
        }
    </script>
@endpush
