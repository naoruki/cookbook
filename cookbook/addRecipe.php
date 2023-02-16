<?php include "templates/header.php"; ?>
<body>
     <div class="container">
        <div class="row">
            <?php include "templates/nav.php"; 
                $name=$ingredient=$category=$location="";
                $errorName=$errorCategory=$errorFileExist=$errorIngredient=$errorEmptyFile="";
                $uploadOk = 1;
                // Add Recipe validation
                if(isset($_POST["submit"])){ 
                    $name = filterInput($_POST['name']);
                    $ingredient = filterInput($_POST['ingredient']);
                    $category = filterInput($_POST['category']);
                    $nameImg = $_FILES['imgUpload']['name'];  
                    $temp_name = $_FILES['imgUpload']['tmp_name'];
                    if(isBlankField($name)||$category==0||isBlankField($ingredient)||isBlankField($nameImg)){
                        if($category==0){
                            $errorCategory = "Please select";
                            $uploadOk = 0;
                        }
                        if(isBlankField($name)){
                            $errorName = "Please enter a name";
                            $uploadOk = 0;
                        }
                        if(isBlankField($ingredient)){
                            $errorIngredient = "Please enter an ingredient";
                            $uploadOk = 0;
                        }
                        if(isBlankField($nameImg)){
                            $errorEmptyFile = "Please insert an image";
                            $uploadOk = 0;
                        }
                    }else{
                        if(!isBlankField($nameImg)){
                            $location="images/upload/";
                            if(file_exists($location.$nameImg))
                            {
                               $errorFileExist="File existed";
                               $uploadOk = 0;
                            }
                            else{
                                 move_uploaded_file($temp_name,$location.$nameImg);
                                 $uploadOk = 1;
                            }
                        }       
                    }
                    if($uploadOk!=0){
                        DB::startTransaction(); 
                        DB::insert('recipe', [
                            'recipeName' => $name,
                            'recipeImage' => $nameImg,
                            'ingredients' => $ingredient,
                            'userID' => $userIDsession,
                            'categoryID'=>$category,
                        ]);
                        $success = DB::affectedRows();
                        if($success){
                            DB::commit();
                            sweetAlertRedirect("success", "success", "Recipe have been Successfully added", 5000, SITE_ROOT);
                        } else {
                            DB::rollback();
                        } 
                        
                    }
                }
            ?>
        </div>
        <div class="row header-title"><h1>Share recipe</h1></div>
        <div class="row recipe-box">
            <!-- recipe form  -->
            <form method="POST"  id="registerForm" class="align-middle" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Recipe Name</label>
                    <input type="name" class="form-control" name = "name" id="name" placeholder="name" value="<?php echo $name ?>" aria-describedby="nameHelp">
                    <div class="error-msg"><?php echo $errorName ?></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Ingredients</label>
                    <input type="text" class="form-control" name= "ingredient" id="ingredient" placeholder="ingredient"  value="<?php echo $ingredient ?>" aria-describedby="emailHelp">
                    <div class="error-msg"><?php echo $errorIngredient ?></div>
                </div>
                <div class="mb-3">
                     <label for="exampleInputEmail1" class="form-label">Category</label>
                     <div class="error-msg"><?php echo $errorCategory ?></div>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="category">
                        <option value="0">-------------</option>
                        <!-- for loop to load category from db -->
                        <?php 
                            $results = DB::query("SELECT categoryID, categoryName FROM category");
                            $selected = FieldValue('category', $category);
                            foreach ($results as $row) {
                                $selectedText = $row['categoryID'] == $selected ? 'selected' : '';
                                echo'<option value="'.$row['categoryID'].'"'  . $selectedText . '>'.$row['categoryName']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" name= "imgUpload" id="imgUpload">
                    <div class="error-msg"><?php echo $errorEmptyFile ?></div>
                    <div class="error-msg"><?php echo $errorFileExist ?></div>
                </div>
                <button name="submit" class="btn btn-primary submit" data-dismiss="modal">Submit</button>
            </form>
        </div>
    </div>  

<!--footer-->
<?php include "templates/footer.php"; ?>
</body>

