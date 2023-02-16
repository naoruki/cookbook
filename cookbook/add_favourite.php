<?php
include "lib/config.php"; 
include "lib/functions.php";
include "lib/db.class.php";
include "lib/validation.php";

$recipeID = ($_POST["recipeID"]);
$userID = ($_POST["userID"]);



$msg =  "Add to Favourite ";

$getFavQuery = DB::query("SELECT * FROM favouriteRecipe WHERE userID=%s AND recipeID=%i", $userID,$recipeID);
$favExist = DB::count();
if($favExist){
     $msg ="Favourite already exists";
         echo json_encode(['code'=>100, 'msg'=>$msg]);
         exit;
}else{
    DB::startTransaction(); 
    DB::insert('favouriteRecipe', [
            'userID' => $userID,
            'recipeID' => $recipeID,
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


?>