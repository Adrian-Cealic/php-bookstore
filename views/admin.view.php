<?php
session_start();
$user = $_SESSION['loggedInUser'] ?? [];
if ($user['role'] != 'admin') {
    header('Location: ../index.php');
    die();
}
require_once "../controllers/ProductController.php";
require_once "../config/db.cofig.php";

$db = getDbConnection();
$productControler = new ProductController($db);

$products = $productControler->getAllProducts();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../assets/logo.svg" type="image/x-icon">
    <title>Alpha Bookstore</title>
</head>


<body>
    <div class="container mx-auto px-4 pt-4">
        <?php require_once "../components/navbar.html" ?>

        <div class="mt-3">
            <p class="flex items-center gap-3">
                <span class="text-2xl sm:text-3xl font-bold text-[#EB7575]">
                    Hello, <?= $user['username'] ?> 👋
                </span>
            </p>
            <p class="text-sm sm:text-md mt-3">
                What do you want to read today?
            </p>
        </div>
        <div class="mt-5 flex flex-col gap-5 lg:flex-row lg:items-center">
            <form class="flex items-center justify-around border rounded-lg p-4 border-[#8E8E93] p-4 gap-5 grow" method="post">
                <button class="cursor-pointer">
                    <img src="../assets/site_assets/search.svg" alt="">
                </button>
                <input type="text" placeholder="Search here" class="grow focus:outline-none">
                <img src="../assets/site_assets/filters.svg" alt="" class="cursor-pointer">
            </form>
            <a href="addProduct.view.php" target="_blank" class="bg-emerald-500 text-center px-16 py-4 text-white rounded-lg hover:bg-emerald-800">Add new product</a>
        </div>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-5 flex-wrap gap-4 p-4">
        <?php foreach ($products as $product) : ?>
            <a href="product.php?id=<?= $product['id'] ?>" class="flex flex-col bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300 text-balance">
                <img class="object-contain w-full h-[250px]" src="../assets/products/<?= htmlspecialchars($product['img']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" />
                <div class="p-4 w-[320px]">
                    <p class="font-bold text-xl text-gray-800 mb-1"><?= htmlspecialchars($product['name']); ?></p>
                    <p class="text-gray-600 text-lg mb-1"><?= htmlspecialchars($product['author']); ?></p>
                    <p class="text-gray-600 text-lg"><?= htmlspecialchars($product['price']); ?>$</p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

</body>


</html>