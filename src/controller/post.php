<?php 

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
    
    $err = "";

    if (isset($_GET['err'])) {
        if ($_GET['err'] == "no_register") { $err = "<p class='err'>You must be registered to post</p>"; }
        if ($_GET['err'] == "no_post_exist") { $err = "<p class='err'>No Post Exist</p>"; }
        if ($_GET['err'] == "post_blank") { $err = "<p class0'err'>Post must not be blank</p>"; }
        if ($_GET['err'] == "up255main") { $err = "<p class0'err'>Mains Posts can not up from 255 characters.</p>"; }        
    }

    include '../src/views/post.php';

}