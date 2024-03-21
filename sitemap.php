<?php 
include ("database.php");
include ("functions.php");
include ("./components/service.php");

?>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include("./headerLinks.php"); ?>
    <title>Sagar Services</title>
</head>
<body class="">
<?php include ("./components/header.php"); ?>
    
<main class="min-h-[75vh] mt-[70px]">
    <div class="flex flex-wrap">
            <ul class="p-2 flex flex-col">
                <h2 class="font-semibold">Admin Area</h2>
                <li>
                    <a class="text-blue-700 underline" href="/sagar-services/admin/login.php">Login</a>
                </li>
                <li>
                    <a class="text-blue-700 underline" href="/sagar-services/admin/add-category.php">Add Category</a>
                </li>
                <li>
                    <a class="text-blue-700 underline" href="/sagar-services/admin/add-service.php">Add Service</a>
                </li>
                <li>
                    <a class="text-blue-700 underline" href="/sagar-services/admin/add-provider.php">Add Provider</a>
                </li>
            </ul>
            <ul class="p-2 flex flex-col">
                <h2 class="font-semibold">Home</h2>
                <li>
                    <a class="text-blue-700 underline" href="/sagar-services">Home Page</a>
                </li>
            </ul>
    </div>
</main> 

 
<?php include ("./components/footer.php"); ?>
<?php include ("./footerLinks.php"); ?>
</body>
</html>
