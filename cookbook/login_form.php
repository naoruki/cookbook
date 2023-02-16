<?php
include "lib/config.php"; 
include "lib/functions.php";
include "lib/db.class.php";
include "lib/validation.php";

$errorMSG = "";
$email=$password=$userEmail="";
$email = ($_POST["email"]);
$password = ($_POST["password"]);

if (empty($_POST["email"])) {
    $errorMSG .= "<li>Email is required</li>";
} else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errorMSG .= "<li>Invalid email format</li>";
}else {
    $email = $_POST["email"];
}
if (empty($_POST["password"])) {
    $errorMSG .= "<li>password is required</<li>";
} else {
    $password = $_POST["password"];
}

if(empty($errorMSG)){
    $getUserQuery = DB::query("SELECT * FROM users WHERE email=%s", $email);
    $userExist = DB::count();
     if($userExist){
        $msg =  "Login Successfully"; 
        foreach($getUserQuery as $userResult){
                $userID = $userResult["userID"];
                $userEmail = $userResult["email"];
                $userPassword = $userResult['password'];
                $userName = $userResult['name'];
                $role=$userResult['role'];
            }
            if(password_verify($password,$userPassword)){
                session_start(); 
                $_SESSION['name'] = $userName;
                $_SESSION['userID'] = $userID;
                $_SESSION['role'] = $role;
                 $msg =  $userName;
                echo json_encode(['code'=>200, 'msg'=>$msg]);
	            exit;
            }
            else{
                $msg =  "Wrong password"; 
                echo json_encode(['code'=>100, 'msg'=>$msg]);
                exit;
                }
            
        }else{
                $msg =  "User not found"; 
                echo json_encode(['code'=>300, 'msg'=>$msg]);
                exit;
            }
        
}
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

?>