<?php
require_once '../../vendor/autoload.php';
require_once '../../connection.php';
require_once '../../src/supply.php';

$supply = null;
$id = $_GET['id'] ?? null;

if ($id) {
    $supply = Supply::find($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $supplyToDelete = Supply::find($_POST['supplyId']);
    if ($supplyToDelete) {
        $supplyToDelete->delete();
    }
    header("Location: ../../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Supply</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/delete.css">
</head>

<body>
    <header class="container mt-3">
        <nav>
            <ul class="nav nav-pills nav-fill mb-4">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Delete Supply</a>
                </li>
            </ul>
        </nav>
        <h1>Delete Supply Record</h1>
    </header>

    <main class="container">
        <div class="delete-container shadow-sm border-danger">
            <div class="warning-icon text-center mb-4">
                <span class="display-1 text-danger">⚠️</span>
            </div>
            <h3 class="text-center mb-4">Are you sure you want to delete this record?</h3>
            
            <div class="record-details p-3 mb-4 bg-light rounded">
                <p><strong>Supply ID:</strong> <?= $supply->supplyId ?></p>
                <p><strong>Name:</strong> <?= $supply->name ?></p>
                <p><strong>Quantity:</strong> <?= $supply->quantity ?></p>
                <p><strong>Status:</strong> <?= $supply->status ?></p>
            </div>

            <form action="delete.php" method="POST" class="text-center">
                <input type="hidden" name="supplyId" value="<?= $supply->supplyId ?>">
                <button type="submit" name="confirm_delete" class="btn btn-delete px-5 me-2">Yes, Delete Forever</button>
                <a href="../../index.php" class="btn btn-secondary px-5">Cancel</a>
            </form>
        </div>
    </main>

    <footer class="mt-5 text-center">
        <p>Made by Andrés Cárdenas</p>
    </footer>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>