
<div class="col-md-12 col-lg-12  nav-padding "> 
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img width="200" class="" src="images/logo-new.png" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="<?php echo SITE_ROOT; ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Recipe
                        </a>
                        <ul class="dropdown-menu">
                        <form name="recipe" action="recipe.php" method="post">
                        <?php 
                            $results = DB::query("SELECT categoryID, categoryName FROM category");
                            foreach ($results as $row) {
                                echo '<li><input name="category" class="dropdown-item" type="submit" value="' .$row['categoryName']. '" /></li>';
                            }
                        ?>
                        </form>
                        </ul>
                    </li>
                     <?php if ($nameSession !="" && $roleSession == 0){ ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Members
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_ROOT; ?>profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_ROOT; ?>listOfRecipe.php">My Recipe</a></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_ROOT; ?>addRecipe.php">Share Recipe</a></li>
                        </ul>
                    </li>
                    <?php }?>
                    <?php if ($nameSession !="" && $roleSession == 1){ ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin Panel
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">Member List</a></li>
                                <li><a class="dropdown-item" href="">Recipe List</a></li>
                            </ul>
                        </li>
                    <?php }?>
                    <?php if ($nameSession ==""){ ?>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="modal" href="#loginRegisterModal" role="button">Register/Login</a>
                            </li>
                    <?php }?>
                    <?php if ($nameSession !=""){ ?>
                    <li class="nav-item">
                        <!-- logout trigger  -->
                        <a class="nav-link" href="#" onclick ="logout('<?php echo SITE_ROOT; ?>logout.php')" role="button">Logout</a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </nav>
</div>