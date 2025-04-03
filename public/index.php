<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Anonimous Forum</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href='style.css?v=<?php echo time(); ?>'>
    <!-- <link rel="stylesheet" href='style.css'> -->
</head>
<body>
    
    <?php 

        // includes and db
        include '../config.php'
        include '../src/model.php';
        $conn = conn();

        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // args manager - page, p
        if (isset($_GET['p'])) { 
            $p = clearurl($_GET['p']); 
        } else {
            $p = 0;
        }

        if (isset($_GET['page'])) { 
            $page = clearurl($_GET['page']); 
        } else { 
            $page = $default_page; 
        }

        // args manager - p, q, text
        if (isset($_GET['posts_page'])) { $posts_page = clearurl($_GET['posts_page']); } else { $posts_page = 1; }
        if (isset($_GET['p'])) { $p = clearurl($_GET['p']); } else { $p = 0; }
        if (isset($_GET['q'])) { $q = cleartext($_GET['q']); } else { $q = ''; }
        if (isset($_GET['text'])) { $text = cleartext($_GET['text']); } else { $text = ''; }

        // to view the user (only development)
        // echo "<p>You are logged as " . get_user_name() . "</p>";
        // echo "<p>Your user id is " . get_user_id() . "</p>";
        // echo "<p>Url: $folder/$page.php</p>";

        $pages_login = array('post', 'change_password');
        $url_login = array('post', 'change_password', 'logout');

        // header
        include 'theme/header.php';

        // comprove login page
        if (in_array($page, $pages_login)) {
            if (!is_logged_in()) {
                $page = 'login';
            }
        }

        // comprove exist page
        if (!file_exists("$folder/$page.php")) {
            $page = 'page_404';
            $folder = "theme";
        }

        // include page
        include "$folder/$page.php";
    
    ?>

</body>
</html>