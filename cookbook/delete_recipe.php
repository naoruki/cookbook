<?php
include "lib/config.php"; 
include "lib/functions.php";
include "lib/db.class.php";
include "lib/validation.php";

$recipeID = ($_POST["recipeID"]);
$userID = ($_POST["userID"]);



$msg =  "Deleted Recipe ";

$getFavQuery = DB::query("SELECT * FROM favouriteRecipe WHERE recipeID=%i",$recipeID);
$favExist = DB::count();

if($favExist){
    DB::query("DELETE FROM favouriteRecipe WHERE recipeID=%i" ,$recipeID);
}
    $getRecipeQuery = DB::query("SELECT * FROM recipe WHERE recipeID=%i",$recipeID);
    $recipeExist = DB::count();
    if($recipeExist){
    DB::query("DELETE FROM recipe WHERE recipeID=%i" ,$recipeID);
 
    $successRecipe = DB::affectedRows();
    
    if($successRecipe){    
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