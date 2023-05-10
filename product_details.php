<?php
require_once("storeclass.php");
$id = $_GET['id'];
$product = $store->get_single_product($id);
$stocks = $store->view_all_stocks($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?= $product['product_name'] ?></h1>
    <h2><?= $product['product_type'] ?></h2>
    <h3><?= $product['min_stock'] ?></h3>
    <br>
    <h4>Total : <?= $product['total']; ?></h4>
    <hr>
    <?php foreach($stocks as $stock){ ?>
    <p><?= $stock['vendor']." ".$stock['qty']; ?></p>
    <?php } ?>
    <a href="products.php">Products</a>
    <a href="addnewstocks.php?id=<?= $id; ?>">Add New Stock</a>
</body>
</html>