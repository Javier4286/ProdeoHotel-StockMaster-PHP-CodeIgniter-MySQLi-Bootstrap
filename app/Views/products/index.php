<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/tables.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/products.css') ?>">

<div class="header-container">
    <div>
        <h2 class="text-prodeo fw-bold mb-0">Product Inventory</h2>
        <p class="text-muted small mb-0">Manage your hotel stock and supplies</p>
    </div>

    <div class="search-container-dynamic">
        <i class="fas fa-search search-icon-inside"></i>
        <input type="text" id="ajax-search" class="form-control" placeholder="Search products..." autocomplete="off" value="<?= esc($search ?? '') ?>">
        <button type="button" id="clear-search" class="clear-search-btn">
            <i class="fas fa-times-circle"></i>
        </button>
    </div>

    <a href="<?= base_url('products/new') ?>" class="btn-prodeo-fixed">
        <i class="fas fa-plus me-1"></i> New Product
    </a>
</div>

<div id="table-content">
    <?php if (!empty($products)): ?>
        <div class="table-prodeo-container shadow-sm">
            <table class="table table-prodeo mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th class="text-start ps-4">PRODUCT NAME</th>
                        <th>CATEGORY</th>
                        <th>STOCK</th>
                        <th>PRICE</th>
                        <th style="width: 200px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $p): ?>
                        <tr id="product-row-<?= $p['id'] ?>">
                            <td class="fw-bold"><?= $p['id'] ?></td>
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark"><?= esc($p['name']) ?></div>
                                <small class="text-muted"><?= esc($p['description']) ?></small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-3">
                                    <?= esc($p['category_name']) ?>
                                </span>
                            </td>
                            <td class="fw-bold">
                                <span class="<?= ($p['quantity'] <= $p['min_stock']) ? 'text-danger' : '' ?>">
                                    <?= $p['quantity'] ?>
                                </span>
                            </td>
                            <td>$<?= number_format($p['price'], 2) ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('products/edit/' . $p['id']) ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                        onclick="deleteProduct(<?= $p['id'] ?>, '<?= esc($p['name']) ?>', '<?= base_url() ?>', '<?= csrf_token() ?>', '<?= csrf_hash() ?>')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="mt-4 d-flex justify-content-center pagination-wrapper pb-3">
                <?= $pager->links('default', 'bootstrap_full') ?>
            </div>
        </div>
    <?php else: ?>
        <div class="text-center py-5 bg-white shadow-sm rounded-4">
            <i class="fas fa-search text-muted mb-3" style="font-size: 3rem; opacity: 0.1;"></i>
            <p class="text-muted fs-5">No products found for your search.</p>
        </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets/js/products.js') ?>"></script>

<?= $this->endSection() ?>