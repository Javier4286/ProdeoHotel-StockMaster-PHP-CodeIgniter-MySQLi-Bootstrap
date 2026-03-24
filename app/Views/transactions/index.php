<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/tables.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/transactions-list.css') ?>">

<div class="header-container">
    <div>
        <h2 class="text-prodeo fw-bold mb-0">Stock Movements</h2>
        <p class="text-muted small mb-0">Track every entry and exit in your inventory</p>
    </div>

    <div class="search-container-dynamic">
        <i class="fas fa-search search-icon-inside"></i>
        <input type="text" id="ajax-search" class="form-control" placeholder="Search movements..." autocomplete="off" value="<?= esc($search ?? '') ?>">
        <button type="button" id="clear-search" class="clear-search-btn" style="<?= !empty($search) ? 'display:block;' : '' ?>">
            <i class="fas fa-times-circle"></i>
        </button>
    </div>

    <a href="<?= base_url('transactions/create') ?>" class="btn-prodeo-fixed <?= ($products_exist == 0) ? 'disabled' : '' ?>">
        <i class="fas fa-plus me-1"></i> New Transaction
    </a>
</div>

<div id="table-content">
    <?php if (!empty($transactions)): ?>
        <div class="table-prodeo-container shadow-sm">
            <table class="table table-prodeo mb-0">
                <thead>
                    <tr>
                        <th style="width: 20%;">DATE</th>
                        <th class="text-start ps-4">PRODUCT</th>
                        <th>TYPE</th>
                        <th>QTY</th>
                        <th>USER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $t): ?>
                        <tr>
                            <td class="text-muted small"><?= date('d/m/Y H:i', strtotime($t['created_at'])) ?></td>
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark"><?= esc($t['product_name']) ?></div>
                            </td>
                            <td>
                                <?php if ($t['movement'] == 'in'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1" style="border-radius: 50px; font-weight: 700; font-size: 0.75rem;">
                                        <i class="fas fa-arrow-down me-1"></i> ENTRY
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1" style="border-radius: 50px; font-weight: 700; font-size: 0.75rem;">
                                        <i class="fas fa-arrow-up me-1"></i> EXIT
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold text-center"><?= $t['quantity'] ?></td>
                            <td class="text-muted small">
                                <i class="fas fa-user-circle me-1 opacity-50"></i>
                                <?= esc($t['first_name'] . ' ' . $t['last_name']) ?>
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
            <p class="text-muted fs-5">No movements found matching your criteria.</p>
        </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/transactions-list.js') ?>"></script>

<?= $this->endSection() ?>