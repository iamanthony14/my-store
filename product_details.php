<?php
require_once("storeclass.php");
$id = $_GET['id'];
$product = $store->get_single_product($id);
$stocks = $store->view_all_stocks($id);
$userdetails = $store->get_userdata();

if(isset($userdetails)){
    if($userdetails['access']!= "administrator"){
        header("Location: login.php");
    }
}
else{
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1><?= $product['product_name'] ?></h1>
    <h2>Category : <?= $product['product_type'] ?></h2>
    <h3>Min. Stock : <?= $product['min_stock'] ?></h3>
    <br>
    <h4>Total : <?= $product['total']; ?></h4>
    <hr>
    <h2>Available Product Items</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Action</th>
                <th>Base Stock Qty</th>
                <th>SRP</th>
                <th>Sales Qty</th>
                <th>Total Sales</th>
                <th>Qty Remaining</th>
                <th>Statuss</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($stocks as $stock){ ?>
                <?php $sum = $stock['qty'] - $stock['sale_qty']; ?>
                <tr>
                    <td>
                        <div id="parent_<?= $stock['ID']; ?>">
                            <label><?= $stock['vendor']." ".$stock['qty']; ?></label>
                            <input type="number" name="qty[]" min="1" max="<?=$stock['qty'];?>" value="1">
                            <input type="hidden" name="price[]" value="<?= $stock['price']; ?>">
                            <input type="hidden" name="stock_id[]" value="<?= $stock['ID'];?>">
                            <button type="button" class="add_cart">Add To Cart</button>
                            <button type="button" class="remove_cart" disabled id="<?= $stock['ID']; ?>">Remove</button>
                        </div>
                    </td>
                    <td><?= $stock['qty']; ?></td>
                    <td><?= sprintf('%01.2f', $stock['price']); ?></td>
                    <td><?= $stock['sale_qty'] ?></td>
                    <td><?= sprintf('%01.2f', $stock['total_sales']); ?></td>
                    <td><?= $sum; ?></td>
                    <td><?= ($sum == 0)? 'Out of stock' : 'Available'; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    
    <a href="products.php">Products</a>
    <a href="addnewstocks.php?id=<?= $id; ?>">Add New Stock</a>

    <hr>
    <h2>Cart</h2>
        <form action="checkout.php" method="post" id="check_out_form">
            <input type="hidden" name="customer_name" value="<?= $userdetails['fullname']; ?>">
            <input type="hidden" name="product_id" value="<?= $product['ID']; ?>">
            <button type="submit" id="checkoutbtn">Proceed to check out</button>

        </form>
    
    <script src="js/index.js"></script>
</body>
</html>