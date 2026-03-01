@extends('layouts.admin')

@section('title', 'User Management')
@section('page-title', 'User Management')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createUserModal">
                        <i class="fas fa-plus"></i> Add New User
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="userTable" class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="10%">Role</th>
                            <th width="15%">Registered</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="createUserForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="usertype">Role</label>
                        <select class="form-control" id="usertype" name="usertype">
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editUserForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_password">Password (Leave blank to keep current)</label>
                        <input type="password" class="form-control" id="edit_password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="edit_usertype">Role</label>
                        <select class="form-control" id="edit_usertype" name="usertype">
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {

        // Initialize DataTable
        var table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.users.index') }}",
                error: function (xhr, error, code) {
                    console.log(xhr);
                    console.log(code);
                    Swal.fire(
                        'Data Error',
                        'Failed to load user data. Verify your connection or check server logs.',
                        'error'
                    );
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'role_badge', name: 'usertype'},
                {data: 'created_at', name: 'created_at', render: function(data){
                    return new Date(data).toLocaleDateString();
                }},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            responsive: true,
            autoWidth: false
        });

        // Create User - Attach Handler FIRST
        $(document).on('submit', '#createUserForm', function(e){
            e.preventDefault();

            $.ajax({
                url: "{{ route('admin.users.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response){
                    $('#createUserModal').modal('hide');
                    $('#createUserForm')[0].reset();

                    // Show notification THEN reload
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'User created successfully',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr){
                    var errorMessage = 'Something went wrong.';
                    if(xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMessage = '';
                        $.each(xhr.responseJSON.errors, function(key, value){
                            errorMessage += value[0] + '\n';
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire('Error', errorMessage, 'error');
                }
            });
        });

        // Edit Button Click
        $('body').on('click', '.edit-btn', function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var role = $(this).data('role');

            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_usertype').val(role);
            $('#edit_password').val(''); // Clear password field

            $('#editUserModal').modal('show');
        });

        // Update User
        $('#editUserForm').on('submit', function(e){
            e.preventDefault();
            var id = $('#edit_id').val();
            $.ajax({
                url: "{{ url('admin/users') }}/" + id,
                method: "POST", // Method spoofing via _method input
                data: $(this).serialize(),
                success: function(response){
                    $('#editUserModal').modal('hide');
                    if($.fn.DataTable.isDataTable('#userTable')) {
                        $('#userTable').DataTable().ajax.reload();
                    }
                    Swal.fire('Success', 'User updated successfully', 'success');
                },
                error: function(xhr){
                    var errorMessage = 'Something went wrong.';
                    if(xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMessage = '';
                        $.each(xhr.responseJSON.errors, function(key, value){
                            errorMessage += value[0] + '\n';
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire('Error', errorMessage, 'error');
                }
            });
        });

        // Delete User
        $('body').on('click', '.delete-btn', function(){
            var id = $(this).data('id');
            var name = $(this).data('name');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/users') }}/" + id,
                        method: "POST",
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response){
                            if($.fn.DataTable.isDataTable('#userTable')) {
                                $('#userTable').DataTable().ajax.reload();
                            }
                            Swal.fire('Deleted!', 'User has been deleted.', 'success');
                        },
                        error: function(xhr){
                            var errorMessage = 'Something went wrong.';
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorMessage = xhr.responseJSON.error;
                            }
                            Swal.fire('Error', errorMessage, 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
