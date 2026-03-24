<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/tables.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/reports.css') ?>">

<div class="header-container">
    <div class="header-text">
        <h2 class="text-prodeo fw-bold mb-0">Critical Stock Report</h2>
        <p class="text-muted small mb-0">Products that need immediate replenishment</p>
    </div>

    <div class="search-container-dynamic">
        <i class="fas fa-search search-icon-inside"></i>
        <input type="text" id="ajax-search" class="form-control" placeholder="Search critical products..." autocomplete="off" value="<?= esc($search ?? '') ?>">
        <button type="button" id="clear-search" class="clear-search-btn" style="display: none;">
            <i class="fas fa-times-circle"></i>
        </button>
    </div>

    <div class="text-end">
        <a href="<?= base_url('reports/export-pdf') ?>" target="_blank" class="btn btn-danger btn-report-action shadow-sm">
            <i class="fas fa-file-pdf me-2"></i> Export to PDF
        </a>
    </div>
</div>

<div id="table-content">
    <div class="table-prodeo-container shadow-sm bg-white rounded-3">
        <table class="table table-prodeo mb-0">
            <thead>
                <tr>
                    <th style="width: 30%;">PRODUCT</th>
                    <th style="width: 25%;">CATEGORY</th>
                    <th class="text-center" style="width: 15%;">MIN. STOCK</th>
                    <th class="text-center" style="width: 15%;">CURRENT STOCK</th>
                    <th style="width: 15%;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $p): ?>
                        <tr>
                            <td class="fw-bold"><?= esc($p['name']) ?></td>
                            <td><?= esc($p['category_name']) ?></td>
                            <td class="text-center"><?= $p['min_stock'] ?></td>
                            <td class="text-center">
                                <span class="badge bg-danger fs-6"><?= $p['quantity'] ?></span>
                            </td>
                            <td>
                                <span class="text-danger fw-bold">
                                    <i class="fas fa-arrow-down me-1"></i> REPLENISH
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-success fw-bold">
                            <i class="fas fa-check-circle me-2 fa-2x d-block mb-2"></i>
                            No products match the criteria.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if (!empty($products)): ?>
            <div class="mt-4 d-flex justify-content-center pagination-wrapper pb-3">
                <?= $pager->links('default', 'bootstrap_full') ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/reports.js') ?>"></script>

<?= $this->endSection() ?>