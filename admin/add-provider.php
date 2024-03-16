<?php 
include ("../database.php");
include ("../functions.php");
include ("../components/service.php");
include ("../protect.php");
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
                <h1 class="text-2xl font-semibold text-gray-600">Add Provider</h1>    
                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="name">
                        Name
                    </label>
                    <input
                        type="text"
                        class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                        placeholder="Enter name"
                        name="name"
                        required
                    />
                </div>
                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="mobile">
                        Mobile
                    </label>
                    <input
                        type="text"
                        class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                        placeholder="Enter mobile"
                        name="mobile"
                        required
                    />
                </div>
                

                <div class="flex flex-col gap-2 m-2 p-1 border border-black border-opacity-25 bg-gray-200">
                    <button type="submit" name="submit" class="rounded-sm">
                        add
                    </button>
                </div>

                <?php 
                    if(isset($_POST['submit'])) {
                        $name = $_POST['name'];
                        $mobile = $_POST['mobile'];
                        
                        echo $sql = "INSERT INTO providers (name, mobile) values('$name', '$mobile');";
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
