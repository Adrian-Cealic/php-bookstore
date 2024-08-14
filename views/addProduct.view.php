<?php
session_start();
$user = $_SESSION['loggedInUser'] ?? [];
if ($user['role'] != 'admin') {
    header('Location: ../index.php');
    die();
}
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
    <div class="container mx-auto px-4">
        <?php require_once "../components/navbar.html" ?>
        <form action="../handlers/addproduct.handler.php" class="w-full flex flex-col lg:items-center gap-5 mt-10" method="post">
            <div class="flex flex-col gap-4 lg:w-[500px]">
                <label class="text-sm" for="name">Name:</label>
                <input type="text" id="name" name="name" class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md">
            </div>
            <div class="flex flex-col gap-4 lg:w-[500px]">
                <label class="text-sm" for="price">Price:</label>
                <input type="number" id="price" name="price" class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md">
            </div>
            <div class="flex flex-col gap-4 lg:w-[500px]">
                <label class="text-sm" for="description">Description:</label>
                <input type="text" id="description" name="description" class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md">
            </div>
            <div class="flex flex-col gap-4 lg:w-[500px]">
                <label class="text-sm" for="qty">Quantity:</label>
                <input type="text" id="qty" name="qty" class="border border-[#EB5757] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md">
            </div>
            <div class="flex flex-col gap-4 lg:w-[500px]">
                <label class="text-sm" for="pic">Porfile pic:</label>
                <input type="file" id="name" name="pic">
            </div>
        </form>
    </div>


</body>

</html>