<?php 
include ("../database.php");
include ("../functions.php");
include ("../components/service.php");
include ("../protect.php");

$categories = dbQueryResult("SELECT id,name FROM categories;");
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
            <form action="#" method="post" class="p-4 flex flex-col w-[400px] h-[300px] border border-black border-opacity-25 mt-[100px] rounded-sm">
                <h1 class="text-2xl font-semibold text-gray-600">Add Category</h1>    
                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="category">
                        Category
                    </label>
                    <input
                        type="text"
                        class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                        placeholder="Enter category name"
                        name="category"
                        required
                    />
                </div>
                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="parentCategory">
                        Is a sub-category of (optional)
                    </label>
                    <select name="parentCategory">
                        <option value="0">None</option>
                        <?php
                            foreach($categories as $category) {
                                echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="flex flex-col gap-2 m-2 p-1 border border-black border-opacity-25 bg-gray-200">
                    <button type="submit" name="submit" class=" rounded-sm">
                        add
                    </button>
                </div>


                <?php
                    if(isset($_POST['submit'])) {
                        $category = $_POST['category'];
                        $parentCategory = $_POST['parentCategory'];
                        $sql = "INSERT INTO categories (name, parentCategoryId) values ('$category', $parentCategory);";
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
