@extends('layouts.admin')

@section('title', 'Activity Logs')

@section('page-title', 'Activity Logs')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Activity Logs</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">System Activities</h3>
            </div>
            <div class="card-body">
                <table id="activityTable" class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>Model</th>
                            <th>IP Address</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#activityTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.activity-logs.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'user_name', name: 'user.name'},
                {data: 'action', name: 'action'},
                {data: 'description', name: 'description'},
                {data: 'model', name: 'model'},
                {data: 'ip_address', name: 'ip_address'},
                {data: 'created_at', name: 'created_at'},
            ],
            order: [[6, 'desc']], // Sort by Date desc
            responsive: true,
            autoWidth: false
        });
    });
</script>
@endpush
