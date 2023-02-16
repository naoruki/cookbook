 <form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="name" class="form-control" name = "registerName" id="name" aria-describedby="nameHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" name= "registerEmail" id="registerEmail" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="registerPassword" id="registerPassword">
    </div>
    <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input"  name="agree" id="agree" value="agree" <?php if(isset($_POST['agree'])){if($_POST['agree']=="agree"){echo 'checked';}} ?> >
        <label class="form-check-label" for="exampleCheck1" >Terms & Conditions</label>
    </div>
</form>
<button class="btn btn-primary register" onclick="registerForm()" >Register</button>