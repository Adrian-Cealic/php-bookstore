<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="./assets/logo.svg" type="image/x-icon">
    <title>Alpha Bookstore</title>
</head>

<body class="relative">
    <div class="bg-[#ef5a5a] absolute top-0 left-0 w-full h-full -z-10"></div>
    <div class="container mx-auto h-screen flex flex-col justtify-center items-center text-center">
        <div class="mt-24">

            <img src="./assets/logowhite.svg" alt="">
            <div class="text-white">
                <h1 class="font-bold text-4xl mt-[58px]">Welcome</h1>
                <p class="text-xl">Read without limits</p>
            </div>

            <div class="flex flex-col gap-4 mt-[58px]">
                <a class="bg-white p-2 rounded-lg text-[#ef5a5a]" href="views/register.view.php">Create account</a>
                <a class="border border-white rounded-lg p-2 text-white" href="views/login.view.php">Log in</a>
            </div>
        </div>
    </div>
</body>

</html>