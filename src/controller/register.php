<?php 

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // get username
    $sql = "SELECT username FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    // err manager
    if ($password != $cpassword) { err_redirect("register", "pdm"); }
    if ($result->num_rows > 0) { err_redirect("register", "nick_register"); }

    // clear and hash
    $username = cleartext($username);
    $password = hash_md5($password);
    
    // register
    $sql = "INSERT INTO users (username, password_enc) VALUES ('$username', '$password')";
    $result = $conn->query($sql) === TRUE;

    if($result) {
        header("Location: ?page=login");
    } else {
        header("Location: ?page=register&err=err");
    }

    exit();
} 
else {
    
    $err = "";

    if (isset($_GET['err'])) {
        if ($_GET['err'] == "nick_register") { $err = "<p class='err'>Username not allowed. It's already register</p>"; }
        if ($_GET['err'] == "pdm") { $err = "<p class='err'>Passwords don't match</p>"; }
    }

    include '../src/views/register.php';

}