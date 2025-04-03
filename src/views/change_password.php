<div class="register auth-form">
    <h2>Change Password</h2>
    <?php echo $msgcharacters; echo $err; ?>
    <form action="?url=change_password" method="post">
        <label for="oldpassword">Old Password:</label>
        <input type="password" id="oldpassword" name="oldpassword" required>
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="cpassword">Confirm New Password:</label>
        <input type="password" id="cpassword" name="cpassword" required>
        <input type="submit" name="submit" value="Change Password">
    </form>
</div>