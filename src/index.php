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
                <a href="login/login.php" bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                    Войти
                </a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto p-4 pt-6">
        <!-- News Section -->
        <section class="mb-6">
            <h2 class="text-2xl font-bold mb-2">Новости</h2>
            <ul>
                <li class="mb-4">
                    <h3 class="text-lg font-bold mb-1">Новость 1</h3>
                    <p>Краткое описание новости 1</p>
                </li>
                <li class="mb-4">
                    <h3 class="text-lg font-bold mb-1">Новость 2</h3>
                    <p>Краткое описание новости 2</p>
                </li>
            </ul>
        </section>

        <!-- Catalog Section -->
        <section class="mb-6">
            <h2 class="text-2xl font-bold mb-2">Каталог</h2>
            <ul>
                <li class="mb-4">
                    <h3 class="text-lg font-bold mb-1">Категория 1</h3>
                    <ul>
                        <li>Продукт 1</li>
                        <li>Продукт 2</li>
                    </ul>
                </li>
                <li class="mb4">
                    <h3 class="text-lg font-bold mb-1">Категория 2</h3>
                    <ul>
                        <li>Продукт 3</li>
                        <li>Продукт 4</li>
                    </ul>
                </li>
            </ul>
        </section>

        <!-- Discount System Section -->
        <section class="mb-6">
            <h2 class="text-2xl font-bold mb-2">Скидки для постоянных покупателей</h2>
            <p>Описание системы скидок</p>
            <table class="w-full">
                <thead>
                    <tr>
                        <th>Категория</th>
                        <th>Скидка</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Постоянные покупатели</td>
                        <td>5%</td>
                    </tr>
                    <tr>
                        <td>Персонал компании</td>
                        <td>10%</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 py-4">
        <p class="text-center text-gray-600">© 2024 Company Name</p>
    </footer>
</body>

</html>