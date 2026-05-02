<?php
require_once '../../vendor/autoload.php';
require_once '../../connection.php';
require_once '../../src/supply.php';

$supply = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['supplyId'];
    $supply = Supply::find($id);
    
    if ($supply) {
        $supply->name = $_POST['name'];
        $supply->quantity = $_POST['quantity'];
        $supply->unitCost = $_POST['unitCost'];
        $supply->orderDate = $_POST['orderDate'];
        $supply->expirationDate = $_POST['expirationDate'];
        $supply->status = $_POST['status'];
        
        $supply->save();
    }
    
    header("Location: ../../index.php");
    exit();
}

if (isset($_GET['id'])) {
    $supply = Supply::find($_GET['id']);
}

$orderDateFormatted = date('Y-m-d\TH:i', strtotime($supply->orderDate));
$expirationDateFormatted = date('Y-m-d\TH:i', strtotime($supply->expirationDate));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Supply</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/update.css">
</head>

<body>
    <header class="container mt-3">
        <nav>
            <ul class="nav nav-pills nav-fill mb-4">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Update Supply</a>
                </li>
            </ul>
        </nav>
        <h1>Update Existing Supply</h1>
    </header>

    <main class="container">
        <div class="form-container shadow-sm">
            <form action="update.php" method="POST" class="row g-3">
                <div class="col-md-6">
                    <label for="supplyId" class="form-label">Supply ID</label>
                    <input type="text" class="form-control" id="supplyId" name="supplyId" value="<?= $supply->supplyId ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $supply->name ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="<?= $supply->quantity ?>" min="0" required>
                </div>
                <div class="col-md-4">
                    <label for="unitCost" class="form-label">Unit Cost ($)</label>
                    <input type="number" step="0.01" class="form-control" id="unitCost" name="unitCost" value="<?= $supply->unitCost ?>" min="0" required>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="Current" <?= $supply->status === 'Current' ? 'selected' : '' ?>>Current</option>
                        <option value="NearExpiration" <?= $supply->status === 'NearExpiration' ? 'selected' : '' ?>>Near Expiration</option>
                        <option value="Expired" <?= $supply->status === 'Expired' ? 'selected' : '' ?>>Expired</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="orderDate" class="form-label">Order Date</label>
                    <input type="datetime-local" class="form-control" id="orderDate" name="orderDate" value="<?= $orderDateFormatted ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="expirationDate" class="form-label">Expiration Date</label>
                    <input type="datetime-local" class="form-control" id="expirationDate" name="expirationDate" value="<?= $expirationDateFormatted ?>" required>
                </div>
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-update px-5">Update Supply</button>
                    <a href="../../index.php" class="btn btn-secondary px-5">Cancel</a>
                </div>
            </form>
        </div>
    </main>

    <footer class="mt-5 text-center">
        <p>Made by Andrés Cárdenas</p>
    </footer>

    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>