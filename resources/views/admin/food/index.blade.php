@extends('layouts.admin')

@section('title', 'Food Management')

@section('page-title', 'Food Management')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Food Items</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Food Items</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-danger btn-sm mr-2" id="bulkDeleteBtn" style="display: none;">
                <i class="fas fa-trash"></i> Delete Selected (<span id="selectedCount">0</span>)
            </button>
            <a href="{{ route('admin.food.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add New Food
            </a>
        </div>
    </div>
    <div class="card-body">
        <!-- Search & Filter Bar -->
        <div class="row mb-3">
            <div class="col-md-3">
                <select id="filterDaerah" class="form-control">
                    <option value="">All Regions</option>
                    @foreach($daerah as $id => $nama)
                        <option value="{{ $id }}">{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-9 text-right">
                <!-- DataTables search is automatic, but we can add custom filters here -->
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table id="foodTable" class="table table-bordered table-striped" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 20px;">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th style="width: 100px;">Image</th>
                        <th>Name</th>
                        <th>Region</th>
                        <th style="width: 150px;">Created</th>
                        <th style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data loaded via AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Generic View Modal -->
<div class="modal fade" id="foodDetailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Food Detail</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img id="modalImage" src="" class="img-fluid rounded" alt="">
                    </div>
                    <div class="col-md-8">
                        <p><strong>Region:</strong> <span id="modalRegion" class="badge badge-info"></span></p>
                        <p><strong>Description:</strong></p>
                        <p id="modalDesc"></p>
                        <p><strong>Recipe:</strong></p>
                        <div id="modalRecipe" class="border p-2 mb-2" style="max-height: 200px; overflow-y: auto;"></div>
                        <p><strong>Guide:</strong></p>
                        <div id="modalGuide" class="border p-2" style="max-height: 200px; overflow-y: auto;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="modalEditBtn" href="#" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Generic Image Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <img id="modalPreviewImage" src="" class="img-fluid w-100" alt="">
            </div>
        </div>
    </div>
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('styles')
<style>
    /* Custom style for checkboxes */
    .food-checkbox { transform: scale(1.2); cursor: pointer; }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#foodTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.food.index') }}",
            data: function (d) {
                d.daerah_id = $('#filterDaerah').val();
            }
        },
        columns: [
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'nama', name: 'nama'},
            {data: 'daerah_nama', name: 'daerah.nama'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [[4, 'desc']], // Sort by created_at desc (index 4)
        responsive: true,
        autoWidth: false,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search food...",
            processing: '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
        },
        drawCallback: function() {
            // Uncheck "select all" when page changes
            $('#selectAll').prop('checked', false);
            updateBulkDeleteBtn();
        }
    });

    // Filter by Region
    $('#filterDaerah').change(function(){
        table.draw();
    });

    // Select All Checkbox
    $('#selectAll').change(function(){
        $('.food-checkbox').prop('checked', $(this).prop('checked'));
        updateBulkDeleteBtn();
    });

    // Individual Checkbox Click
    $('#foodTable').on('change', '.food-checkbox', function(){
        updateBulkDeleteBtn();
        // If all checked, check Select All
        var total = $('.food-checkbox').length;
        var checked = $('.food-checkbox:checked').length;
        $('#selectAll').prop('checked', total === checked && total > 0);
    });

    function updateBulkDeleteBtn() {
        var count = $('.food-checkbox:checked').length;
        $('#selectedCount').text(count);
        if(count > 0) {
            $('#bulkDeleteBtn').fadeIn();
        } else {
            $('#bulkDeleteBtn').fadeOut();
        }
    }

    // Bulk Delete Action
    $('#bulkDeleteBtn').click(function() {
        var ids = [];
        $('.food-checkbox:checked').each(function() {
            ids.push($(this).val());
        });

        if(ids.length === 0) return;

        Swal.fire({
            title: 'Are you sure?',
            html: `You are about to delete <strong>${ids.length}</strong> items. This action cannot be undone.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete them!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('admin.food.bulk-delete') }}",
                    type: "POST",
                    data: {
                        ids: ids,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Deleted!', response.message, 'success');
                            table.ajax.reload();
                        } else {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Failed to process request.', 'error');
                    }
                });
            }
        });
    });

    // Handle View Button Click
    $('#foodTable').on('click', '.view-btn', function() {
        var id = $(this).data('id');
        var url = "{{ route('admin.food.show', ':id') }}".replace(':id', id);
        var editUrl = "{{ route('admin.food.edit', ':id') }}".replace(':id', id);

        // Show loading state or clear previous data
        $('#modalTitle').text('Loading...');
        $('#modalImage').attr('src', '');
        $('#modalRegion').text('');
        $('#modalDesc, #modalRecipe, #modalGuide').html('<div class="spinner-border spinner-border-sm" role="status"></div>');

        $('#foodDetailModal').modal('show');

        // Fetch Data
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $('#modalTitle').text(data.nama);
                $('#modalImage').attr('src', data.image_url);
                $('#modalRegion').text(data.daerah.nama);
                $('#modalDesc').text(data.deskripsi || '-');
                $('#modalRecipe').html(nl2br(data.resep) || '-');
                $('#modalGuide').html(nl2br(data.panduan) || '-');
                $('#modalEditBtn').attr('href', editUrl);
            },
            error: function() {
                $('#modalTitle').text('Error');
                $('#modalDesc').text('Failed to load data.');
            }
        });
    });

    // Handle Image Preview Click
    $('#foodTable').on('click', '.preview-img-btn', function() {
        var src = $(this).data('src');
        $('#modalPreviewImage').attr('src', src);
        $('#imagePreviewModal').modal('show');
    });

    // Helper function for newlines
    function nl2br(str) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br />$2');
    }
});

// We need to fix the controller's button generation to work with the SINGLE modal approach.
// Update controller to use: class="view-btn" data-id="1"
// Then JS handles the click, fetches data, opens modal.

function confirmDelete(id, name) {
    Swal.fire({
        title: 'Are you sure?',
        html: `You are about to delete <strong>${name}</strong>. This action cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('deleteForm');
            form.action = `/admin/food/${id}`;
            form.submit();
        }
    });
}
</script>
@endpush
