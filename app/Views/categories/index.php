<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/tables.css') ?>">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-prodeo fw-bold mb-0">Category List</h2>
        <p class="text-muted">Manage your hotel product categories</p>
    </div>
    <a href="<?= base_url('categories/create') ?>" class="btn btn-prodeo shadow-sm">+ Add New Category</a>
</div>

<div id="main-container">
    <?php if (!empty($categories)): ?>
        <div class="table-prodeo-container">
            <table class="table table-prodeo mb-0">
                <thead>
                    <tr>
                        <th class="col-id">ID</th>
                        <th class="col-name text-start ps-4">CATEGORY NAME</th>
                        <th class="col-actions">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                        <tr id="category-row-<?= $cat['id'] ?>">
                            <td class="fw-bold"><?= $cat['id'] ?></td>
                            <td class="fw-bold text-dark text-start ps-4"><?= esc($cat['name']) ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="<?= base_url('categories/edit/' . $cat['id']) ?>" class="btn btn-outline-primary btn-sm me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                        onclick="deleteCategory(<?= $cat['id'] ?>, '<?= esc($cat['name']) ?>', '<?= base_url() ?>', '<?= csrf_header() ?>', '<?= csrf_hash() ?>')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="text-center py-5 bg-white shadow-sm rounded-4 mt-4">
            <i class="fas fa-folder-open text-muted mb-3 empty-state-icon"></i>
            <p class="text-muted fs-5">No categories registered yet.</p>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets/js/categories.js') ?>"></script>

<script>
    <?php if (session()->getFlashdata('error_admin')): ?>
        Swal.fire({
            title: "Access Denied",
            text: "<?= session()->getFlashdata('error_admin') ?>",
            icon: "error",
            confirmButtonColor: "#3085d6"
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            title: "Success",
            text: "<?= session()->getFlashdata('success') ?>",
            icon: "success",
            confirmButtonColor: "#3085d6"
        });
    <?php endif; ?>
</script>

<?= $this->endSection() ?>