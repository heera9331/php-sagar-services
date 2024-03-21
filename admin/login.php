<?php 
include ("../database.php");
include ("../functions.php");
include ("../components/service.php");
session_start();
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
    
    <main class="min-h-[70vh] mt-[70px]">
        <div class="flex items-center justify-center">
            <form action="#" method="post" class="p-4 flex flex-col w-[400px] h-[280px] border border-black border-opacity-25 mt-[70px] rounded-sm">
                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="username">
                        Username
                    </label>
                    <input
                        type="username"
                        class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                        placeholder="Enter username"
                        name="username"
                        value="heera724"
                    />
                </div>
                <div class="flex flex-col gap-2 m-1 p-1">
                    <label htmlFor="password">
                        Password
                    </label>
                    <input
                        type="password"
                        class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                        placeholder="Enter password"
                        name="password"
                    />
                </div>

                <div class="flex flex-col gap-2 m-2 p-1 border border-black border-opacity-25 bg-gray-200 hover:bg-gray-300">
                    <button type="submit" name="submit" class="rounded-sm">
                        Login
                    </button>

                    
                </div>

                <div class="mx-2 p-1">
                <?php 
                    if(isset($_POST['submit'])) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        $sql = "SELECT username FROM users where username='$username' and password='$password' limit 1;";
                        $res = dbQueryResult($sql);
                        if(isset($res[0])) {
                            $_SESSION['username'] = $res[0]['username'];
                            $_SESSION['isAdmin'] = $res[0]['isAdmin'];
                            
                            echo "<script type='text/javascript'>";
                                echo "document.location.href='/sagar-services/admin'";
                            echo "</script>";
                        } else {
                            echo "invalid creadentials";
                        }
                    }
                ?>
                </div>
            </form> 
            
        </div>
    </main> 

    <?php include ("../components/footer.php"); ?>
    <?php include ("../footerLinks.php"); ?>
  </body>
</html>
