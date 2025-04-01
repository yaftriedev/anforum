<?php if (!isset($path_test)) { die("Access denied"); } ?>

<div class="about box-normal">
    <h2>About</h2>
    <p>This is a simple forum where you can post anything you want. The posts are anonimous.</p>
    <p>Feel free to explore the forum and share your thoughts. Please remember to follow the community guidelines and respect others.</p>
    <p>If you have any questions or need support, don't hesitate to contact the administrators.</p>

    <h3>Community Rules</h3>
    <ul>
        <li>Be respectful to others.</li>
        <li>Keep discussions relevant to the topic.</li>
        <li>Do not share personal information.</li>
        <li>Report any inappropriate content to the administrators.</li>
    </ul>

    <h3>Ads</h3>

    <ul>
    <?php

    include 'ads.php';

    foreach ($ads as $banner) {

        $title = htmlspecialchars($banner['Title']);
        $link = htmlspecialchars($banner['Link']);
        $description = htmlspecialchars($banner['Description']);
    
        echo "<li> <p> <a href='$link' target='_blank'>$title</a>: $description </p> </li>";
    }

    ?>
    </ul>

</div>
