<table id="favouriteTable" class="display">
   <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Ingredients</th>
            <th>Category</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $result = DB::query("SELECT * FROM favouriteRecipe 
        INNER JOIN users ON users.userID =favouriteRecipe.userID
        INNER JOIN recipe ON recipe.recipeID = favouriteRecipe.recipeID
        INNER JOIN category on recipe.categoryID = category.categoryID
        WHERE users.userID = %s",$userIDsession);
        foreach ($result as $row) 
        { 
    ?>
        <tr class="favList<?php echo $row['recipeID'] ?>"> 
            <td width="30px"><img src="images/upload/<?php echo  $row['recipeImage'] ?>" class="img-thumbnail" alt=""></td>
            <td><?php echo $row['recipeName']?></td>
            <td><?php echo $row['ingredients']?></td>
            <td><?php echo $row['categoryName']?></td>
            <input type="hidden" name="recipeID<?php echo $row['recipeID']?>" id="recipeID<?php echo $row['recipeID']?>"  placeholder="recipeID"  value="<?php echo $row['recipeID']?> ">
            <input type="hidden" name="userID<?php echo $row['recipeID']?>" id="userID<?php echo $row['recipeID']?>"  placeholder="userID"  value="<?php echo  $userIDsession ?> ">
            <td class="fav<?php echo $row['recipeID']?>">
                <a class="btn btn-link <?php echo $row['recipeID']?>" onclick=removeFavouriteFromList(<?php echo $row['recipeID']?>) role="button">
                    <i class="fa-solid fa-heart unfav-icon<?php echo $row['recipeID'] ?>"></i>
                </a>
            </td>
        </tr>
    <?php }?> 
    </tbody>
</table>