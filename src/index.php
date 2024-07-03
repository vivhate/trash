<?php
// Configuration
require_once './db.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from tables
$categories_query = "SELECT * FROM categories";
$categories_result = $conn->query($categories_query);

$products_query = "SELECT * FROM products";
$products_result = $conn->query($products_query);

$discounts_query = "SELECT * FROM discounts";
$discounts_result = $conn->query($discounts_query);

$staff_query = "SELECT * FROM staff";
$staff_result = $conn->query($staff_query);

$users_query = "SELECT * FROM users";
$users_result = $conn->query($users_query);

// Display data
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100 h-screen">
    <!-- Header -->
    <header class="bg-white shadow-md py-4">
        <nav class="container mx-auto p-4 flex justify-between">
            <ul class="flex items-center">
                <li class="mr-6">
                    <a href="#" class="text-gray-600 hover:text-gray-900">Новости</a>
                </li>
                <li class="mr-6">
                    <a href="#" class="text-gray-600 hover:text-gray-900">Личный кабинет</a>
                </li>
                <li class="mr-6">
                    <a href="#" class="text-gray-600 hover:text-gray-900">Каталог</a>
                </li>
            </ul>
            <div class="flex items-center">
                <a href="login/login.php" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                    Войти
                </a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto p-4 pt-6">
        <!-- Categories Section -->
        <section class="mb-6">
            <h2 class="text-2xl font-bold mb-2">Категории</h2>
            <ul>
                <?php while ($category = $categories_result->fetch_assoc()) { ?>
                    <li class="mb-4">
                        <h3 class="text-lg font-bold mb-1"><?= $category['name'] ?></h3>
                    </li>
                <?php } ?>
            </ul>
        </section>

        <!-- Products Section -->
        <!-- Categories and Products Section -->
        <section class="mb-6">
            <h2 class="text-2xl font-bold mb-2">Каталог</h2>
            <ul>
                <?php
                $categories_query = "SELECT * FROM categories";
                $categories_result = $conn->query($categories_query);
                while ($category = $categories_result->fetch_assoc()) {
                ?>
                    <li class=" ml-4">
                        <h3 class="text-lg font-bold mb-1"><?= $category['name'] ?></h3>
                        <ul">
                            <?php
                            $products_query = "SELECT * FROM products WHERE category_id = " . $category['id'];
                            $products_result = $conn->query($products_query);
                            while ($product = $products_result->fetch_assoc()) {
                            ?>
                    <li class="ml-8">
                        <p><?= $product['name'] ?></p>
                    </li>
                <?php } ?>
            </ul>
            </li>
        <?php } ?>
        </ul>
        </section>


        <!-- Discounts Section -->
        <section class="mb-6">
            <h2 class="text-2xl font-bold mb-2">Скидки</h2>
            <ul>
                <?php while ($discount = $discounts_result->fetch_assoc()) { ?>
                    <li class="mb-4">
                        <h3 class="text-lg font-bold mb-1"><?= $discount['type'] ?> - <?= $discount['amount'] ?>%</h3>
                    </li>
                <?php } ?>
            </ul>
        </section>

        <!-- Staff Section -->
        <section class="mb-6">
            <h2 class="text-2xl font-bold mb-2">Сотрудники</h2>
            <ul>
                <?php while ($staff_member = $staff_result->fetch_assoc()) { ?>
                    <li class="mb-4">
                        <h3 class="text-lg font-bold mb-1"><?= $staff_member['name'] ?> (<?= $staff_member['email'] ?>)</h3>
                    </li>
                <?php } ?>
            </ul>
        </section>

        <!-- Users Section -->
        <section class="mb-6">
            <h2 class="text-2xl font-bold mb-2">Пользователи</h2>
            <ul>
                <?php while ($user = $users_result->fetch_assoc()) { ?>
                    <li class="mb-4">
                        <h3 class="text-lg font-bold mb-1"><?= $user['username'] ?> (<?= $user['email'] ?>)</h3>
                    </li>
                <?php } ?>
            </ul>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 py-4">
        <p class="text-center text-gray-600">© 2024 Company Name</p>
    </footer>
</body>

</html>

<?php
// Close connection
$conn->close();
?>