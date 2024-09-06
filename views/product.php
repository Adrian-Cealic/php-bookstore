<?php
require_once "../controllers/ProductController.php";
require_once "../config/db.cofig.php";
$user = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : [];

$db = getDbConnection();
$productControler = new ProductController($db);

$id = $_GET['id'];
$product = $productControler->getProductById($id);

$action = $user['role'] == 'admin' ? '../handlers/product.handler.php' : '../handlers/cart.handler.php';
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
                <a href="main.view.php">
                    <img class="w-[20px]" src="../assets/site_assets/back.svg" alt="go back">
                </a>
                <img class="w-[40px]" src="../assets/site_assets/heart-red.svg" alt="add to like">
            </div>

            <div class="h-auto mb-20 grid grid-cols-1 lg:grid-cols-2">
                <div class="flex-1 flex flex-col gap-4 justify-center items-center mb-10 lg:mb-0">
                    <img class="w-[50%] rounded-xl" src="../assets/products/<?= htmlspecialchars($product['img']) ?>" alt="book cover">
                    <div class="text-center">
                        <p class="font-bold text-xl"><?= htmlspecialchars($product['name']) ?></p>
                        <p class="text-gray-600"><?= htmlspecialchars($product['author']) ?></p>
                        <p class="text-gray-600"><?= htmlspecialchars($product['price']) ?>$</p>
                    </div>
                </div>

                <form action="<?= htmlspecialchars($action) ?>" method="post" class="flex flex-col items-center h-full text-balance"
                enctype="multipart/form-data">
                    <p class="font-bold text-xl mt-5">Description:</p>
                    <p class="text-md"><?= htmlspecialchars($product['description']) ?></p>
                    <input type="hidden" name="productId" value="<?= $id ?>">
                    <input type="hidden" name="userId" value="<?php echo $user['id'] ?>">

                    <?php if ($user['role'] == 'admin'): ?>
                        <button name="update_product" class="bg-blue-500 w-full text-white py-4 rounded-xl mt-5">Update</button>
                        <button name="delete_product" class="bg-red-500 w-full text-white py-4 rounded-xl mt-5">Delete</button>
                    <?php else: ?>
                        <button name="add_to_cart" class="bg-[#EB5757] w-full text-white py-4 rounded-xl mt-4">Add to cart</button>
                    <?php endif; ?>
                </form>    
            </div>


        </section>
    </div>
</body>

</html>