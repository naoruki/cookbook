
<form method="POST"  id="resetpassword">
    <div class="alert alert-danger display-error" style="display: none"></div>
        <div class="mb-3">
            <input type="hidden" name="userID" id="userID"  placeholder="userID"  value="<?php echo $userIDsession ?> ">
            <label for="exampleInputPassword1" class="form-label">Current Password</label>
            <input type="password" class="form-control" name = "oldPassword" id="oldPassword">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="newPassword" id="newPassword">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword">
         </div>
</form>
<button name="submit" type="submit" class="btn btn-primary" onclick="changePassword()" >Submit</button>