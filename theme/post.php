<?php

    if (!isset($path_test)) { die("Access denied"); }
    $err = "";

    if (isset($_GET['err'])) {
        if ($_GET['err'] == "no_register") { $err = "<p class='err'>You must be registered to post</p>"; }
        if ($_GET['err'] == "no_post_exist") { $err = "<p class='err'>No Post Exist</p>"; }
        if ($_GET['err'] == "post_blank") { $err = "<p class0'err'>Post must not be blank</p>"; }
        if ($_GET['err'] == "up255main") { $err = "<p class0'err'>Mains Posts can not up from 255 characters.</p>"; }        
    }

?>

<div class="create_post">
    <form class="postform" action="?url=post" method="post">
        <h2>Create Post</h2>
        <?php echo $msgcharacters; echo $err; ?>
        <input type="hidden" name="p" value="<?php echo $p; ?>">
        <textarea name="post" rows="6" cols="30" placeholder="Write your post here..."><?php echo $text; ?></textarea><br>
        <input type="submit" name="submit" value="Post">
    </form>
</div>