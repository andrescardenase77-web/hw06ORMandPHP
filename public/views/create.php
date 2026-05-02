<?php
require_once '../../vendor/autoload.php';
require_once '../../connection.php';
require_once '../../src/supply.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $supply = new Supply();
    
    $supply->supplyId = $_POST['supplyId']; 
    
    $supply->name = $_POST['name'];
    $supply->quantity = $_POST['quantity'];
    $supply->unitCost = $_POST['unitCost'];
    $supply->orderDate = $_POST['orderDate'];
    $supply->expirationDate = $_POST['expirationDate'];
    $supply->status = $_POST['status'];
    
    $supply->save();
    
    header("Location: ../../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supply</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/create.css">
</head>

<body>
    <header class="container mt-3">
        <nav>
            <ul class="nav nav-pills nav-fill mb-4">
                <li class="nav-item">
                    <a class="nav-link" href="../../index.php">View Supplies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./create.php">Add Supply</a>
                </li>
            </ul>
        </nav>
        <h1>Add New Supply</h1>
    </header>

    <main class="container">
        <div class="form-container shadow-sm">
            <form action="create.php" method="POST" class="row g-3">
                <div class="col-md-6">
                    <label for="supplyId" class="form-label">Supply ID</label>
                    <input type="text" class="form-control" id="supplyId" name="supplyId" placeholder="s-001" required>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="0" required>
                </div>
                <div class="col-md-4">
                    <label for="unitCost" class="form-label">Unit Cost ($)</label>
                    <input type="number" step="0.01" class="form-control" id="unitCost" name="unitCost" min="0" required>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="Current" selected>Current</option>
                        <option value="NearExpiration">Near Expiration</option>
                        <option value="Expired">Expired</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="orderDate" class="form-label">Order Date</label>
                    <input type="datetime-local" class="form-control" id="orderDate" name="orderDate" required>
                </div>
                <div class="col-md-6">
                    <label for="expirationDate" class="form-label">Expiration Date</label>
                    <input type="datetime-local" class="form-control" id="expirationDate" name="expirationDate" required>
                </div>
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-submit px-5">Save Supply</button>
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