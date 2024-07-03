<?php
session_start();

if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    require_once '../db.php';

    // Check if the user exists
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['role'] = $user_data['role'];

        // Redirect to the dashboard based on the user's role
        if ($user_data['role'] === 'client') {
            header('Location: /dashboard/');
        } elseif ($user_data['role'] === 'employee') {
            header('Location: /dashboard/');
        } elseif ($user_data['role'] === 'admin') {
            header('Location: /dashboard/');
        }
    } else {
        echo '<p class="text-red-600">Invalid username or password.</p>';
    }
}
