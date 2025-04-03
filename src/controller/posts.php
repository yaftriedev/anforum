<?php

if (!isset($path_test)) { die("Access denied"); }

// include ads
include 'ads.php';

// get posts
$posts = getposts(conn(), $p, $q, $post_per_page, $posts_page);

// parent id
if ($p == 0) {
    echo '<h2 class="headerposts">Main Posts</h2>';
} else {
    if (!existid(conn(), $p)) {
        echo "<div class='header404 box-normal'><h2>Error 404, Post not found.</h2></div>";;
        die();
    }

    // header post
    $headerpost = getpost(conn(), $p);
    echo '<h3 class="return-posts"> <a href="?page=posts&p=' . $headerpost['parentid'] . '">Back to previous post</a> </h3>';
    echo '<h2 class="headerposts">' . htmlspecialchars($headerpost['post']) . '</h2>';

}

// div posts
echo "<div class='container'> <div class='posts'> <ul>";

// posts
foreach ($posts as $row) {
    $user = get_user_name_by_id($conn, $row['id_user']);
    $post = htmlspecialchars($row['post']);
    $id = htmlspecialchars($row['id']);
    $total_replys = count_posts_by_id($conn, $id, $q);

    $response_text = "<a href='?page=posts&p=$id'>Responses: $total_replys </a>";

    if ($total_replys == 0) { $response_text = "<p>There are not any responses.</p>"; }

    if ($p == 0) {
        echo "<li class='post'>
                <b>$user</b> - $post
                <div class='responses'>$response_text <a class='response' href='?page=post&p=$id'>Response</a> </div>
            </li>";
    }

    else {
        echo "<li class='post'> 
                <div class='post-header'> <span class='post-user'><b>$user</b></span> </div>
                <div class='post-content'> <p>$post</p> </div>
                <div class='responses'>$response_text <a class='response' href='?page=post&p=$id'>Response</a> </div>
            </li>";
    }
}

// posts_page manager
$total_pages = ceil(count_posts_by_id(conn(), $p, $q) / $post_per_page);

if ($total_pages != 1) {
    echo "<div class='pagination'>";

    // Previous page link
    if ($posts_page > 1) {
        $prev_page = $posts_page - 1;
        echo "<a href='?page=posts&p=$p&posts_page=$prev_page' class='pagination-link'>Previous</a>";
    } else {
        echo "<p class='not_are'>Previous</p>";
    }
    
    // Quick access page links
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $posts_page) { $esp_class = "class='actual_page'"; } else { $esp_class = ''; }
        $active_class = ($i == $posts_page) ? 'active' : '';
        echo "<a $esp_class href='?page=posts&p=$p&posts_page=$i' class='pagination-link $active_class'>$i</a>";
    }
    
    // Next page link
    if (count($posts) == $post_per_page) {
        $next_page = $posts_page + 1;
        echo "<a href='?page=posts&p=$p&posts_page=$next_page' class='pagination-link'>Next</a>";
    } else {
        echo "<p class='not_are'>Next</p>";
    }
    
    echo "</div>";
}

// end posts
echo '</ul> </div>';

// create banner ads
echo "<div class='bannerads'>";
echo "<h2>Banner Ads</h2>";
echo "<ul>";

foreach ($ads as $banner) {

    $title = htmlspecialchars($banner['Title']);
    $link = htmlspecialchars($banner['Link']);
    $description = htmlspecialchars($banner['Description']);

    echo "<li class='banner-item'><p><a href='$link' target='_blank'>$title</a>: $description</p></li>";
}

echo "</ul> </div> </div>";

