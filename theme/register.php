<?php 

if (!isset($path_test)) { die("Access denied"); }

$err = "";

if (isset($_GET['err'])) {
    if ($_GET['err'] == "nick_register") { $err = "<p class='err'>Username not allowed. It's already register</p>"; }
    if ($_GET['err'] == "pdm") { $err = "<p class='err'>Passwords don't match</p>"; }
}

?>

<div class="register auth-form">
    <h2>Register</h2>
    <?php echo $msgcharacters; echo $err; ?>
    <form action="?url=register" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="cpassword">Confirm Password:</label>
        <input type="password" id="cpassword" name="cpassword" required>
        <input type="submit" name="submit" value="Register">
    </form>
</div>