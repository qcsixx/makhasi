@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<!-- Info boxes -->
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-utensils"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Food Items</span>
                <span class="info-box-number">
                    {{ $stats['total_makanan'] }}
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-map-marker-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Regions</span>
                <span class="info-box-number">{{ $stats['total_daerah'] }}</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-plus-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Added Today</span>
                <span class="info-box-number">{{ $stats['today_added'] }}</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-calendar-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">This Month</span>
                <span class="info-box-number">{{ $stats['this_month'] }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">
        <!-- Food by Region Chart -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Food Distribution by Region
                </h3>
            </div>
            <div class="card-body">
                <canvas id="foodByRegionChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bolt mr-1"></i>
                    Quick Actions
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('admin.food.create') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-plus"></i> Add New Food Item
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('admin.food.index') }}" class="btn btn-info btn-block">
                            <i class="fas fa-list"></i> View All Food Items
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Right col -->
    <section class="col-lg-5 connectedSortable">
        <!-- Recent Activity -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-history mr-1"></i>
                    Recent Activity
                </h3>
            </div>
            <div class="card-body p-0">
                @if($recent_activities->count() > 0)
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($recent_activities as $activity)
                            <li class="item">
                                <div class="product-img">
                                    <div class="img-size-50 d-flex align-items-center justify-content-center bg-light rounded-circle">
                                        <i class="fas fa-user-circle fa-2x text-secondary"></i>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <span class="product-title">
                                        {{ $activity->user ? $activity->user->name : 'System' }}
                                        @php
                                            $badges = [
                                                'create' => 'success',
                                                'update' => 'warning',
                                                'delete' => 'danger',
                                                'bulk_delete' => 'danger',
                                                'login' => 'info',
                                                'logout' => 'secondary',
                                            ];
                                            $badgeColor = $badges[$activity->action] ?? 'secondary';
                                        @endphp
                                        <span class="badge badge-{{ $badgeColor }} float-right">{{ ucfirst(str_replace('_', ' ', $activity->action)) }}</span>
                                    </span>
                                    <span class="product-description">
                                        {{ \Illuminate\Support\Str::limit($activity->description, 60) }}
                                        <br>
                                        <small class="text-muted"><i class="far fa-clock"></i> {{ $activity->created_at->diffForHumans() }}</small>
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-history fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No Activity Yet</p>
                    </div>
                @endif
            </div>
            @if($recent_activities->count() > 0)
                <div class="card-footer text-center">
                    <a href="{{ route('admin.activity-log') }}" class="uppercase">View All Activity Logs</a>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Food by Region Chart
    const ctx = document.getElementById('foodByRegionChart');

    const data = {
        labels: [
            @foreach($makanan_by_daerah as $item)
                '{{ $item->daerah->nama }}',
            @endforeach
        ],
        datasets: [{
            label: 'Food Items',
            data: [
                @foreach($makanan_by_daerah as $item)
                    {{ $item->total }},
                @endforeach
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: false
                }
            }
        },
    };

    new Chart(ctx, config);
});
</script>
@endpush
