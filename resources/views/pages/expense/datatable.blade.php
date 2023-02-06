@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
@endpush

<table class="table table-hover " width="100%" id="expense_dataTable"></table>

@push('scripts')
    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
    <script>
        let table
        let url = "{{ route('expense.datatable') }}"
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
                    data: 'title',
                    name: 'title',
                    title: 'Title',
                    orderable: false,
                    className: "text-start align-middle",
                },
                {
                    data: 'amount',
                    name: 'amount',
                    title: 'Amount',
                    orderable: false,
                    className: "text-start align-middle",
                },
                {
                    data: 'expense_category.name',
                    name: 'expense_category.name',
                    title: 'Category',
                    orderable: false,
                    className: "text-start align-middle",
                },
                {
                    data: 'date',
                    name: 'date',
                    title: 'Date',
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
            table = $('#expense_dataTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: url,
                // searching: false,
                lengthChange: false,
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
