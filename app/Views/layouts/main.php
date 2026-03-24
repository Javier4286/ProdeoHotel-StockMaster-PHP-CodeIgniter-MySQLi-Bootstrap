<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodeo Hotel - StockMaster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/all.min.css">
    <style>
        :root {
            --prodeo-blue: #003087;
            --prodeo-yellow: #f9d611;
            --prodeo-light-bg: #f8f9fa;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--prodeo-light-bg);
            color: #333;
        }

        .navbar {
            background-color: var(--prodeo-blue) !important;
            border-bottom: 5px solid var(--prodeo-yellow);
            padding: 1rem 0;
        }

        .navbar-brand img {
            height: 60px;
            width: auto;
        }

        .nav-link {
            color: white !important;
            font-weight: 600;
            margin: 0 15px;
            font-size: 1.1rem;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--prodeo-yellow) !important;
        }

        .btn-prodeo {
            background-color: var(--prodeo-yellow);
            color: var(--prodeo-blue);
            font-weight: bold;
            border-radius: 8px;
            padding: 10px 25px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-prodeo:hover {
            background-color: #e5c40f;
            transform: translateY(-2px);
        }

        main.container-scaled {
            transform: scale(0.85);
            transform-origin: top center;
            padding-top: 30px;
        }

        .table-prodeo-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .table-prodeo {
            width: 100%;
            border-collapse: collapse;
        }

        .table-prodeo thead th {
            background-color: var(--prodeo-blue) !important;
            color: var(--prodeo-yellow) !important;
            padding: 18px;
            text-transform: uppercase;
            font-size: 0.85rem;
            text-align: center !important;
            border: none !important;
            font-weight: 700;
        }

        .table-prodeo tbody td {
            padding: 18px;
            vertical-align: middle;
            text-align: center !important;
            border-bottom: 1px solid #f0f0f0;
            background-color: white;
        }

        .table-prodeo tbody tr:hover td {
            background-color: #f2f2f2 !important;
        }

        .prodeo-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .prodeo-card-header {
            background-color: var(--prodeo-blue);
            color: var(--prodeo-yellow);
            padding: 20px;
            text-align: center;
            font-weight: 700;
            font-size: 1.3rem;
            text-transform: uppercase;
        }

        .text-prodeo {
            color: var(--prodeo-blue);
        }

        .btn-save {
            background-color: var(--prodeo-yellow) !important;
            color: var(--prodeo-blue) !important;
            border: none !important;
            font-weight: 700 !important;
        }

        .btn-cancel-custom {
            background-color: #f2f2f2 !important;
            color: #666 !important;
            border: none !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/img/prodeoHotel_logo.png') ?>" alt="Logo">
                <span class="text-white ms-3 fw-bold fs-3">StockMaster</span>
            </a>

            <?php if (session()->get('isLoggedIn')): ?>
                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item"><a class="nav-link <?= (url_is('categories*')) ? 'active' : '' ?>" href="<?= base_url('categories') ?>">Categories</a></li>
                        <li class="nav-item"><a class="nav-link <?= (url_is('products*')) ? 'active' : '' ?>" href="<?= base_url('products') ?>">Products</a></li>
                        <li class="nav-item"><a class="nav-link <?= (url_is('transactions*')) ? 'active' : '' ?>" href="<?= base_url('transactions') ?>">Transactions</a></li>

                        <?php if (session()->get('is_admin')): ?>
                            <li class="nav-item"><a class="nav-link <?= (url_is('users*')) ? 'active' : '' ?>" href="<?= base_url('users') ?>">Users</a></li>
                            <li class="nav-item"><a class="nav-link <?= (url_is('reports*')) ? 'active' : '' ?>" href="<?= base_url('reports/critical') ?>">Reports</a></li>
                        <?php endif; ?>

                        <li class="nav-item">
                            <a class="btn btn-prodeo ms-lg-3" href="<?= base_url('logout') ?>">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <main class="container-scaled">
        <div class="container py-4">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show mx-auto shadow-sm" role="alert" style="max-width: fit-content; min-width: 500px; text-align: center; border-radius: 10px;">
                    <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mx-auto shadow-sm" role="alert" style="max-width: fit-content; min-width: 500px; text-align: center; border-radius: 10px;">
                    <i class="fas fa-exclamation-triangle me-2"></i> <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <footer class="text-center py-4">
        <p class="text-muted small">© 2026 Prodeo Hotel + Lounge | Inventory Management System</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>