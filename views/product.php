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

$id = $_GET['id'];
$product = $productControler->getProductById($id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/site_assets/logo.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?= htmlspecialchars($product['name']) ?>book</title>
</head>

<body>
    <div class="container mx-auto p-4 ">
        <nav class="">
            <?php require_once '../components/navbar.html' ?>
        </nav>
        <section id="product_page">
            <div class="flex justify-between items-center mt-10 pr-2">
                <a href="admin.view.php">
                    <img class="w-[40px]" src="../assets/site_assets/back.svg" alt="go back">
                </a>
                <img class="w-[40px]" src="../assets/site_assets/heart-red.svg" alt="add to like">
            </div>

            <div class="flex flex-col sm:flex-row min-h-[50vh] sm:mt-15">

                <div class="flex gap-2 items-center flex-col rounded-xl mt-10 sm:items-start">
                    <img class="w-[50%] rounded-xl" src="../assets/products/<?= htmlspecialchars($product['img']) ?>" alt="book cover">
                    <div class="text-center">
                        <p class="font-bold text-xl"><?= htmlspecialchars($product['name']) ?></p>
                        <p class="text-gray-600"><?= htmlspecialchars($product['author']) ?></p>
                        <p class="text-gray-600"><?= htmlspecialchars($product['price']) ?>$</p>
                    </div>
                </div>
                <form method="post" action="../handlers/cartHandler.php" class="flex flex-col items-center h-full text-balance">
                    <p class="font-bold text-xl mt-5">Description:</p>
                    <p class="text-md"><?= htmlspecialchars($product['description']) ?></p>
                    <button class="bg-[#EB5757] w-full text-white py-4 rounded-xl mt-4  ">Add to cart</button>
                </form>
            </div>
        </section>
    </div>
</body>

</html>