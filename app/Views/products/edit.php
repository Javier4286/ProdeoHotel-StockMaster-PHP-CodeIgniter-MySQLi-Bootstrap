<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/forms.css') ?>">

<div class="prodeo-card category-container mx-auto" style="max-width: 750px;">
    <div class="prodeo-card-header">
        <i class="fas fa-edit me-2"></i> Edit Product: <?= esc($product['name']) ?>
    </div>
    <div class="category-body bg-white p-5 shadow-sm" style="border-radius: 0 0 15px 15px;">

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger mb-4 border-0 shadow-sm" style="border-radius: 10px;">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= base_url('products/update/' . $product['id']) ?>" method="POST">
            <?= csrf_field() ?>

            <div class="row g-4">
                <div class="col-md-7">
                    <label class="form-label fw-bold text-prodeo small text-uppercase">Product Name</label>
                    <input type="text" name="name" class="form-control" value="<?= old('name', $product['name']) ?>" required placeholder="Enter product name">
                </div>

                <div class="col-md-5">
                    <label class="form-label fw-bold text-prodeo small text-uppercase">Category</label>
                    <select name="id_category" class="form-select" required>
                        <option value="" disabled>Select a category</option>
                        <?php foreach ($categories as $c): ?>
                            <option value="<?= $c['id'] ?>" <?= (old('id_category', $product['id_category']) == $c['id']) ? 'selected' : '' ?>>
                                <?= esc($c['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label fw-bold text-prodeo small text-uppercase">Description</label>
                    <textarea name="description" class="form-control" rows="3" minlength="30" maxlength="300" required placeholder="Describe the product use case..."><?= old('description', $product['description']) ?></textarea>
                    <div class="form-text text-muted mt-2 small">Update description carefully (min. 30 chars).</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold text-prodeo small text-uppercase">Current Stock</label>
                    <input type="number" name="quantity" class="form-control text-center fw-bold" value="<?= old('quantity', $product['quantity']) ?>" min="0" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold text-prodeo small text-uppercase">Min. Stock Alert</label>
                    <input type="number" name="min_stock" class="form-control text-center fw-bold text-danger" value="<?= old('min_stock', $product['min_stock']) ?>" min="1" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold text-prodeo small text-uppercase">Price ($)</label>
                    <input type="number" step="0.01" name="price" class="form-control text-center fw-bold" value="<?= old('price', $product['price']) ?>" min="0" required>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-5">
                <a href="<?= base_url('products') ?>" class="btn-cancel-custom px-5 py-2 rounded-3 text-uppercase text-decoration-none text-center">
                    Cancel
                </a>
                <button type="submit" class="btn-save px-5 py-2 rounded-3 text-uppercase border-0">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>