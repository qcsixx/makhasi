@extends('layouts.admin')

@section('title', 'Add New Food')

@section('page-title', 'Add New Food Item')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.food.index') }}">Food Items</a></li>
    <li class="breadcrumb-item active">Add New</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Food Information</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.food.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.food.store') }}" method="POST" enctype="multipart/form-data" id="foodForm" novalidate>
                @csrf
                <div class="card-body">
                    <!-- Basic Information Section -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Food Name <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('nama') is-invalid @enderror"
                                       id="nama"
                                       name="nama"
                                       value="{{ old('nama') }}"
                                       placeholder="Enter food name">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    <span id="charCount">0</span>/255 characters
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="daerah_id">Region <span class="text-danger">*</span></label>
                                <select class="form-control @error('daerah_id') is-invalid @enderror"
                                        id="daerah_id"
                                        name="daerah_id">
                                    <option value="">Select Region</option>
                                    @foreach($daerah as $id => $nama)
                                        <option value="{{ $id }}" {{ old('daerah_id') == $id ? 'selected' : '' }}>
                                            {{ $nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('daerah_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Image Upload Section -->
                    <div class="form-group">
                        <label>Food Image <span class="text-danger">*</span></label> <!-- Text label above -->

                        <input type="file"
                               id="image"
                               name="image"
                               accept="image/*"
                               style="display: none;">

                        <label class="upload-zone" id="uploadZone" for="image" style="cursor: pointer; display: block; font-weight: normal;">
                            <div id="uploadContent">
                                <i class="fas fa-cloud-upload-alt upload-zone-icon"></i>
                                <div class="upload-zone-text">Drag & Drop Image Here</div>
                                <div class="upload-zone-subtext">or click to browse</div>
                                <div class="mt-2 text-muted small">Max size: 2MB (JPG, PNG)</div>
                            </div>
                        </label>
                        <div class="invalid-feedback" id="imageError" style="display: none;">Please select an image.</div>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <!-- Image Preview -->
                        <div id="uploadPreview" class="upload-preview-container">
                            <img id="previewImg" src="" alt="Preview" class="upload-preview-img">
                            <div class="upload-remove-btn" id="removeImage">
                                <i class="fas fa-times"></i> Remove Image
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="form-group">
                        <label for="deskripsi">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control tinymce-editor @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi"
                                  name="deskripsi"
                                  rows="4"
                                  placeholder="Enter food description">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Recipe Section -->
                    <div class="form-group">
                        <label for="resep">Recipe <span class="text-danger">*</span></label>
                        <textarea class="form-control tinymce-editor @error('resep') is-invalid @enderror"
                                  id="resep"
                                  name="resep"
                                  rows="6"
                                  placeholder="Enter recipe instructions">{{ old('resep') }}</textarea>
                        @error('resep')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Guide Section -->
                    <div class="form-group">
                        <label for="panduan">Cooking Guide <span class="text-danger">*</span></label>
                        <textarea class="form-control tinymce-editor @error('panduan') is-invalid @enderror"
                                  id="panduan"
                                  name="panduan"
                                  rows="6"
                                  placeholder="Enter cooking guide">{{ old('panduan') }}</textarea>
                        @error('panduan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Food Item
                    </button>
                    <a href="{{ route('admin.food.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        // Character counter for nama field
        $('#nama').on('input', function() {
            $('#charCount').text($(this).val().length);
        });

        // Drag & Drop Upload Logic
        const uploadZone = document.getElementById('uploadZone');
        const imageInput = document.getElementById('image');
        const uploadContent = document.getElementById('uploadContent');
        const uploadPreview = document.getElementById('uploadPreview');
        const previewImg = document.getElementById('previewImg');
        const removeImage = document.getElementById('removeImage');

        // Drag events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            uploadZone.classList.add('dragover');
            uploadZone.style.borderColor = '#007bff';
            uploadZone.style.backgroundColor = '#e9ecef';
        }

        function unhighlight(e) {
            uploadZone.classList.remove('dragover');
            uploadZone.style.borderColor = '#ced4da';
            uploadZone.style.backgroundColor = '#f8f9fa';
        }

        // Handle Drop
        uploadZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            imageInput.files = files; // Assign dropped files to input
            handleFiles(files);
        }

        // Handle Click/Select (Input Change)
        imageInput.addEventListener('change', function() {
            // console.log('File matched:', this.files.length); // Debug
            handleFiles(this.files);
        });

        function handleFiles(files) {
            if (files.length > 0) {
                const file = files[0];

                // Validate size
                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire('Error', 'File size must be less than 2MB', 'error');
                    resetUpload();
                    return;
                }

                // Preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    uploadContent.style.display = 'none';
                    uploadPreview.style.display = 'block';
                    uploadZone.style.padding = '1rem';
                    uploadZone.style.borderStyle = 'solid';

                    // Hide error if visible
                    $('#imageError').hide();
                }
                reader.readAsDataURL(file);
            }
        }

        // Remove Image
        removeImage.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent triggering upload zone click
            resetUpload();
        });

        function resetUpload() {
            imageInput.value = '';
            previewImg.src = '';
            uploadPreview.style.display = 'none';
            uploadContent.style.display = 'block';
            uploadZone.style.padding = '2rem';
            uploadZone.style.borderStyle = 'dashed';
            uploadZone.style.borderColor = '#ced4da';
        }

        // AJAX Form Submission
        // AJAX Form Submission
        $('#foodForm').off('submit').on('submit', function(e) {
            e.preventDefault();
            console.log('Form submission intercepted'); // Debug

            // Trigger TinyMCE save safely
            try {
                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                    console.log('TinyMCE saved');
                }
            } catch (err) {
                console.error('TinyMCE Error:', err);
            }

            // Client-side validation for image
            console.log('Checking image files:', imageInput.files.length);
            if (imageInput.files.length === 0) {
                 Swal.fire({
                    icon: 'warning',
                    title: 'Missing Image',
                    text: 'Please select a food image before saving.'
                });
                return;
            }

            // Create FormData
            var formData = new FormData(this);

            // Show Loading
            Swal.fire({
                title: 'Saving...',
                text: 'Please wait while we upload the image and save data.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('admin.food.store') }}",
                method: "POST",
                data: formData,
                contentType: false, // Required for FormData
                processData: false, // Required for FormData
                success: function(response) {
                    console.log('Success:', response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message || 'Food item created successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = "{{ route('admin.food.index') }}";
                    });
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    var errorMessage = 'Something went wrong.';
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        errorMessage = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorMessage += value[0] + '\n';
                            // Highlight fields
                            $('[name="' + key + '"]').addClass('is-invalid');
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Submission Failed',
                        text: errorMessage
                    });
                }
            });
        });

        // Remove is-invalid on input
        $('input, select, textarea').on('input change', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>
@endpush
