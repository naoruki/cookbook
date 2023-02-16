<?php
include "lib/config.php"; 
include "lib/functions.php";
include "lib/db.class.php";
include "lib/validation.php";

$errorMSG = "";
$oldPassword=$newPassword=$confirmPassword=$hashPassword="";

if (empty($_POST["oldPassword"])) {
    $errorMSG .= "<li>Current password is required</li>";
} 
else{
   $oldPassword = filterInput($_POST["oldPassword"]);
}

if (empty($_POST["newPassword"])) {
    $errorMSG .= "<li>Password is required</<li>";
} 
else if (!isValidPassword($_POST["newPassword"])){
    $errorMSG .= "<li>Password doesnt meet the requirement</<li>";
}
else {
    $newPassword = filterInput($_POST["newPassword"]);
}
if (empty($_POST["confirmPassword"])) {
    $errorMSG .= "<li>Double confirm password</<li>";
} 
else if (!isValidPassword($_POST["confirmPassword"])){
    $errorMSG .= "<li>Password doesnt meet the requirement</<li>";
}
else {
   $confirmPassword = filterInput($_POST["confirmPassword"]);
}


if($newPassword!=$confirmPassword){
    $errorMSG .= "<li>Both password doesnt match</<li>";
}else{
    $hashPassword=password_hash($confirmPassword, PASSWORD_DEFAULT);
}

 $userID = $_POST["userID"];

if(empty($errorMSG)){
    $getUserQuery = DB::query("SELECT * FROM users WHERE userID=%s",$userID);
    $userExist = DB::count();
    if($userExist){
        $msg ="Password change ".$userID;
         foreach($getUserQuery as $userResult){
                $userID = $userResult["userID"];
                $userEmail = $userResult["email"];
                $userPassword = $userResult['password'];
                $userName = $userResult['name'];
            }
        if(password_verify($oldPassword,$userPassword)){
            DB::startTransaction();
            DB::update("users", [
                    'name' => $userName,
                    'email' => $userEmail,
                    'password' => $hashPassword,
                ],  "userID = %i", $userID);
                $isSuccess = DB::affectedRows();
                if($isSuccess){
                    DB::commit();
                    $msg =  "Successfully updated ";
                    echo json_encode(['code'=>200, 'msg'=>$msg]);
                    exit; 
                } else {
                    DB::rollback();
                    $msg =  "Rollback failed"; 
                    echo json_encode(['code'=>100, 'msg'=>$msg]);
                    exit;
                    }  


        }
        else{
            $msg ="Wrong password ".$userID;
            echo json_encode(['code'=>300, 'msg'=>$msg]);
            exit;
        } 
    }   
}

echo json_encode(['code'=>404, 'msg'=>$errorMSG]);
?>