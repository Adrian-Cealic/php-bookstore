<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <div class="">
        <form action="../handlers/userRegister.handler.php" method="post"
            class="container flex flex-col justify-center items-center h-screen gap-4">
            <img class="mb-[54px]" src="../assets/logo.svg" alt="">
            <input class="border border-[#8E8E93] rounded px-6 py-3" name="username" type="text" placeholder="Username">
            <input class="border border-[#8E8E93] rounded px-6 py-3" name="pwd" type="password" placeholder="Password">
            <input class="border border-[#8E8E93] rounded px-6 py-3" name="email" type="email" placeholder="Email">
            <div class="flex flex-col">
                <label for="telefon">Optional</label>
                <input class="border border-[#8E8E93] rounded px-6 py-3" name="telefon" type="text"
                    placeholder="Mobile Number">
                <label for="locatie">Optional</label>
                <input class="border border-[#8E8E93] rounded px-6 py-3" name="locatie" type="text"
                    placeholder="Location">
            </div>
            <button class="bg-[#EB5757] text-white py-3 px-16 rounded-md" type="submit">Create Account</button>
            <p class="text-[#828282]">Already have an account ? <a href="" class="text-[#828282] font-bold">Log in
                    here</a></p>
            <?php if (!empty($errors)): ?>
                <div class="container flex justify-end items-center flex-col">
                    <?php foreach ($errors as $error): ?>
                        <span class='text-red-500 text-sm'><?= $error ?>!</span><br>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </form>
    </div>
</body>

</html>