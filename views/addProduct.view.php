<?php
session_start();
$user = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : [];
if ($user['role'] != 'admin') {
    header('Location: ../index.php');
    die();
}
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);
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
    <div class="container mx-auto px-4">
        <?php
        require_once "../components/navbar.html";
        ?>

        <form action="../handlers/addProduct.handler.php" class="w-full flex flex-col lg:items-center gap-5 mt-5" method="post" enctype="multipart/form-data">
            <div class="flex flex-col gap-2 lg:w-[500px]">
                <label class="text-sm" for="name">Product name:</label>
                <input class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md"
                    type="text" id="name" name="name">
            </div>
            <div class="flex flex-col gap-2 lg:w-[500px]">
                <label class="text-sm" for="author">Author:</label>
                <input class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md"
                    type="text" id="author" name="author">
            </div>
            <div class="flex flex-col gap-2 lg:w-[500px]">
                <label class="text-sm" for="price">Price:</label>
                <input class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md"
                    type="text" id="price" name="price">
            </div>
            <div class="flex flex-col gap-2 lg:w-[500px]">
                <label class="text-sm" for="description">Description:</label>
                <textarea class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md"
                    id="description" name="description" rows="7"></textarea>
            </div>
            <div class="flex flex-col gap-2 lg:w-[500px]">
                <label class="text-sm" for="qty">Quantity:</label>
                <input class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md"
                    type="number" id="qty" name="qty">
            </div>
            <div class="flex gap-5 lg:w-[500px] items-center">
                <label class="text-sm" for="img">Product Picture:</label>
                <input class="w-2/4 lg:w-full" type="file" id="img" name="img" accept="image/*">
            </div>
            <button class="text-white bg-[#EB5757] py-2 lg:w-[500px]">Add Product</button>
        </form>
        <?php if (!empty($errors)) : ?>
            <div class="text-center">
                <?php foreach ($errors as $error) : ?>
                    <span class='text-red-500'> <?= $error ?>!</span><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>