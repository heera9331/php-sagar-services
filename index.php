<?php 
include ("database.php");
include ("functions.php");
include ("./components/service.php");

$pageSize = 15;
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the offset based on the current page and page size
$offset = ($currentPage - 1) * $pageSize;

$categories = dbQueryResult("SELECT  id, name FROM categories;");
$districts = dbQueryResult("SELECT DISTINCT district FROM services;");

// Fetch services for the current page
$sql = "SELECT services.id, title, description, district, categories.name as category, providers.name as provider 
        FROM services
        JOIN categories ON categories.id = services.categoryId
        JOIN providers ON providers.id = services.providerId
        order by services.createdAt desc
        LIMIT $offset, $pageSize
        ";

$services = dbQueryResult($sql);

// Count total number of services
$totalServices = dbRowCount("SELECT count(*) as cnt FROM services;");
$totalPages = ceil($totalServices / $pageSize);
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

<main class="min-h-[100vh] mt-[70px]">
    <div class="flex max-lg:flex-col min-h-[90vh]">
        <!-- {/* left sidebar */} -->
        <aside class="p-4 border-r border-black border-opacity-25 columns-sm">
            <div class="flex flex-col">
                <form action="./" method="get">
                    <div class="flex flex-col">
                        <div class="flex flex-col gap-2 m-1 p-1">
                            <label for="query">Search</label>
                            <input type="search" name="query" placeholder="Search here..."
                            class="py-1 px-4 rounded-sm text-black border border-black border-opacity-25 focus:outline-none focus:border-b-1" />
                        </div>
                        <h3 class="font-semibold">Filters</h3>
                        <div class="flex flex-col gap-2 m-1 p-1">
                        <label htmlFor="district">
                            District
                        </label>
                        <select name="district" id="district">
                            <option value="">select</option>
                        <?php 
                            foreach($districts as $district) {
                                echo '<option value="'.$district['district'].'" >'.$district['district'].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                        <div class="flex flex-col gap-2 m-1 p-1">
                        <label htmlFor="category">
                            Category
                        </label>
                        <select name="category" id="category">
                            <option value="">select</option>
                        <?php 
                            foreach($categories as $category) {
                                echo '<option value="'.$category['id'].'" >'.$category['name'].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                        <div class="flex px-2 items-center justify-center">
                            <button type="submit" name="search" class="bg-gray-200 px-2 py-1 rounded-sm font-semibold border">
                                Apply
                            </button>
                        </div>
                    </div>

                    <?php
                        if(isset($_GET['search'])) {
                            echo "YES";
                            $query = $_GET['query'];
                            $district = $_GET['district'];
                            $category = $_GET['category'];

                            

                            $searchQuery = "
                            SELECT services.id, title, description, district, categories.name as category, providers.name as provider 
                            FROM services
                            JOIN categories ON categories.id = services.categoryId
                            JOIN providers ON providers.id = services.providerId
                            WHERE title LIKE '$query%'
                            ";

                            if($category != "") {
                                
                                $searchQuery .= "AND categoryId=$category ";
                            }

                            if($district != "") {
                                $searchQuery .= "AND district='$district' ";
                            }

                            $searchQuery .= "order by services.createdAt desc
                            LIMIT $offset, $pageSize";

                            // print_r($searchQuery);
                            $services = dbQueryResult($searchQuery);
                        }
                    ?>
                </form>
            </div>
        </aside>

        <!-- {/* main display services */} -->
        <div class="px-4">
            <aside class="min-w-[250px]  border border-black border-opacity-25 p-2 rounded-sm">
                <h2>Sponsored Service</h2>
            </aside>
            <main class=" text-black overflow-x-hidden overflow-y-auto">
                <div class="">
                    
                    <!-- services -->
                    <!-- search result -->
                    <?php
                        if(isset($_GET['search'])) {
                            echo "Showing result '".$_GET['query']."'";
                        }
                    ?>

                    <?php
                    foreach($services as $service) {
                        service($service);   
                    }
                    ?>
                </div>

                <div class="flex items-center justify-center">
                    <?php if ($currentPage > 1): ?>
                    <a href="?page=<?php echo $currentPage - 1; ?>">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                        </svg>
                    </a>
                    <?php endif; ?>
                    <p><?php echo $currentPage; ?>/<?php echo $totalPages; ?></p>
                    <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?php echo $currentPage + 1; ?>">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                        </svg>
                    </a>
                    <?php endif; ?>
                </div>
            </main>
            
        </div>
    </div>
</main> 
 
<?php include ("./components/footer.php"); ?>
<?php include ("./footerLinks.php"); ?>
</body>
</html>
