<?php

// db conection
function conn() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "anforum";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        return false;
    }

    return $conn;
    
}

// Clear and Hash Funtions
function cleartext($text) { 
    return preg_replace('/[^a-zA-Z0-9!?.,:\/$%()@ ]/', '', $text);
}

function clearurl($text) {
    return preg_replace('/[^a-zA-Z0-9]_/', '', $text);
}

function comprove($text) {
    return $text == cleartext($text);
}

function hash_md5($text) {
    return md5($text);
}

// Get Posts Functions
function getposts($conn, $p, $q, $post_per_page, $posts_page) {
    $posts_page = max(1, intval($posts_page)); // Ensure $posts_page is at least 1
    $offset = ($posts_page - 1) * $post_per_page;

    $p = intval($p);
    $sql = "SELECT * FROM posts WHERE parentid = $p";

    if ($q != '') { $sql .= " AND post LIKE '%$q%'"; };

    $sql .= " LIMIT $offset, $post_per_page";

    $result = $conn->query($sql);
    $posts = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
    }
    return $posts;
}

function getpost($conn, $id) {
    $sql = "SELECT * FROM posts WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return false;
}

function existid($conn, $id) {
    $sql = "SELECT id FROM posts WHERE id = $id";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

function count_posts_by_id($conn, $id, $q) {
    $sql = "SELECT COUNT(*) as total FROM posts WHERE parentid = $id AND post LIKE '%$q%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return (int) $result->fetch_assoc()['total'];
    }
    return 0;
}

// Users Funtions
function get_user_id() {
    if (isset($_SESSION['user_id'])) {
        return $_SESSION['user_id'];
    }
    return null;
}

function get_user_name($conn) {
    $id = get_user_id();
    if ($id == null) { return null; }
    $sql = "SELECT username FROM users WHERE id = $id";
    $result = conn()->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['username'];
    }
    return null;
}

function get_user_name_by_id($conn, $id) {
    $sql = "SELECT username FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc()['username'];
    }
    return null;
}

function is_logged_in() {
    if (session_status() == PHP_SESSION_NONE) { session_start(); }
    return isset($_SESSION['user_id']);
}

function login_test($conn, $username, $password) {
    $password = hash_md5($password);
    $sql = "SELECT * FROM users WHERE username = '$username' AND password_enc = '$password'";
    $result = conn()->query($sql);
    return $result->num_rows > 0;
}

// Other

function err_redirect($page, $err) {
    header("Location: ?page=$page&err=$err");
    exit();
}