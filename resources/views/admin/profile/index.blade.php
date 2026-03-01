@extends('layouts.admin')

@section('title', 'Admin Profile')
@section('page-title', 'My Profile')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image Card -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <div class="profile-user-img img-fluid img-circle bg-light d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; margin: 0 auto; font-size: 2.5rem; color: #adb5bd;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>

                <h3 class="profile-username text-center mt-3">{{ $user->name }}</h3>
                <p class="text-muted text-center">{{ ucfirst($user->role ?? 'Administrator') }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right text-dark">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Joined</b> <a class="float-right text-dark">{{ $user->created_at->format('M Y') }}</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="profile-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="info-tab" data-toggle="pill" href="#info" role="tab" aria-controls="info" aria-selected="true">Personal Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="password-tab" data-toggle="pill" href="#security" role="tab" aria-controls="security" aria-selected="false">Security / Password</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="profile-tabs-content">
                    <!-- Personal Info Tab -->
                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                        <form class="form-horizontal" action="{{ route('admin.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label text-md-right">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label text-md-right">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-4">
                                <div class="offset-sm-2 col-sm-10 text-right">
                                    <button type="submit" class="btn btn-primary px-4 btn-mobile-full">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Security Tab -->
                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="password-tab">
                        <form class="form-horizontal" action="{{ route('admin.profile.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="inputCurrentPass" class="col-sm-3 col-form-label text-md-right">Current Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputCurrentPass" name="current_password" placeholder="Enter current password">
                                    @error('current_password')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputNewPass" class="col-sm-3 col-form-label text-md-right">New Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputNewPass" name="password" placeholder="Enter new password">
                                    @error('password')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputConfirmPass" class="col-sm-3 col-form-label text-md-right">Confirm Pass</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputConfirmPass" name="password_confirmation" placeholder="Confirm new password">
                                </div>
                            </div>
                            <div class="form-group row mt-4">
                                <div class="offset-sm-3 col-sm-9 text-right">
                                    <button type="submit" class="btn btn-primary px-4 btn-mobile-full">Update Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
@endsection
