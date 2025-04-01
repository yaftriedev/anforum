<?php 

if (!isset($path_test)) { die("Access denied"); }

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // clear and hash
    $username = cleartext($username);
    $password = hash_md5($password);

    // login
    $sql = "SELECT * FROM users WHERE username = '$username' AND password_enc = '$password'";
    $result = $conn->query($sql);

    // session
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ?");
    } else {
        header("Location: ?page=login&err=invalid_credentials");
    }

    exit();
} 
else {
    header("Location: ?page=login&err=err");
    exit();
}