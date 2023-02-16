<?php 
include "templates/header.php"; 
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
            <!-- nav bar for profile page  -->
            <nav class="justify-content-end">
                <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profile</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Password Reset</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Favourite Recipe</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <!-- profile page -->
                    <?php include "profilePage.php"; ?>
                </div>
                <div class="tab-pane fade recipe-box" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <!-- reset password -->
                    <?php include "resetPassword.php"; ?>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                    <!-- favourite list -->
                    <?php include "favouriteList.php"; ?>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include "templates/footer.php"; ?>