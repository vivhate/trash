<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /login/login.php');
    exit;
}
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /login/login.php'); // Redirect to login page
    exit();
}
require_once '../db.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_product'])) {
        $category_id = $_POST['category'];
        $product_name = $_POST['product'];
        $query = "INSERT INTO products (category_id, name) VALUES ('$category_id', '$product_name')";
        $conn->query($query);
    } elseif (isset($_POST['edit_product'])) {
        $product_id = $_POST['product_id'];
        $category_id = $_POST['category'];
        $product_name = $_POST['product'];
        $query = "UPDATE products SET category_id = '$category_id', name = '$product_name' WHERE id = '$product_id'";
        $conn->query($query);
    } elseif (isset($_POST['delete_product'])) {
        $product_id = $_POST['product_id'];
        $query = "DELETE FROM products WHERE id = '$product_id'";
        $conn->query($query);
    } elseif (isset($_POST['add_discount'])) {
        $discount_type = $_POST['discount_type'];
        $discount_amount = $_POST['discount_amount'];
        $query = "INSERT INTO discounts (type, amount) VALUES ('$discount_type', '$discount_amount')";
        $conn->query($query);
    } elseif (isset($_POST['edit_discount'])) {
        $discount_id = $_POST['discount_id'];
        $discount_type = $_POST['discount_type'];
        $discount_amount = $_POST['discount_amount'];
        $query = "UPDATE discounts SET type = '$discount_type', amount = '$discount_amount' WHERE id = '$discount_id'";
        $conn->query($query);
    } elseif (isset($_POST['delete_discount'])) {
        $discount_id = $_POST['discount_id'];
        $query = "DELETE FROM discounts WHERE id = '$discount_id'";
        $conn->query($query);
    } elseif (isset($_POST['add_users'])) {
        $users_name = $_POST['users_name'];
        $users_email = $_POST['users_email'];
        $users_role = $_POST['users_role'];
        $users_login = $_POST['users_login'];
        $users_password = password_hash($_POST['users_password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO users (name, email, role, login, password) VALUES ('$users_name', '$users_email', '$users_role', '$users_login', '$users_password')";
        $conn->query($query);
    } elseif (isset($_POST['edit_users'])) {
        $users_id = $_POST['users_id'];
        $users_role = $_POST['users_role'];
        $query = "UPDATE users SET role = '$users_role' WHERE id = '$users_id'";
        $conn->query($query);
    } elseif (isset($_POST['delete_users'])) {
        $users_id = $_POST['users_id'];
        $query = "DELETE FROM users WHERE id = '$users_id'";
        $conn->query($query);
    } elseif (isset($_POST['add_category'])) {
        $category_name = $_POST['category_name'];
        $query = "INSERT INTO categories (name) VALUES ('$category_name')";
        $conn->query($query);
    } elseif (isset($_POST['edit_category'])) {
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $query = "UPDATE categories SET name = '$category_name' WHERE id = '$category_id'";
        $conn->query($query);
    } elseif (isset($_POST['delete_category'])) {
        $category_id = $_POST['category_id'];
        $query = "DELETE FROM categories WHERE id = '$category_id'";
        $conn->query($query);
    } elseif (isset($_POST['add_news'])) {
        $news_title = $_POST['news_title'];
        $news_content = $_POST['news_content'];
        $query = "INSERT INTO news (title, content) VALUES ('$news_title', '$news_content')";
        $conn->query($query);
    } elseif (isset($_POST['edit_news'])) {
        $news_id = $_POST['news_id'];
        $news_title = $_POST['news_title'];
        $news_content = $_POST['news_content'];
        $query = "UPDATE news SET title = '$news_title', content = '$news_content' WHERE id = '$news_id'";
        $conn->query($query);
    } elseif (isset($_POST['delete_news'])) {
        $news_id = $_POST['news_id'];
        $query = "DELETE FROM news WHERE id = '$news_id'";
        $conn->query($query);
    }
}

// Retrieve data from database
$categories_query = "SELECT * FROM categories";
$products_query = "SELECT * FROM products";
$discounts_query = "SELECT * FROM discounts";
$users_query = "SELECT * FROM users";
$news_query = "SELECT * FROM news";

$categories_result = $conn->query($categories_query);
$categories_result2 = $conn->query($categories_query);
$products_result = $conn->query($products_query);
$discounts_result = $conn->query($discounts_query);
$users_result = $conn->query($users_query);
$news_result = $conn->query($news_query);

// Close connection
$conn->close();
?>

<!-- HTML Code -->
<!DOCTYPE html>
<html>

<head>
    <title>Админ-панель</title>
    <style>
        label {
            display: block;
            margin-bottom: 10px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <h1>Админ-панель</h1>

    <!-- Categories Section -->
    <section id="categories">
        <h2>Категории</h2>
        <form method="post">
            <label>
                <span>Category Name</span>
                <input type="text" name="category_name" />
            </label>
            <button type="submit" name="add_category">Добавить категорию</button>
        </form>
        <ul id="categories-list">
            <?php
            while ($category = $categories_result->fetch_assoc()) {
                echo "<li>" . $category['name'] . " <form method='post'><input type='hidden' name='category_id' value='" . $category['id'] . "'><button type='submit' name='delete_category'>Удалить</button></form></li>";
            }
            ?>
        </ul>
    </section>

    <!-- Catalog Section -->
    <section id="catalog">
        <h2>Каталог</h2>
        <form method="post">
            <label>
                <span>Категория</span>
                <select name="category">
                    <option value="">Выбрать категорию</option>
                    <?php
                    while ($category = $categories_result2->fetch_assoc()) {
                        echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                    }
                    ?>
                </select>
            </label>
            <label>
                <span>Продукт</span>
                <input type="text" name="product" />
            </label>
            <button type="submit" name="add_product">Сохранить</button>
        </form>
        <ul id="catalog-list">
            <?php
            while ($product = $products_result->fetch_assoc()) {
                echo "<li>" . $product['name'] . " <form method='post'><input type='hidden' name='product_id' value='" . $product['id'] . "'><button type='submit' name='delete_product'>Удалить</button></form></li>";
            }
            ?>
        </ul>
    </section>

    <!-- Discounts Section -->
    <section id="discounts">
        <h2>Скидки</h2>
        <form method="post">
            <label>
                <span>Тип скидки</span>
                <select name="discount_type">
                    <option value="">Выберите тип скидки</option>
                    <option value="client">Клиент</option>
                    <option value="users">Сотрудник</option>
                </select>
            </label>
            <label>
                <span>Скидка</span>
                <input type="number" name="discount_amount" />
            </label>
            <button type="submit" name="add_discount">Добавить скидку</button>
        </form>
        <ul id="discounts-list">
            <?php
            while ($discount = $discounts_result->fetch_assoc()) {
                echo "<li>" . $discount['type'] . " - " . $discount['amount'] . " <form method='post'><input type='hidden' name='discount_id' value='" . $discount['id'] . "'><button type='submit' name='delete_discount'>Удалить</button></form></li>";
            }
            ?>
        </ul>
    </section>

    <!-- News Section -->
    <section id="news">
        <h2>Новости</h2>
        <form method="post">
            <label>
                <span>Заголовок</span>
                <input type="text" name="news_title" />
            </label>
            <label>
                <span>Контент</span>
                <textarea name="news_content"></textarea>
            </label>
            <button type="submit" name="add_news">Добавить новость</button>
        </form>
        <ul id="news-list">
            <?php
            while ($news = $news_result->fetch_assoc()) {
                echo "<li>" . $news['title'] . " <form method='post'><input type='hidden' name='news_id' value='" . $news['id'] . "'><button type='submit' name='delete_news'>Удалить</button></form></li>";
            }
            ?>
        </ul>
    </section>

    <!-- Staff Section -->
    <?php
    if ($_SESSION['role'] == 'admin') {
        // Display the staff section
    ?>
        <!-- Staff Section -->
        <section id="users">
            <h2>Пользователи</h2>
            <form method="post">
                <label>
                    <span>Имя</span>
                    <input type="text" name="users_name" />
                </label>
                <label>
                    <span>Почта</span>
                    <input type="email" name="users_email" />
                </label>
                <label>
                    <span>Роль</span>
                    <select name="users_role">
                        <option value="">Выберите роль</option>
                        <option value="admin">Admin</option>
                        <option value="moderator">Moderator</option>
                        <option value="client">Client</option>
                    </select>
                </label>
                <label>
                    <span>Логин</span>
                    <input type="text" name="users_login" />
                </label>
                <label>
                    <span>Пароль</span>
                    <input type="password" name="users_password" />
                </label>
                <button type="submit" name="add_users">Добавить пользователя</button>
            </form>
            <ul id="users-list">
                <?php
                while ($users = $users_result->fetch_assoc()) {
                    echo "<li>" . $users['name'] . " - " . $users['email'] . " - " . $users['role'] . " 
            <form method='post'>
                <input type='hidden' name='users_id' value='" . $users['id'] . "'>
                <select name='users_role'>
                    <option value='admin' " . ($users['role'] == 'admin' ? 'selected' : '') . ">Admin</option>
                    <option value='moderator' " . ($users['role'] == 'moderator' ? 'selected' : '') . ">Moderator</option>
                    <option value='client' " . ($users['role'] == 'client' ? 'selected' : '') . ">Client</option>
                </select>
                <button type='submit' name='edit_users'>Редактировать</button>
                <button type='submit' name='delete_users'>Удалить</button>
            </form>
            </li>";
                }
                ?>
            </ul>
        </section>
    <?php
    } else {
        // Display a message or redirect to another page if the user is not an admin
        echo "You do not have permission to access this page.";
    }
    ?>
    <a href="?logout">Выход</a>
</body>

</html>