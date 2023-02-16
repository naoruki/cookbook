<?php include "templates/header.php"; ?>
<body>
    <div class="container">
        <div class="row">
            <?php include "templates/nav.php"; ?>
        </div>
        <div class="row">
            <table id="recipeCategoryTable" class="display">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Ingredients</th>
                        <th>Category</th>
                        <?php if ($nameSession !=""){ ?>
                        <th>Favourite</th>
                        <?php } ?>

                    </tr>
                </thead>
                <tbody>
                <?php 
                //Query recipe based on their Category
                if (isset($_POST['category'])){
                        $categoryID= "";
                        $categoryName = $_POST['category'];
                        $resultsCategory = DB::query("SELECT categoryID FROM category WHERE categoryName = '$categoryName'");
                        foreach($resultsCategory as $row){
                            $categoryID=$row['categoryID'];
                        }
                        $results = DB::query("SELECT recipe.recipeID,recipe.recipeName,recipe.recipeImage,recipe.ingredients,recipe.categoryID,category.categoryName
                        FROM recipe 
                        INNER JOIN category on recipe.categoryID = category.categoryID 
                        WHERE recipe.categoryID = '$categoryID'");
                        foreach($results as $row){ ?>
                        <tr id=<?php echo $row['recipeID'] ?> >
                            <td width="30px"><img src="images/upload/<?php echo  $row['recipeImage'] ?>" class="img-thumbnail" alt=""></td>
                            <td><?php echo $row['recipeName']?></td>
                            <td><?php echo $row['ingredients']?></td>
                            <td><?php echo $row['categoryName']?></td>
                            <?php if ($nameSession !=""){ ?>
                            <input type="hidden" name="recipeID<?php echo $row['recipeID']?>" id="recipeID<?php echo $row['recipeID']?>"  placeholder="recipeID"  value="<?php echo $row['recipeID']?> ">
                            <input type="hidden" name="userID<?php echo $row['recipeID']?>" id="userID<?php echo $row['recipeID']?>"  placeholder="userID"  value="<?php echo  $userIDsession ?> ">
                            <?php 
                                $getFavQuery = DB::query("SELECT * FROM favouriteRecipe WHERE userID=%s AND recipeID=%i", $userIDsession ,$row['recipeID']);
                                $favExist = DB::count();
                                if( $favExist ){
                            ?>
                                <td class="fav<?php echo $row['recipeID']?>">
                                    <a class="btn btn-link <?php echo $row['recipeID']?>" onclick=removeFavourite(<?php echo $row['recipeID']?>) role="button">
                                        <i class="fa-solid fa-heart unfav-icon<?php echo $row['recipeID'] ?>"></i>
                                    </a>
                                </td>
                            <?php } else { ?>
                            <td class="fav<?php echo $row['recipeID']?>">
                                <a class="btn btn-link <?php echo $row['recipeID']?>" onclick=addFavourite(<?php echo $row['recipeID']?>) role="button">
                                    <i class="fa-regular fa-heart fav-icon<?php echo $row['recipeID'] ?>"></i>
                                </a>
                            </td>
                            <?php }} ?>
                        </tr>
                        <?php } ?>
              <?php  } ?>

                </tbody>
            </table>
            
        </div>
    </div>  
</body>
<!-- Modal -->
<?php include "modal/loginRegisterModal.php" ?>
<?php include "templates/footer.php"; ?>