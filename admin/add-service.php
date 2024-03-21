<?php 
include ("../database.php");
include ("../functions.php");
include ("../components/service.php");
include ("../protect.php");

$categories = dbQueryResult("SELECT  id, name FROM categories;");
$districts = dbQueryResult("SELECT DISTINCT district FROM services;");
$providers = dbQueryResult("SELECT id,name FROM providers;");


?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php
    include("../headerLinks.php");
    ?>
    <title>Sagar Services</title>
  </head>
  <body class="">
  <?php 
      include ("../components/header.php");
    ?>
    
    <main class="min-h-[100vh] mt-[70px]">
        <div class="flex items-center justify-center">
            <form action="#" method="post" class="p-4 flex flex-col w-[400px] h-[700px] border border-black border-opacity-25 mt-[20px] rounded-sm">
                <h1 class="text-2xl font-semibold text-gray-600">Add A New Service</h1>    
                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="name">
                        Name
                    </label>
                    <input
                        type="text"
                        class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                        placeholder="Enter service provider name"
                        name="name"
                        required
                    />
                </div>    
                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="description">
                        Description
                    </label>
                    <textarea
                        
                        class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                        placeholder="Enter service provider name"
                        name="description"
                        required
                    ></textarea>
                </div>
                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="mobile">
                       Mobile
                    </label>
                    <input
                        type="text"
                        class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                        placeholder="Enter provider mobile number"
                        name="mobile"
                        required
                    />
                </div>
                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="providerId">
                        Provider
                    </label>
                    <select title="provider" name="providerId" id="providerId">
                    <?php 
                        foreach($providers as $provider) {
                            
                            echo '<option value="'.$provider['id'].'" >'.$provider['name'].'</option>';
                        }
                    ?>
                    </select>
                </div>

                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="district">
                        District
                    </label>
                    <input
                        type="text"
                        class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                        placeholder="Enter district"
                        name="district"
                    />
                </div>
                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="category">
                        Category
                    </label>
                    <select name="category" id="category">
                    <?php 
                        foreach($categories as $category) {
                            echo '<option value="'.$category['id'].'" >'.$category['name'].'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="address">
                        Address
                    </label>
                    <input
                        type="text"
                        class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                        placeholder="Enter address"
                        name="address"
                        required
                    />
                </div>
                 

                <div class="flex flex-col gap-2 m-2 p-1 border border-black border-opacity-25 bg-gray-200">
                    <button type="submit" name="submit" class="rounded-sm">
                        add now
                    </button>
                </div>

                <?php 
                    if(isset($_POST['submit'])) {
                        $title = $_POST['name'];
                        $description = $_POST['description'];
                        $contact = $_POST['mobile'];
                        $providerId = $_POST['providerId'];
                        $district = $_POST['district'];
                        $categoryId = $_POST['category'];
                        $address = $_POST['address'];
                        $sql = "INSERT INTO services (title, description, contact, providerId, district, categoryId, address) values('$title', '$description', '$contact', '$providerId', '$district', '$categoryId', '$address');";

                        dbQuery($sql);
                        echo '
                        <script>
                            alert("success");
                        </script>
                        ';
                    }
                ?>
            </form>
        </div>
    </main> 
    
 
    <?php include ("../components/footer.php"); ?>
    <?php include ("../footerLinks.php"); ?>
  </body>
</html>
