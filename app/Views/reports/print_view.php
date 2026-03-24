<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Critical Stock Report - Prodeo Hotel</title>
    <style>
        :root {
            --prodeo-blue: #003087;
            --prodeo-yellow: #f9d611;
            --text-dark: #333;
            --border-color: #dee2e6;
        }

        body {
            font-family: 'Segoe UI', Helvetica, Arial, sans-serif;
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }

        .no-print-actions {
            background: #f4f4f4;
            padding: 15px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .report-header-container {
            background-color: var(--prodeo-blue);
            color: white;
            padding: 30px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 5px solid var(--prodeo-yellow);
        }

        .report-logo {
            max-height: 75px;
            width: auto;
        }

        .report-meta-data {
            text-align: right;
        }

        .report-meta-data h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            font-weight: 800;
            color: var(--prodeo-yellow);
        }

        .report-meta-data .timestamp {
            color: white;
            font-size: 14px;
            margin-top: 5px;
            font-weight: 600;
        }

        .report-body {
            padding: 40px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background-color: #f8f9fa;
            color: var(--prodeo-blue);
            text-align: left;
            padding: 18px 12px;
            font-size: 13px;
            text-transform: uppercase;
            border-bottom: 3px solid var(--prodeo-blue);
        }

        .data-table td {
            padding: 18px 12px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        .data-table tr {
            page-break-inside: avoid;
        }

        .data-table tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        .status-critical {
            color: #d9534f;
            font-weight: bold;
            background: #fdf2f2;
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #facccc;
        }

        .report-footer {
            margin-top: 40px;
            font-size: 11px;
            color: #777;
            text-align: center;
            border-top: 1px solid var(--border-color);
            padding-top: 15px;
        }

        .action-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-main {
            background: var(--prodeo-blue);
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        @media print {
            .no-print-actions {
                display: none !important;
            }

            .report-header-container {
                background-color: var(--prodeo-blue) !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                border-bottom: 5px solid var(--prodeo-yellow) !important;
            }

            .report-header-container h1 {
                color: var(--prodeo-yellow) !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .data-table th {
                background-color: #f8f9fa !important;
                color: var(--prodeo-blue) !important;
                border-bottom: 3px solid var(--prodeo-blue) !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .status-critical {
                background-color: #fdf2f2 !important;
                border: 1px solid #facccc !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

    <div class="no-print-actions">
        <button onclick="window.print()" class="action-btn btn-main">Print / Save as PDF</button>
        <a href="<?= base_url('reports/critical') ?>" class="action-btn btn-secondary">Back to System</a>
        <small>(Note: Enable "Background graphics" in print settings)</small>
    </div>

    <div class="report-header-container">
        <div class="logo-wrapper">
            <img src="<?= base_url('assets/img/prodeoHotel_logo.png') ?>" alt="Prodeo Hotel Logo" class="report-logo">
        </div>
        <div class="report-meta-data">
            <h1>CRITICAL STOCK REPORT</h1>
            <div class="timestamp">Date: <?= date('m/d/Y') ?></div>
            <div class="timestamp">Time: <?= date('H:i') ?></div>
        </div>
    </div>

    <div class="report-body">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th style="text-align: center;">Min. Stock</th>
                    <th style="text-align: center;">Current Stock</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td style="font-weight: bold;"><?= esc($p['name']) ?></td>
                        <td><?= esc($p['category_name']) ?></td>
                        <td style="text-align: center;"><?= $p['min_stock'] ?></td>
                        <td style="text-align: center;">
                            <span class="status-critical"><?= $p['quantity'] ?></span>
                        </td>
                        <td style="color: #d9534f; font-size: 12px; font-weight: bold;">⚠️ REPLENISH</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="report-footer">
            This is an official document generated by StockMaster Prodeo System.
            &copy; <?= date('Y') ?> Prodeo Hotel + Lounge.
        </div>
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>

</html>