<?php
require_once('storeclass.php');
$users = $store->getUsers();
$userdetails = $store->get_userdata();
print_r($users);

if(!isset($userdetails)){
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Store is an update</title>
</head>
<body>
    
</body>
</html>