<!-- Improved Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteConfirmModalLabel">
                    <i class="fa fa-exclamation-triangle"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Apakah Anda yakin ingin menghapus item ini?</p>
                <div class="alert alert-warning mb-0">
                    <i class="fa fa-info-circle"></i>
                    <strong>Perhatian:</strong> Tindakan ini tidak dapat dibatalkan.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="fa fa-trash"></i> Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Improved Delete Confirmation Handler
    let deleteForm = null;

    document.addEventListener('DOMContentLoaded', function () {
        // Attach click handlers to all delete buttons
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                deleteForm = this.closest('form');

                // Show modal
                const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
                modal.show();
            });
        });

        // Handle confirm button
        document.getElementById('confirmDeleteBtn')?.addEventListener('click', function () {
            if (deleteForm) {
                // Add loading state
                this.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Menghapus...';
                this.disabled = true;

                // Submit form
                deleteForm.submit();
            }
        });
    });
</script>