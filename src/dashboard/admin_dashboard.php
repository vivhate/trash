<?php
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
    } elseif (isset($_POST['add_staff'])) {
        $staff_name = $_POST['staff_name'];
        $staff_email = $_POST['staff_email'];
        $staff_role = $_POST['staff_role'];
        $staff_login = $_POST['staff_login'];
        $staff_password = password_hash($_POST['staff_password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO staff (name, email, role, login, password) VALUES ('$staff_name', '$staff_email', '$staff_role', '$staff_login', '$staff_password')";
        $conn->query($query);
    } elseif (isset($_POST['edit_staff'])) {
        $staff_id = $_POST['staff_id'];
        $staff_name = $_POST['staff_name'];
        $staff_email = $_POST['staff_email'];
        $staff_role = $_POST['staff_role'];
        $staff_login = $_POST['staff_login'];
        $staff_password = password_hash($_POST['staff_password'], PASSWORD_DEFAULT);
        $query = "UPDATE staff SET name = '$staff_name', email = '$staff_email', role = '$staff_role', login = '$staff_login', password = '$staff_password' WHERE id = '$staff_id'";
        $conn->query($query);
    } elseif (isset($_POST['delete_staff'])) {
        $staff_id = $_POST['staff_id'];
        $query = "DELETE FROM staff WHERE id = '$staff_id'";
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
    }
}

// Retrieve data from database
$categories_query = "SELECT * FROM categories";
$products_query = "SELECT * FROM products";
$discounts_query = "SELECT * FROM discounts";
$staff_query = "SELECT * FROM staff";

$categories_result = $conn->query($categories_query);
$categories_result2 = $conn->query($categories_query);
$products_result = $conn->query($products_query);
$discounts_result = $conn->query($discounts_query);
$staff_result = $conn->query($staff_query);

// Close connection
$conn->close();
?>

<!-- HTML Code -->
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <style>
        /* Add some basic styling to make the form look decent */
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
    <h1>Admin Dashboard</h1>

    <!-- Categories Section -->
    <section id="categories">
        <h2>Categories</h2>
        <form method="post">
            <label>
                <span>Category Name</span>
                <input type="text" name="category_name" />
            </label>
            <button type="submit" name="add_category">Add Category</button>
        </form>
        <ul id="categories-list">
            <?php
            while ($category = $categories_result->fetch_assoc()) {
                echo "<li>" . $category['name'] . " <form method='post'><input type='hidden' name='category_id' value='" . $category['id'] . "'><button type='submit' name='edit_category'>Edit</button><button type='submit' name='delete_category'>Delete</button></form></li>";
            }
            ?>
        </ul>
    </section>

    <!-- Catalog Section -->
    <section id="catalog">
        <h2>Catalog</h2>
        <form method="post">
            <label>
                <span>Category</span>
                <select name="category">
                    <option value="">Select Category</option>
                    <?php
                    while ($category = $categories_result2->fetch_assoc()) {
                        echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                    }
                    ?>
                </select>
            </label>
            <label>
                <span>Product</span>
                <input type="text" name="product" />
            </label>
            <button type="submit" name="add_product">Add Product</button>
        </form>
        <ul id="catalog-list">
            <?php
            while ($product = $products_result->fetch_assoc()) {
                echo "<li>" . $product['name'] . " <form method='post'><input type='hidden' name='product_id' value='" . $product['id'] . "'><button type='submit' name='edit_product'>Edit</button><button type='submit' name='delete_product'>Delete</button></form></li>";
            }
            ?>
        </ul>
    </section>

    <!-- Discounts Section -->
    <section id="discounts">
        <h2>Discounts</h2>
        <form method="post">
            <label>
                <span>Discount Type</span>
                <select name="discount_type">
                    <option value="">Select Discount Type</option>
                    <option value="client">Client</option>
                    <option value="staff">Staff</option>
                </select>
            </label>
            <label>
                <span>Discount Amount</span>
                <input type="number" name="discount_amount" />
            </label>
            <button type="submit" name="add_discount">Add Discount</button>
        </form>
        <ul id="discounts-list">
            <?php
            while ($discount = $discounts_result->fetch_assoc()) {
                echo "<li>" . $discount['type'] . " - " . $discount['amount'] . " <form method='post'><input type='hidden' name='discount_id' value='" . $discount['id'] . "'><button type='submit' name='edit_discount'>Edit</button><button type='submit' name='delete_discount'>Delete</button></form></li>";
            }
            ?>
        </ul>
    </section>

    <!-- Staff Section -->
    <section id="staff">
        <h2>Staff</h2>
        <form method="post">
            <label>
                <span>Name</span>
                <input type="text" name="staff_name" />
            </label>
            <label>
                <span>Email</span>
                <input type="email" name="staff_email" />
            </label>
            <label>
                <span>Role</span>
                <select name="staff_role">
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="moderator">Moderator</option>
                    <option value="client">Client</option>
                </select>
            </label>
            <label>
                <span>Login</span>
                <input type="text" name="staff_login" />
            </label>
            <label>
                <span>Password</span>
                <input type="password" name="staff_password" />
            </label>
            <button type="submit" name="add_staff">Add Staff</button>
        </form>
        <ul id="staff-list">
            <?php
            while ($staff = $staff_result->fetch_assoc()) {
                echo "<li>" . $staff['name'] . " - " . $staff['email'] . " - " . $staff['role'] . " <form method='post'><input type='hidden' name='staff_id' value='" . $staff['id'] . "'><button type='submit' name='edit_staff'>Edit</button><button type='submit' name='delete_staff'>Delete</button></form></li>";
            }
            ?>
        </ul>
    </section>
</body>

</html>