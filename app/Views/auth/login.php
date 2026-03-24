<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">

<div class="login-card">
    <div class="login-header">
        <img src="<?= base_url('assets/img/prodeoHotel_logo.png') ?>" alt="Prodeo Hotel Logo">
        <h4>StockMaster Access</h4>
    </div>

    <div class="login-body">
        <form action="<?= base_url('auth/check') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email Address</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-light border-end-0 text-prodeo"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control border-start-0" placeholder="admin@prodeohotel.com" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-light border-end-0 text-prodeo"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control border-start-0" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Log In
            </button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>