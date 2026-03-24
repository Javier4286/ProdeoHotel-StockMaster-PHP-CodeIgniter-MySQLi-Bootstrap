<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">

<div class="prodeo-header-container p-0">
    <div>
        <h2 class="text-prodeo fw-bold mb-0">Welcome back, <?= esc($user_name) ?>!</h2>
        <p class="text-muted small mb-0">You are logged in as <span class="user-status-badge text-uppercase"><?= $is_admin ? 'Administrator' : 'Staff' ?></span></p>
    </div>
</div>

<div class="row g-3 mb-4 mt-0">
    <div class="col-md-6 col-lg-4">
        <div class="card stat-card-base shadow-sm h-100" style="border-left: 6px solid #003087 !important;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold">Total Inventory</h6>
                        <h2 class="fw-bold mb-0"><?= $total_products ?> Items</h2>
                    </div>
                    <div class="bg-light p-3 rounded-circle">
                        <i class="fas fa-boxes fa-2x" style="color: #003087;"></i>
                    </div>
                </div>
                <a href="<?= base_url('products') ?>" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card stat-card-base shadow-sm h-100" style="border-left: 6px solid #dc3545 !important;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold">Critical Stock</h6>
                        <h2 class="fw-bold mb-0 text-danger"><?= $low_stock ?> Alerts</h2>
                    </div>
                    <div class="bg-light p-3 rounded-circle">
                        <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                    </div>
                </div>
                <?php if ($is_admin): ?>
                    <a href="<?= base_url('reports/critical') ?>" class="stretched-link"></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card stat-card-base shadow-sm h-100" style="border-left: 6px solid #f9d611 !important;">
            <div class="card-body p-4">
                <h6 class="text-muted text-uppercase small fw-bold mb-3">Quick Actions</h6>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?= base_url('transactions/create') ?>" class="btn btn-quick-action btn-action-primary flex-grow-1">
                        <i class="fas fa-exchange-alt me-2"></i> New Move
                    </a>
                    <a href="<?= base_url('products') ?>" class="btn btn-quick-action btn-action-outline flex-grow-1">
                        <i class="fas fa-search me-2"></i> Stock
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-table-adjust">
    <div class="col-lg-8">
        <div class="table-prodeo-container shadow-sm h-100 bg-white rounded-3">
            <div class="prodeo-card-header d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-prodeo"><i class="fas fa-history me-2"></i> Recent Activity</h5>
                <a href="<?= base_url('transactions') ?>" class="btn btn-sm btn-view-all px-3">View All</a>
            </div>

            <?php if (!empty($recent_moves)): ?>
                <div class="table-responsive">
                    <table class="table table-prodeo-custom align-middle mb-0 text-center">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Type</th>
                                <th>Qty</th>
                                <th class="text-end pe-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_moves as $move): ?>
                                <tr>
                                    <td class="fw-bold text-dark"><?= esc($move['product_name']) ?></td>
                                    <td>
                                        <?php if ($move['movement'] == 'in'): ?>
                                            <span class="badge bg-success-subtle text-success px-3">Entry</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger-subtle text-danger px-3">Exit</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-bold"><?= $move['quantity'] ?></td>
                                    <td class="text-end pe-4 small text-muted"><?= date('M d, H:i', strtotime($move['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-activity-state">
                    <i class="fas fa-stream text-muted mb-3" style="font-size: 2.5rem; opacity: 0.3;"></i>
                    <p class="text-muted mb-0">No movements recorded in the last few days.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card sidebar-info-card shadow-sm h-100">
            <div class="card-body p-4 text-center d-flex flex-column justify-content-center">
                <div class="mb-3">
                    <i class="fas fa-shield-alt fa-3x status-text-gold"></i>
                </div>
                <h5 class="fw-bold status-text-gold mb-2">PRODEO CONTROL</h5>
                <p class="small opacity-85 mb-4 text-white">Always register exits to keep the stock updated and perfectly balanced.</p>

                <ul class="status-indicator-list text-start d-inline-block mx-auto">
                    <li class="status-indicator-item border-bottom border-white border-opacity-10">
                        <i class="fas fa-check-circle me-2"></i> System Online
                    </li>
                    <li class="status-indicator-item">
                        <i class="fas fa-database me-2"></i> Database Synced
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>