<?php
session_start();
$errors = isset($_SESSION['errors_login']) ? $_SESSION['errors_login'] : [];
unset($_SESSION['errors_login']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../assets/logo.svg" type="image/x-icon">

    <title>Log in</title>
</head>

<body>
    <form action="../handlers/userLogin.handler.php" method="post">
        <div class="flex justify-center items-center mt-24 flex-col">
            <img src="../assets/logo.svg" alt="">
            <div class="flex flex-col gap-4 mt-[55px]">
                <input class="border drop-shadow-xl border-[#8E8E93] rounded px-10 py-3" name="username" type="text" placeholder="Username">
                <input class="border drop-shadow-xl border-[#8E8E93] rounded px-10 py-3" name="pwd" type="password" placeholder="Password">
            </div>

            <button class="bg-[#EB5757] text-white py-3 px-28 rounded-md mt-[55px]" type="submit">Log in</button>
            <p class="text-[#828282] mt-[27px]">Dont have an account yet? <a href="register.view.php" class="text-[#828282] font-bold">Sign up here</a></p>
        </div>

    </form>
    <div class="flex top-0">

        <?php if (!empty($errors)) : ?>
            <div class="container flex justify-end items-center flex-col">
                <?php foreach ($errors as $error) : ?>
                    <span class='text-red-500 text-sm'><?= $error ?>!</span><br>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</body>

</html>