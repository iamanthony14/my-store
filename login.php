<?php
require_once('storeclass.php');
$store->login();
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
    <form action="" method="post">
    <div class="container">
        <div class="form-container">
            <div class="forminput">
                <label for="">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="forminput">
                <label for="">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <button type="submit" name="submit">Submit</button>
        </div>
    </div>
    </form>
</body>
</html>