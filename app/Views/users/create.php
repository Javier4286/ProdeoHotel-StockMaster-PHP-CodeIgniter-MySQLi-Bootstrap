<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/users-create.css') ?>">

<div class="prodeo-card mx-auto" style="max-width: 800px;">
    <div class="prodeo-card-header">
        <i class="fas fa-user-plus me-2"></i> Add New Employee
    </div>
    <div class="bg-white p-5 shadow-sm" style="border-radius: 0 0 15px 15px;">

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger mb-4 border-0 shadow-sm">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= base_url('users/store') ?>" method="POST" id="userForm">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?= old('first_name') ?>" required placeholder="Enter first name">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?= old('last_name') ?>" required placeholder="Enter last name">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark">Email Address</label>
                    <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required placeholder="employee.name@prodeohotel.com">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark">Temporary Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="Min. 8 characters (letters and numbers)">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark">Phone Number</label>
                    <input type="text" name="phone" class="form-control" value="<?= old('phone') ?>" required placeholder="Country code + Area code + Number">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-dark">Home Address</label>
                    <input type="text" name="address" class="form-control" value="<?= old('address') ?>" required placeholder="Full residential address">
                </div>
                <div class="col-12">
                    <div class="form-check form-switch p-3 bg-light rounded-3 border">
                        <input class="form-check-input ms-0 me-2" type="checkbox" name="is_admin" id="isAdmin" <?= old('is_admin') ? 'checked' : '' ?> value="1">
                        <label class="form-check-label fw-bold text-prodeo" for="isAdmin">
                            Assign Administrator Privileges
                        </label>
                        <div class="form-text mt-1 text-muted">Administrators can manage users, categories, and view reports.</div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-4 mt-5">
                <a href="<?= base_url('users') ?>" class="btn-cancel-custom px-5 py-2 rounded-3 text-uppercase text-decoration-none">Cancel</a>
                <button type="submit" class="btn-save px-5 py-2 rounded-3 text-uppercase border-0">Create Account</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/users-create.js') ?>"></script>

<?= $this->endSection() ?>