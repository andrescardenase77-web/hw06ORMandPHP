<?php
require_once 'vendor/autoload.php';
require_once 'connection.php';
require_once './src/supply.php';

$supplies = Supply::all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplies Data</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/index.css">
</head>

<body>
    <header class="container mt-3">
        <nav>
            <ul class="nav nav-pills nav-fill mb-4">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">View Supplies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./public/views/create.php">Add Supply</a>
                </li>
            </ul>
        </nav>
        <h1>Data from Supplies Table</h1>
    </header>

    <main class="container">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th colspan="8" class="text-center">Supplies Inventory</th>
                    </tr>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit Cost</th>
                        <th>Order Date</th>
                        <th>Expiration Date</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th> <!-- Nueva columna -->
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($supplies as $supply): ?>
                        <tr>
                            <td><?= $supply->supplyId ?></td>
                            <td><?= $supply->name ?></td>
                            <td><?= $supply->quantity ?></td>
                            <td>$<?= number_format($supply->unitCost, 2) ?></td>
                            <td><?= $supply->orderDate ?></td>
                            <td><?= $supply->expirationDate ?></td>
                            <td><?= $supply->status ?></td>
                            <td class="text-center">
                                <a href="./public/views/update.php?id=<?= $supply->supplyId ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                <a href="./public/views/delete.php?id=<?= $supply->supplyId ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="mt-5 text-center">
        <p>Made by Andrés Cárdenas</p>
    </footer>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>