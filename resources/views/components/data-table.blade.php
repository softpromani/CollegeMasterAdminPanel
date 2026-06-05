@props([

    'id' => 'datatable',

    'ajax' => '',

    'columns' => [],

])

<div class="table-responsive">

    <table
        id="{{ $id }}"
        class="table table-bordered table-striped w-100"
    >

        <thead>

            <tr>

                @foreach ($columns as $column)

                    <th>

                        {{ $column['title'] }}

                    </th>

                @endforeach

            </tr>

        </thead>

    </table>

</div>

@push('scripts')

<script>

$(document).ready(function () {

    $('#{{ $id }}').DataTable({

        processing: true,

        serverSide: true,

        responsive: true,

        ajax: "{{ $ajax }}",

        columns: @json($columns),

        dom: 'Bfrtip',

        buttons: [

            'copy',
            'csv',
            'excel',
            'pdf',
            'print'

        ]

    });

});

</script>

@endpush
