<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/forms.css') ?>">

<div class="prodeo-card category-container">
    <div class="prodeo-card-header">
        <i class="fas fa-box-open me-2"></i> Add New Product
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

        <form action="<?= base_url('products/store') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold text-prodeo small text-uppercase">Product Name</label>
                    <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold text-prodeo small text-uppercase">Category</label>
                    <select name="id_category" class="form-select" required>
                        <option value="">Select category</option>
                        <?php foreach ($categories as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= old('id_category') == $c['id'] ? 'selected' : '' ?>>
                                <?= esc($c['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold text-prodeo small text-uppercase">Description</label>
                    <textarea name="description" class="form-control" rows="3" minlength="30" maxlength="300" required
                        placeholder="Provide a detailed description (brand, technical specs, measurements)..."><?= old('description') ?></textarea>
                    <div class="form-text text-muted mt-2">Minimum 30 characters required for inventory quality.</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold text-prodeo small text-uppercase">Initial Stock</label>
                    <input type="number" name="quantity" class="form-control" value="<?= old('quantity', 0) ?>" min="0" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold text-prodeo small text-uppercase">Min. Stock Alert</label>
                    <input type="number" name="min_stock" class="form-control" value="<?= old('min_stock', 5) ?>" min="1" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold text-prodeo small text-uppercase">Price ($)</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="<?= old('price') ?>" min="0" required>
                </div>
            </div>

            <div class="btn-form-wrapper">
                <a href="<?= base_url('products') ?>" class="btn-form btn-cancel-custom px-5 py-3 text-uppercase">
                    Cancel
                </a>
                <button type="submit" class="btn-form btn-save px-5 py-3 text-uppercase">
                    Save Product
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>