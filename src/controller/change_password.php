<?php 

if (isset($_POST['submit'])) {

    $oldpassword = $_POST['oldpassword'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // clear and hash
    $oldpassword = hash_md5($oldpassword);
    $password = hash_md5($password);
    $cpassword = hash_md5($cpassword);

    // err manager
    if (!login_test(conn(), get_user_name(), $oldpassword)) { err_redirect("change_password", "oldpassword_invalid"); }
    if ($password != $cpassword) { err_redirect("post", "pdm"); }

    // change password
    $id = get_user_id();
    $sql = "UPDATE users SET password_enc = '$password' WHERE id = $id";
    $result = $conn->query($sql);

    if ($result) {
        header("Location: ?");
    } else {
        header("Location: ?page=change_password&err=err");
    }
    exit();
} 

else {
    
    $err = "";

    if (isset($_GET['err'])) {
        if ($_GET['err'] == "pdm") { $err = "<p class='err'>Passwords don't match</p>"; }
    }

    include '../src/views/change_password.php';

}