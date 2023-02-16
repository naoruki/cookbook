<?php include "templates/header.php"; 
if ($nameSession ==""){ 
    jsRedirect(SITE_ROOT);
}
?>
<body>

    <div class="container">
        <div class="row">
            <?php include "templates/nav.php"; ?>
        </div>
        <div class="row">
            <table id="recipeTable" class="display">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Ingredients</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php $result = DB::query("SELECT recipe.recipeID,recipe.recipeName,recipe.recipeImage,recipe.ingredients,recipe.timestamp,recipe.categoryID,category.categoryName 
                FROM recipe 
                INNER JOIN users ON recipe.userID = users.userID 
                INNER JOIN category ON recipe.categoryID = category.categoryID 
                WHERE recipe.userID =%s",$userIDsession);
                    //display the retrieved result on the webpage  
                    foreach ($result as $row) 
                    {  ?>
                        <tr>
                            <td width="30px"><img src="images/upload/<?php echo  $row['recipeImage'] ?>" class="img-thumbnail" alt=""></td>
                            <td><?php echo $row['recipeName']?></td>
                            <td><?php echo $row['ingredients']?></td>
                            <td><?php echo $row['categoryName']?></td>
                            <td><a data-bs-toggle="modal" href="#editRecipeModal<?php echo $row['recipeID']?>" role="button"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <input type="hidden" name="recipeID<?php echo $row['recipeID']?>" id="recipeID<?php echo $row['recipeID']?>"  placeholder="recipeID"  value="<?php echo $row['recipeID']?> ">
                            <input type="hidden" name="userID<?php echo $row['recipeID']?>" id="userID<?php echo $row['recipeID']?>"  placeholder="userID"  value="<?php echo  $userIDsession ?> ">
                            <td class="fav<?php echo $row['recipeID']?>">
                                <a class="btn btn-link <?php echo $row['recipeID']?>" onclick="deleteRecipe(<?php echo $row['recipeID']?>)" role="button">
                                    <i class="fa-sharp fa-solid fa-trash trash<?php echo $row['recipeID'] ?>"></i>
                                </a>
                            </td>
                        </tr>
                        <div class="modal fade" id="editRecipeModal<?php echo $row['recipeID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $row['recipeName']?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <div class="modal-body">
                                            <form method="POST">
                                                <div class="mb-3">
                                                        <div class="alert alert-danger display-error<?php echo $row['recipeID']?>" style="display: none"></div>
                                                        <label for="name" class="form-label">Recipe Name</label>
                                                        <input type="name" class="form-control" name = "name<?php echo $row['recipeID']?>" id="name<?php echo $row['recipeID']?>" placeholder="name" value="<?php echo $row['recipeName']?>" aria-describedby="nameHelp">
                                                        <input type="hidden" name="recipeID<?php echo $row['recipeID']?>" id="recipeID<?php echo $row['recipeID']?>"  placeholder="recipeID"  value="<?php echo $row['recipeID']?> ">
                                                        <div class="error-msg"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Ingredients</label>
                                                        <input type="text" class="form-control" name= "ingredient<?php echo $row['recipeID']?>" id="ingredient<?php echo $row['recipeID']?>" placeholder="ingredient"  value="<?php echo $row['ingredients']?>" aria-describedby="emailHelp">
                                                        <div class="error-msg"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Category</label>
                                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="category" id = "category<?php echo $row['recipeID']?>">
                                                            <?php $selected = FieldValue('category', $row['categoryID']); ?>
                                                            <?php 
                                                                $results = DB::query("SELECT categoryID, categoryName FROM category");
                                                                foreach ($results as $row1) {
                                                                    $selectedText = $row1['categoryID'] == $selected ? 'selected' : '';
                                                                    echo'<option value="'.$row1['categoryID'].'"'  . $selectedText . '>'.$row1['categoryName']."</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div> 
                                            </form>                           
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="updateRecipe('<?php echo $row['recipeID']?>')"> Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
             <?php  }  ?>
                </tbody>
            </table> 
            
        </div>
    </div>
</body>
<?php include "templates/footer.php"; ?>