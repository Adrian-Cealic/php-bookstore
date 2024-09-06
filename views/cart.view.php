<?php
require_once '../controllers/ProductController.php';
require_once '../controllers/CartController.php';
require_once '../config/db.cofig.php';
 
$user = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : [];
$db = getDbConnection();
$productController = new ProductController($db);
$cartController = new CartController($db);
 
$products = $cartController->getAllCartProducts($user['id']);
?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/site_assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../scripts/script.js" defer></script>
    <title>Cart</title>
</head>
 
<body>
    <div class="container mx-auto px-4">
        <?php
        require_once "../components/navbar.html";
        ?>
        <section id="cart">
            <h1 class="font-bold text-3xl mt-10">Cart: </h1>
            <div class="flex flex-col flex-wrap mt-6 gap-6 md:w-[90%]">
                <?php if(empty($products)):?>
                    <h1 class="text-center text-4xl">Buy some books first !</h1>
                <?php else:?>
                    <?php foreach ($products as $product): ?>
                        <?php $product = $productController->getProductById($product['product_id']) ?>
                        <form class="flex flex-col flex-wrap mt-6 gap-6 md:w-[90%]" action="../handlers/cart.handler.php"
                            method="post">
                            <a href="product.view.php?id=<?= $product['id']; ?>"
                                class='flex justify-between p-2 rounded-xl items-center w-full'>
                                <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                                <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                                <div class="w-[30%]">
                                    <img src="../assets/products/<?= htmlspecialchars($product['img']); ?>"
                                        class="rounded-xl object-contain h-[80px] md:h-[150px] mx-auto" />
                                    <p class="font-bold text-sm md:text-xl text-center">
                                        <?= htmlspecialchars($product['name']); ?></p>
                                </div>
                                <p class="hidden lg:block w-[130px] font-bold text-sm md:text-xl text-center">
                                    <?= htmlspecialchars($product['author']); ?></p>
                                <p class="text-[#9D9D9D] text-sm md:text-lg"><?= htmlspecialchars($product['price']); ?>$</p>
                                <button class="text-rose-500 font-bold md:text-lg hover:shadow-lg transition-shadow duration-300 p-4 rounded-xl" name="delete_button">Delete</button>
                            </a>
                        </form>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>
</body>
 
</html>