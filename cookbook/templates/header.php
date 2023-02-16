<?php 
include "lib/config.php"; 
include "lib/functions.php";
include "lib/db.class.php";
include "lib/validation.php";
include "lib/alerts.php";

    session_start();
    $nameSession ="";
    $userIDsession ="";
    $roleSession="";            
    if(isset($_SESSION['name']) || isset($_SESSION['userID'])) {   
    $nameSession = $_SESSION['name']; 
    $userIDsession= $_SESSION['userID']; 
    $roleSession= $_SESSION['role']; 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo SITE_TITLE; ?></title>
    <link rel="stylesheet" href="<?php echo SITE_ROOT; ?>assets/css/myStyle.css">
    <!--datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!--SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>