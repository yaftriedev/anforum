<?php 

if (!isset($path_test)) { die("Access denied"); }

if (isset($_POST['submit'])) {

    $p = $_POST['p'];
    $post = $_POST['post'];

    // err manager
    if (!isset($_SESSION['user_id'])) { err_redirect("post", "no_register"); }
    if (!isset($post)) { err_redirect("post", "no_post_exist"); }
    if (strlen($post) == 0) { err_redirect("post", "post_blank"); }
    if (strlen($post) > 255 & $p = 0) { err_redirect("post", "up255main"); }

    // clear
    $post = cleartext($post);

    // post
    $sql = "INSERT INTO posts (parentid, post, id_user) VALUES ('$p', '$post', '" . get_user_id() . "')";
    $result = $conn->query($sql);

    if($result) {
        header("Location: ?page=posts&p=$p");
    } else {
        header("Location: ?page=create_post_page&p=$p&text=$post&err=err");
    }
    exit();

} 
else {
    header("Location: ?page=create_post_page&p=$p&text=$post&err=err");
    exit();
}