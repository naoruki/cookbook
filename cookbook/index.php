<?php include "templates/header.php"; 
?>
<body>
    <div class="container">
        <div class="row">
            <?php include "templates/nav.php"; ?>
        </div>
        <div class ="row">
            <div class="col-12">

               <p>Welcome! <?php echo $nameSession ?></p>
               
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 features">
            <div class="col">
                <div class="card">
                    <img src="images/pancake.jpeg" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="images/dumpling.jpeg" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="images/ramen.jpeg" class="card-img-top" alt="...">
                </div>
            </div>
        </div>
        <div class ="row">
            <div class="col-12">
                <h3 class="border-bottom mb-4">About us</h3>
            </div>
        </div>
        <div class="row about-us">
           <div class="col-md-12 col-lg-4">
				<img class="aboutUsImg img-fluid" src="images/pancake.jpeg">
		    </div>
            <div class="col-md-12 col-lg-8">
                This is a community to share recipe with fellow members.
            </div>
        </div>
        <div class ="row lastest-recipe">
            <div class="col-12">
                <h3 class="border-bottom mb-4">Latest Recipe</h3>
            </div>
        </div>
        <div class="row new-recipe" >
            <?php 
            $results = DB::query("SELECT recipe.recipeName,recipe.recipeImage,recipe.ingredients,recipe.timestamp,category.categoryName 
            FROM recipe 
            INNER JOIN users ON recipe.userID = users.userID 
            INNER JOIN category ON recipe.categoryID = category.categoryID ORDER BY recipe.timestamp desc LIMIT 3");?>
            <div class="card-group">
               <?php foreach ($results as $row) {?>               
                    <div class="card">
                        <img src="images/upload/<?php echo $row['recipeImage'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['recipeName'] ?></h5>
                            <p class="card-text"><?php echo $row['ingredients'] ?></p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Updated on <?php echo $row['timestamp'] ?></small>
                        </div>
                    </div>
                <?php
                    } 
                ?>
            </div>  
        </div>
    </div>
    <!-- Modal -->
    <?php include "modal/loginRegisterModal.php" ?>
    <!--footer-->
    <?php include "templates/footer.php"; ?>
</body>