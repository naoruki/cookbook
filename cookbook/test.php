<?php include "templates/header.php"; ?>
<body>
    <div class="container">
        <div class="row">
            <?php include "templates/nav.php"; ?>
        </div>
        <div class="row">
           <table id="recipeTable" class="display">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Ingredients</th>
                    </tr>
                </thead>
                <tbody>
                <?php $result = DB::query("SELECT recipe.recipeName,recipe.recipeImage,recipe.ingredients,recipe.timestamp,category.categoryName 
                            FROM recipe 
                            INNER JOIN users ON recipe.userID = users.userID 
                            INNER JOIN category ON recipe.categoryID = category.categoryID ORDER BY recipe.timestamp");

                    
                    //display the retrieved result on the webpage  
                    foreach ($result as $row) {  ?>
                    <tr>
                    <td><?php echo $row['recipeName']?></td>
                    <td></td>
                    </tr>
                  <?php  }  ?>
                    
                  
                   
                </tbody>
            </table> 
        </div>

</body>
<?php include "templates/footer.php"; ?>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">...</div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">...</div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

  </div>
</div>


	Swal.fire({
		title: "Logging out",
		text: "You will be logged out",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, Logout!",
	}).then((result) => {
		if (result.isConfirmed) {
			Swal.fire("Log out!", "You have successfully logged out", "success");
			window.location = window.location.reload();
		}
	});