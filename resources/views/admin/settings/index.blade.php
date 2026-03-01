@extends('layouts.admin')

@section('title', 'General Settings')
@section('page-title', 'General Settings')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="settings-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="general-tab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="appearance-tab" data-toggle="pill" href="#appearance" role="tab" aria-controls="appearance" aria-selected="false">Appearance</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="tab-content" id="custom-tabs-four-tabContent">

                        <!-- General Settings DO -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="form-group row">
                                <label for="site_name" class="col-sm-2 col-form-label text-md-right">Site Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $settings['site_name'] ?? 'MaKhasi Library' }}" placeholder="Enter site name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="site_description" class="col-sm-2 col-form-label text-md-right">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="site_description" name="site_description" rows="3" placeholder="Enter site description">{{ $settings['site_description'] ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="footer_text" class="col-sm-2 col-form-label text-md-right">Footer Text</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="footer_text" name="footer_text" value="{{ $settings['footer_text'] ?? '' }}" placeholder="Enter footer copyright text">
                                </div>
                            </div>
                        </div>

                        <!-- Appearance Settings -->
                        <div class="tab-pane fade" id="appearance" role="tabpanel" aria-labelledby="appearance-tab">
                            <div class="form-group row">
                                <label for="site_logo" class="col-sm-2 col-form-label text-md-right">Site Logo</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="site_logo" name="site_logo" accept="image/*">
                                            <label class="custom-file-label" for="site_logo">Choose file</label>
                                        </div>
                                    </div>

                                    @if(isset($settings['site_logo']))
                                        <div class="mt-2">
                                            <img src="{{ asset('images/' . $settings['site_logo']) }}" alt="Current Logo" class="img-thumbnail" style="max-height: 100px;">
                                            <p class="text-muted small">Current Logo</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="site_favicon" class="col-sm-2 col-form-label text-md-right">Favicon</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="site_favicon" name="site_favicon" accept="image/*">
                                            <label class="custom-file-label" for="site_favicon">Choose file</label>
                                        </div>
                                    </div>

                                    @if(isset($settings['site_favicon']))
                                        <div class="mt-2">
                                            <img src="{{ asset('images/' . $settings['site_favicon']) }}" alt="Current Favicon" class="img-thumbnail" style="max-height: 50px;">
                                            <p class="text-muted small">Current Favicon</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary float-right btn-mobile-full">
                                <i class="fas fa-save"></i> Save Settings
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Custom file input label update
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@endpush
