<?php
include "lib/config.php"; 
include "lib/functions.php";
include "lib/db.class.php";
include "lib/validation.php";

$errorMSG = "";
$name=$ingredient=$recipeID=$category="";
$recipeID = ($_POST["recipeID"]);

if (empty($_POST["name"])) {
    $errorMSG .= "<li>name is required</li>";
} else{
    $name = filterInput($_POST["name"]);
}
if (empty($_POST["ingredient"])) {
    $errorMSG .= "<li>ingredient is required</<li>";
} else {
    $ingredient = filterInput($_POST["ingredient"]);
}
 $category = $_POST["category"];

if(empty($errorMSG)){
    DB::startTransaction();
    DB::update("recipe", [
            'recipeName' => $name,
            'ingredients' => $ingredient,
            'categoryID' => $category
        ],  "recipeID = %i", $recipeID);
        $isSuccess = DB::affectedRows();
        if($isSuccess){
            DB::commit();
             $msg =  "Successfully updated recipe";
             echo json_encode(['code'=>200, 'msg'=>$msg]);
            exit; 
        } else {
            DB::rollback();
            $msg =  "Rollback failed"; 
            echo json_encode(['code'=>100, 'msg'=>$msg]);
            exit;
            }  
}
echo json_encode(['code'=>404, 'msg'=>$errorMSG]);


?>