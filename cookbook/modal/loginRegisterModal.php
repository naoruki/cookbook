<body>
    <div class="modal fade" id="loginRegisterModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header model-header-border">
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
                </div>
                <div class="modal-body">
                    <nav>
                        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-login" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Login</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-register" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Register</button>
                        </div>
                    </nav>  
                        <!-- Login form -->
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                            <div class="alert alert-danger display-error" style="display: none"></div>
                            <?php include './login.php'; ?>
                        </div>
                            <!-- Register form -->
                        <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                            <div class="alert alert-danger register-error" style="display: none"></div>
                            <div class="alert alert-success register-success" style="display: none"></div>
                            <div class="alert alert-info register-exist" style="display: none"></div>
                            <?php include './register.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>