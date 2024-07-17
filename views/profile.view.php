<?php
session_start();
$user = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : [];
$errors = isset($_SESSION['errors_update']) ? $_SESSION['errors_update'] : [];
unset($_SESSION['errors_update']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../assets/logo.svg" type="image/x-icon">

    <title>User</title>
</head>

<body class="bg-[#EB5757]">
    <form action="../handlers/updateUser.handler.php" method="post" enctype="multipart/form-data">
        <div class="container mx-auto flex justify-center max-w-68 sm:max-w-md md:max-w-xl mt-8 flex-col gap-4 bg-white p-8 rounded-lg shadow-lg">
            <div class="">
                <a href="main.view.php" class="flex items-center gap-2">
                    <img src="../assets/site_assets/back.svg" alt="go back">
                    <span class="text-lg">Home</span>
                </a>
                <p class="font-bold text-2xl">My Profile:</p>
            </div>
            <span class="border border-gray-500 w-full"></span>
            <div class="flex gap-8 items-center">
                <img class="w-[50px] h-[50px] rounded-full object-fill" src="../assets/users/<?= htmlspecialchars($user['profile_pic'] ?? 'avatar.png'); ?>" alt="">
                <div class="flex flex-col items-start">
                    <p class="font-bold"><?= htmlspecialchars($user['username']); ?></p>
                    <p class="text-stone-500"><?= htmlspecialchars($user['email']); ?></p>
                </div>
            </div>
            <span class="border border-gray-500 w-full"></span>
            <div class="flex-col gap-2 flex">
                <label for="email" id="email" class="font-semibold text-sm text-stone-500">Email account</label>
                <input class=" border drop-shadow-xl border-[#8E8E93] rounded px-3 py-1" type="text" name="email" value="<?= htmlspecialchars($user['email']); ?>">
            </div>
            <span class="border border-gray-500 w-full"></span>
            <div class="flex-col gap-2 flex">
                <label for="telefon" id="telefon" class="font-semibold text-sm text-stone-500">Mobile number</label>
                <input class=" border drop-shadow-xl border-[#8E8E93] rounded px-3 py-1" type="text" name="telefon" value="<?php echo isset($user['telefon']) ? htmlspecialchars($user['telefon']) : 'none'; ?>">
            </div>
            <span class="border border-gray-500 w-full"></span>
            <div class="flex-col gap-2 flex">
                <label for="location" id="location" class="font-semibold text-sm text-stone-500">Location</label>
                <input class=" border drop-shadow-xl border-[#8E8E93] rounded px-3 py-1" type="text" name="location" value="<?php echo isset($user['locatie']) ? htmlspecialchars($user['locatie']) : 'none'; ?>">
            </div>
            <span class="border border-gray-500 w-full"></span>
            <div class="flex-col gap-2 flex">
                <label for="profile_pic" id="profile_pic" class="font-semibold text-sm text-stone-500">Location</label>
                <input class=" border drop-shadow-xl border-[#8E8E93] rounded px-3 py-1" type="file" name="profile_pic">
            </div>
            <span class="border border-gray-500 w-full"></span>
            <button class="bg-[#EB5757] text-white py-2 px-10 sm:px-20 rounded-md" type="submit">Save changes</button>
            <?php if (!empty($errors)) : ?>
                <div class="container flex justify-end items-center flex-col">
                    <?php foreach ($errors as $error) : ?>
                        <span class='text-red-500 text-sm'><?= $error ?>!</span><br>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>

    </form>

</body>

</html>