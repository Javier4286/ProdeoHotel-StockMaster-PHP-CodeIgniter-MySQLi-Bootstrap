<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/products.css') ?>">

<div class="prodeo-card mx-auto" style="max-width: 600px;">
    <div class="prodeo-card-header">
        <i class="fas fa-exchange-alt me-2"></i> REGISTER MOVEMENT
    </div>
    <div class="bg-white p-5 shadow-sm" style="border-radius: 0 0 15px 15px;">
        <form id="transactionForm" data-base-url="<?= base_url() ?>">
            <?= csrf_field() ?>
            <div id="alertPlaceholder"></div>

            <div class="mb-4">
                <label class="form-label fw-bold text-dark">Select Product</label>
                <select name="id_product" id="id_product" class="form-select shadow-sm" required>
                    <option value="">Choose a product...</option>
                    <?php foreach ($products as $p): ?>
                        <option value="<?= $p['id'] ?>">
                            <?= esc($p['name']) ?> (Current: <?= $p['quantity'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <div id="stockInfo" class="mt-2 text-primary fw-bold" style="display: none;">
                    <i class="fas fa-info-circle me-1"></i> Available stock: <span id="currentStockQty">0</span>
                </div>
            </div>

            <div class="mb-4 text-center">
                <label class="form-label d-block mb-3 fw-bold text-dark">Movement Type</label>
                <div class="d-flex justify-content-center gap-5">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="movement" id="in" value="in" checked>
                        <label class="form-check-label text-success fw-bold" for="in">ENTRY (+)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="movement" id="out" value="out">
                        <label class="form-check-label text-danger fw-bold" for="out">EXIT (-)</label>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold text-dark">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control text-center fs-4 shadow-sm" placeholder="0" required min="1">
            </div>

            <div class="d-flex justify-content-center gap-4 mt-5">
                <a href="<?= base_url('transactions') ?>" class="btn btn-light border px-4 py-2 rounded-3 fw-bold text-muted text-uppercase">
                    CANCEL
                </a>
                <button type="submit" id="btnSubmit" class="btn-prodeo-fixed px-4 py-2 rounded-3 text-uppercase">
                    SAVE MOVEMENT
                </button>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url('assets/js/transactions.js') ?>"></script>

<?= $this->endSection() ?>