<?php
include "lib/config.php"; 
include "lib/functions.php";
include "lib/db.class.php";
include "lib/validation.php";

$errorMSG = "";
$name=$email=$password=$confirmPassword=$agree="";
if (empty($_POST["name"])) {
    $errorMSG .= "<li>Name is required</<li>";
} else {
    $name = filterInput($_POST["name"]);
}

if (empty($_POST["registerEmail"])) {
    $errorMSG .= "<li>Email is required</li>";
} else if(!filter_var($_POST["registerEmail"], FILTER_VALIDATE_EMAIL)) {
    $errorMSG .= "<li>Invalid email format</li>";
}else {
    $email = filterInput($_POST["registerEmail"]);
}
if (empty($_POST["registerPassword"])) {
    $errorMSG .= "<li>password is required</<li>";
} else if(!isValidPassword($_POST["registerPassword"])){
    $errorMSG .= "<li>Password doesnt meet the requirement</<li>";
}else {
    $password = filterInput($_POST["registerPassword"]);
}
if (empty($_POST["confirmPassword"])) {
    $errorMSG .= "<li>Confirm password is required</<li>";
} else {
    $confirmPassword = filterInput($_POST["confirmPassword"]);
}

if($password!==$confirmPassword) {
    $errorMSG .= "<li>Both password doesnt match</<li>";
}

if(isset($_POST["agree"])){
    $agree = $_POST['agree'];
}
if (empty($_POST["agree"])) {
    $errorMSG .= "<li>Please agree to the terms and condtion</<li>";
}
 else {
        $agree=$_POST["agree"];
}

if(empty($errorMSG)){
    
    $getUserQuery = DB::query("SELECT * FROM users WHERE email=%s", $email);
    $userExist = DB::count();
    if($userExist){
        $msg ="User already exists";
         echo json_encode(['code'=>100, 'msg'=>$msg]);
         exit;
    }else{
        $msg =  "Succesfully Registered!  ";
        DB::startTransaction(); 
        DB::insert('users', [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 0,
        ]);
        $success = DB::affectedRows();
        if($success){
            echo json_encode(['code'=>200, 'msg'=>$msg]);
            DB::commit();
            exit;
        } else {
            DB::rollback();
        } 
    }         
}

echo json_encode(['code'=>404, 'msg'=>$errorMSG]);


?>
