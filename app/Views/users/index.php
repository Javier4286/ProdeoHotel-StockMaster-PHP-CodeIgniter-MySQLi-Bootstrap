<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/tables.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/users-list.css') ?>">

<div class="header-container">
    <div>
        <h2 class="text-prodeo fw-bold mb-0">Staff Management</h2>
        <p class="text-muted small mb-0">Manage hotel employees and permissions</p>
    </div>

    <a href="<?= base_url('users/create') ?>" class="btn-prodeo-fixed">
        <i class="fas fa-plus me-1"></i> Add Employee
    </a>
</div>

<div id="table-content">
    <?php if (!empty($users)): ?>
        <div class="table-prodeo-container shadow-sm">
            <table class="table table-prodeo mb-0">
                <thead>
                    <tr>
                        <th class="text-start ps-4">NAME</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th>STATUS</th>
                        <th style="width: 250px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr id="user-row-<?= $u['id'] ?>">
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark"><?= esc($u['first_name'] . ' ' . $u['last_name']) ?></div>
                            </td>
                            <td class="text-muted small"><?= esc($u['email']) ?></td>
                            <td>
                                <span class="badge <?= $u['is_admin'] ? 'bg-primary' : 'bg-info text-white' ?> px-3">
                                    <?= $u['is_admin'] ? 'ADMIN' : 'STAFF' ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($u['deleted_at'] == null): ?>
                                    <span class="badge bg-success-subtle text-success border px-3">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger border px-3">Deactivated</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <?php if ($u['deleted_at'] == null): ?>
                                        <a href="<?= base_url('users/edit/' . $u['id']) ?>" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <?php if ($u['id'] != session()->get('user_id')): ?>
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                onclick="deleteUser(<?= $u['id'] ?>, '<?= esc($u['first_name']) ?>')">
                                                <i class="fas fa-user-slash"></i> Deactivate
                                            </button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-outline-success btn-sm"
                                            onclick="restoreUser(<?= $u['id'] ?>, '<?= esc($u['first_name']) ?>')">
                                            <i class="fas fa-undo"></i> Reactivate
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="text-center py-5 bg-white shadow-sm rounded-4">
            <i class="fas fa-users text-muted mb-3" style="font-size: 3rem; opacity: 0.1;"></i>
            <p class="text-muted fs-5">No employees registered yet.</p>
        </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const USERS_URLS = {
        delete: '<?= base_url('users/delete') ?>',
        restore: '<?= base_url('users/restore') ?>',
        csrf_header: '<?= csrf_header() ?>',
        csrf_hash: '<?= csrf_hash() ?>'
    };
</script>
<script src="<?= base_url('assets/js/users-list.js') ?>"></script>

<?= $this->endSection() ?>