<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="bg-[#105c8a]">
    <form action="../handlers/userRegister.handler.php" method="get">
        <div
            class="container mx-auto flex justify-center items-center max-w-64 sm:max-w-md md:max-w-xl mt-32 flex-col gap-4 bg-white p-8 rounded-lg shadow-lg">
            <span class="border border-gray-500 w-full"></span>
            <div class="flex gap-2">
                <span>"avatar"</span>
                <div class="flex flex-col items-start">
                    <span class="font-semibold">
                        <?php if (isset($_GET['username'])) {
                            echo htmlspecialchars($_GET['username']);
                        }
                        ?>
                    </span>
                    <span>
                        <?php if (isset($_GET['email'])) {
                            echo htmlspecialchars($_GET['email']);
                        }
                        ?>
                    </span>
                </div>
            </div>
            <span class="border border-gray-500 w-full"></span>
            <div class="flex justify-between w-full px-8">
                <span class="font-semibold">Name</span>
                <span name="namebox">
                    <?php
                    if (isset($_GET['username'])) {
                        echo htmlspecialchars($_GET['username']);
                    }
                    ?>
                </span>
            </div>
            <span class="border border-gray-500 w-full"></span>
            <div class="flex justify-between w-full px-8">
                <span class="font-semibold">Email account</span>
                <span name="emailbox">
                    <?php
                    if (isset($_GET['email'])) {
                        echo htmlspecialchars($_GET['email']);
                    }
                    ?>
                </span>
            </div>
            <span class="border border-gray-500 w-full"></span>
            <div class="flex justify-between w-full px-8">
                <span class="font-semibold">Mobile number</span>
                <span name="numberbox">
                    <?php
                    if (isset($_GET['email'])) {
                        echo htmlspecialchars($_GET['telefon']);
                    }
                    ?>
                </span>
            </div>
            <span class="border border-gray-500 w-full"></span>
            <div class="flex justify-between w-full px-8">
                <span class="font-semibold">Location</span>
                <span name="locationbox">
                    <?php
                    if (isset($_GET['email'])) {
                        echo htmlspecialchars($_GET['locatie']);
                    }
                    ?>
                </span>
            </div>
        </div>
    </form>
</body>

</html>