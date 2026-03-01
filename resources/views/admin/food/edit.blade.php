@extends('layouts.admin')

@section('title', 'Edit Food')

@section('page-title', 'Edit Food Item')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.food.index') }}">Food Items</a></li>
    <li class="breadcrumb-item active">Edit: {{ $makanan->nama }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit: {{ $makanan->nama }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.food.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.food.update', $makanan->id) }}" method="POST" enctype="multipart/form-data" id="foodForm">
                @csrf
                @method('PUT')
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
                                       value="{{ old('nama', $makanan->nama) }}"
                                       placeholder="Enter food name"
                                       required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    <span id="charCount">{{ strlen($makanan->nama) }}</span>/255 characters
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="daerah_id">Region <span class="text-danger">*</span></label>
                                <select class="form-control @error('daerah_id') is-invalid @enderror"
                                        id="daerah_id"
                                        name="daerah_id"
                                        required>
                                    <option value="">Select Region</option>
                                    @foreach($daerah as $id => $nama)
                                        <option value="{{ $id }}" {{ old('daerah_id', $makanan->daerah_id) == $id ? 'selected' : '' }}>
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

                    <!-- Current Image Display -->
                    <div class="form-group">
                        <label>Current Image</label>
                        <div>
                            <img src="{{ asset('images/' . $makanan->image) }}"
                                 alt="{{ $makanan->nama }}"
                                 class="img-thumbnail"
                                 style="max-width: 300px;"
                                 id="currentImage">
                        </div>
                    </div>

                    <!-- Image Upload Section -->
                    <div class="form-group">
                        <label for="image">Replace Image (Optional)</label>

                        <div class="upload-zone" id="uploadZone">
                            <input type="file"
                                   id="image"
                                   name="image"
                                   accept="image/*">
                            <div id="uploadContent">
                                <i class="fas fa-cloud-upload-alt upload-zone-icon"></i>
                                <div class="upload-zone-text">Drag & Drop New Image Here</div>
                                <div class="upload-zone-subtext">or click to browse to replace current image</div>
                                <div class="mt-2 text-muted small">Max size: 2MB (JPG, PNG)</div>
                            </div>
                        </div>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <!-- New Image Preview -->
                        <div id="uploadPreview" class="upload-preview-container">
                            <p class="text-left font-weight-bold ml-2">New Image Preview:</p>
                            <img id="previewImg" src="" alt="Preview" class="upload-preview-img">
                            <div class="upload-remove-btn" id="removeImage">
                                <i class="fas fa-times"></i> Remove New Image
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
                                  placeholder="Enter food description"
                                  required>{{ old('deskripsi', $makanan->deskripsi) }}</textarea>
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
                                  placeholder="Enter recipe instructions"
                                  required>{{ old('resep', $makanan->resep) }}</textarea>
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
                                  placeholder="Enter cooking guide"
                                  required>{{ old('panduan', $makanan->panduan) }}</textarea>
                        @error('panduan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Last Updated Info -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Last Updated:</strong> {{ $makanan->updated_at->format('d M Y, H:i') }}
                        ({{ $makanan->updated_at->diffForHumans() }})
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Food Item
                    </button>
                    <a href="{{ route('admin.food.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="button" class="btn btn-danger float-right" onclick="confirmDelete()">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" action="{{ route('admin.food.destroy', $makanan->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for nama field
    const namaInput = document.getElementById('nama');
    const charCount = document.getElementById('charCount');

    namaInput.addEventListener('input', function() {
        charCount.textContent = this.value.length;
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
        imageInput.files = files;
        handleFiles(files);
    }

    // Handle Click/Select
    imageInput.addEventListener('change', function() {
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
            }
            reader.readAsDataURL(file);
        }
    }

    // Remove Image
    removeImage.addEventListener('click', function(e) {
        e.stopPropagation();
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

    // Form validation
    const form = document.getElementById('foodForm');
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields');
        }
    });
});

// Delete confirmation
function confirmDelete() {
    Swal.fire({
        title: 'Are you sure?',
        html: 'You are about to delete <strong>{{ addslashes($makanan->nama) }}</strong>. This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm').submit();
        }
    });
}
</script>
@endpush
