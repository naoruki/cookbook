<?php
include "lib/config.php"; 
include "lib/functions.php";
include "lib/db.class.php";
include "lib/validation.php";

$recipeID = ($_POST["recipeID"]);
$userID = ($_POST["userID"]);

$msg =  "Successfully Removed ";

$getFavQuery = DB::query("SELECT * FROM favouriteRecipe WHERE userID=%s AND recipeID=%i", $userID,$recipeID);
$favExist = DB::count();
if($favExist){
    DB::query("DELETE FROM favouriteRecipe WHERE userID=%s AND recipeID=%i" ,$userID,$recipeID);
    $success = DB::affectedRows();
    if($success){
            echo json_encode(['code'=>200, 'msg'=>$msg]);
            DB::commit();
            exit;
        } else {
            DB::rollback();
            exit;
        } 
}else{
    echo json_encode(['code'=>100, 'msg'=>$msg]);
    exit;

}
?>