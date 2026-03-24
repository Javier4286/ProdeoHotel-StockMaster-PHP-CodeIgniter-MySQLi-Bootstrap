<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/forms.css') ?>">

<div class="prodeo-card category-container">
    <div class="prodeo-card-header">
        <i class="fas fa-plus-circle me-2"></i> Add New Category
    </div>

    <div class="category-body">

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger shadow-sm mb-4 category-alert">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= base_url('categories/store') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-4 text-center">
                <label class="form-label fw-bold text-prodeo fs-5 mb-3 text-uppercase">
                    Category Name
                </label>
                <input type="text"
                    name="name"
                    class="form-control form-control-lg text-center shadow-sm category-input"
                    placeholder="e.g. Beverages, Housekeeping"
                    value="<?= old('name') ?>"
                    required>
            </div>

            <div class="btn-form-wrapper">
                <a href="<?= base_url('categories') ?>" class="btn-form btn-cancel-custom px-5 py-3">
                    CANCEL
                </a>
                <button type="submit" class="btn-form btn-save px-5 py-3">
                    SAVE CATEGORY
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>