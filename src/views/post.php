<div class="create_post">
    <form class="postform" action="?url=post" method="post">
        <h2>Create Post</h2>
        <?php echo $msgcharacters; echo $err; ?>
        <input type="hidden" name="p" value="<?php echo $p; ?>">
        <textarea name="post" rows="6" cols="30" placeholder="Write your post here..."><?php echo $text; ?></textarea><br>
        <input type="submit" name="submit" value="Post">
    </form>
</div>