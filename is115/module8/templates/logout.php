<?php

function logout()
{
    // Initialize the session.
    session_start();

    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
}

logout();

// Set a cookie with the flash message
setcookie('logout_message', 'You have been logged out.', time() + 3600, "/");

// Redirect to the login page
header('Location: ../public_html/login.php');
