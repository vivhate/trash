<?php
session_start();

if ((isset($_SESSION['role']))) {
    header('Location: /dashboard/admin_dashboard.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="h-screen bg-gray-100">
    <?php include '../header.php'; ?>
    <div class="container mx-auto p-4 pt-6 md:p-6 lg:p-12">
        <h1 class="text-3xl font-bold mb-4">Login</h1>
        <form action="/login/auth.php" method="post">
            <div class="mb-4">
                <label for="username" class="block text-sm font-bold mb-2">Username</label>
                <input type="text" id="username" name="username" class="w-full px-4 py-2 text-sm border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 text-sm border border-gray-300 rounded">
            </div>
            <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">Login</button>
        </form>
    </div>
</body>

</html>