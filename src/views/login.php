<?php 

$err = "";

if (isset($_GET['err'])) {
    if ($_GET['err'] == "invalid_credentials") { $err = "<p class='err'>Invalid Credentials</p>"; }
}

?>

<div class="login auth-form">
    <h2>Login</h2>
    <?php echo $msgcharacters; echo $err; ?>
    <form action="?url=login" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" name="submit" value="Login">
    </form>
</div>