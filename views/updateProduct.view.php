<?php
session_start();
$user = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : [];
$errors = isset($_SESSION['errors_product_update']) ? $_SESSION['errors_product_update'] : [];

$product = isset($_SESSION['product']) ? $_SESSION['product'] : [];

unset($_SESSION['errors_product_update']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/site_assets/logo.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Alpha Bookstore</title>
</head>

<body>
    <div class="container mx-auto px-4 py-4">
        <div class="w-[20px]">
            <a href="main.view.php" class="flex items-center">
                <img src="../assets/site_assets/back.svg" alt="go back">
                <span class="text-lg">Home</span>
            </a>
            <p class="text-3xl font-bold mt-4"></p>
        </div>
        <form action="../handlers/updateProduct.handler.php" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 mt-6">
            <input type="hidden" name="productId" value="<?= htmlspecialchars($product['id']) ?>">

            <div class="flex flex-col gap-2">
                <label class="text-sm" for="name">Product name:</label>
                <input class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md"
                    type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>">
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-sm" for="author">Author:</label>
                <input class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md"
                    type="text" id="author" name="author" value="<?= htmlspecialchars($product['author']) ?>">
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-sm" for="price">Price:</label>
                <input class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md"
                    type="text" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>">
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-sm" for="description">Description:</label>
                <textarea class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md"
                    id="description" name="description" rows="7"><?= htmlspecialchars($product['description']) ?></textarea>
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-sm" for="qty">Quantity:</label>
                <input class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md"
                    type="number" id="qty" name="qty" value="<?= htmlspecialchars($product['qty']) ?>">
            </div>

            <div class="flex gap-5 flex-col">
                <label class="text-sm" for="img">Product Picture:</label>
                <img class='w-full sm:w-[200px] rounded-xl' src="../assets/products/<?= htmlspecialchars($product['img']) ?>" alt="book cover">
                <input class="w-2/4 lg:w-full" type="file" id="img" name="img" accept="image/*">
            </div>

            <button class="bg-[#EF5A5A] py-3 text-white rounded-xl border border-white mt-5" name="confirm_update">Confirm changes</button>

            <?php if (!empty($errors)): ?>
                <div class="text-center">
                    <?php foreach ($errors as $error): ?>
                        <span class="text-red-500"><?= $error ?>!</span><br>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </form>
    </div>
</body>

</html>