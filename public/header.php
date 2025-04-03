<div class="header">
    <div class="logo">
        <a href="?"><h1>The Anonimous Forum</h1></a>
        <a href="?page=posts">Posts</a>
    </div>
    <div class="search">
        <form action="index.php" method="get">
            <input type="hidden" name="p" value="<?php echo $p; ?>">
            <input type="text" name="q" placeholder="Search...">
            <input type="submit" value="Search">
        </form>

<?php

if (is_logged_in()) {
    echo '<a href="?page=post&p=' . $p . '" class="btnheader">Post</a>';
    echo '<a href="?page=change_password" class="btnheader">Change Password</a>';
    echo '<a href="?url=logout" class="btnheader">Logout</a>';
} else {
    echo '<a href="?page=register" class="btnheader">Register</a>';
    echo '<a href="?page=login" class="btnheader">Login</a>';
}

?>

    </div>
</div>