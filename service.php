<?php 
include ("database.php");
include ("functions.php");
include ("./components/service.php");

$id = $_GET['id'];

// Fetch services for the current page
$sql = "SELECT services.id, title, description, district, categories.name as category, providers.name as provider 
        FROM services
        JOIN categories ON categories.id = services.categoryId
        JOIN providers ON providers.id = services.providerId
        WHERE services.id=$id
        LIMIT 1
        ;";
        
$services = dbQueryResult($sql);
$service = $services[0];

// fething reviews of current service

$sql = "SELECT msg, rating FROM reviews where serviceId=$id order by createdAt desc limit 10;";
$reviews = dbQueryResult($sql);

?>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include("./headerLinks.php"); ?>
    <title>Sagar Services</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body class="">
    <?php include ("./components/header.php"); ?>
    
    <main class="min-h-[100vh] mt-[70px]">
        <div class="flex min-h-[90vh] justify-center"> 
            <!-- main display service -->
            <div class="px-4 lg:flex flex-col justify-center w-[100%]">
                <aside class="min-w-[250px] border border-black border-opacity-25 my-2 p-2 rounded-sm">
                    <h2>Sponsored Service</h2>
                </aside>
                <main class="text-black overflow-x-hidden overflow-y-auto w-[100%]">
                    <div class="">
                        <!-- services -->
                        <?php 
                        echo '
                        <div class="p-4 my-4 text-gray-800 flex flex-col gap-2 border border-black border-opacity-25 rounded-sm">
                                <h3 class="text-xl font-semibold flex items-center">
                                <MdOutlineMiscellaneousServices class="text-3xl" />
                                <span>'.$service['title'].'</span>
                                </h3>
                                <p> ➡️ '.$service['description'].'</p>
                                <p class="flex items-center gap-2"> <FaLocationDot class="text" /> District - '.$service['district'].'</p>
                                <p class="flex items-center gap-2">
                                <MdCategory class="text" />
                                <span>Category -'.$service['category'].'</span>
                                </p>
                                <p class="flex items-center gap-2">
                                <span>Rating - </span>
                                <span class="flex">
                                    <IoIosStar />
                                    <IoIosStar />
                                    <IoIosStar />
                                    <IoIosStar />
                                    <IoIosStarOutline />
                                </span>
                                <span>(4/5)</span>
                                </p>
                                 
                                <button id="bookNowBtn" class="bg-blue-800 text-white px-2 py-1 rounded-sm">Book Now</button>
                                
                                <form id="bookingForm" class="hidden" method="post" action="./service.php?id='.$id.'">
                                    <!-- Your form fields here -->
                                    <div class="flex flex-col gap-2 m-1 p-1">
                                        <label htmlFor="name">
                                            Name
                                        </label>
                                        <input
                                            type="name"
                                            class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                                            placeholder="Enter name"
                                            name="name"
                                            required
                                        /> 
                                    </div>
                                    <div class="flex flex-col gap-2 m-1 p-1">
                                        <label htmlFor="contact">
                                            Mobile number
                                        </label>
                                        <input
                                            type="contact"
                                            class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                                            placeholder="Enter mobile number"
                                            name="contact"
                                            required
                                        /> 
                                    </div>
                                    <div class="flex flex-col gap-2 m-1 p-1">
                                        <label htmlFor="address">
                                            Address
                                        </label>
                                        <input
                                            type="address"
                                            class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                                            placeholder="Enter your address"
                                            name="address"
                                            required
                                        /> 
                                    </div>

                                    <div class="flex flex-col gap-2 m-1 p-1">   
                                        <form method="post" action="./">
                                            <button class="bg-green-600 font-semibold text-white" type="submit" name="serviceRequest">Submit</button>
                                        </form>
                                    </div>
                                </form>
                            </div>
                        ';
                        ?>
                    

                        <?php
                            // service booking
                            if(isset($_POST['serviceRequest'])) {
                                $serviceId = $_GET['id'];
                                $name = $_POST['name'];
                                $contact = $_POST['contact'];
                                $address = $_POST['address'];

                                $sql = "INSERT INTO bookings (name, contact, address, serviceId) values ('$name','$contact', '$address', $serviceId);";

                                dbQuery($sql);
                                echo '
                                <script>
                                    alert("success");
                                </script>
                                ';
                            }
                        ?>
                    <div class="px-2">
                        <!-- reviews -->
                        <h2 class="text-center font-semibold">Reviews</h2>
                    </div>
                    </div>

                </main>
                
                
                
                <div class="py-4 md:flex gap-4">
                    <!-- reviews form -->
                <form  method="post" action="<?php echo "/sagar-services/service.php?id=".$_GET['id']; ?>"  class="max-w-[750px] h-[250px] m-auto w-full">
                    <div class="flex flex-col gap-2 m-1 p-1">
                        <label for="rating">Rating</label>
                        <input
                            type="number"
                            class="p-1 border border-black border-opacity-25 rounded-sm focus: outline-none text-black bg-slate-100"
                            placeholder="Rate the service (between 1-5)"
                            name="rating" 
                            required
                        />
                    </div>
                    <div class="flex flex-col gap-2 m-1 p-1">
                        <label for="review">Description</label>
                        <textarea class="p-1 border border-black border-opacity-25 rounded-sm focus:outline-none text-black bg-slate-100" placeholder="Write your review here.. 256 chars (max limit) and minimum 5" name="review" required></textarea> 
                    </div>
                    
                    <div class="flex flex-col gap-2 m-1 p-1"> 
                        <button type="submit" name="submit" class="p-1 border border-black border-opacity-25 rounded-sm focus:outline-none text-black bg-slate-100 rounded-sm hover:bg-white">
                            Submit
                        </button>
                    </div>

                    <?php  
                        if(isset($_POST['submit'])) {
                            $id = intval($_GET['id']);
                            $rating = intval($_POST['rating']);
                            $msg = $_POST['review'];

                            $sql = "INSERT INTO reviews (msg, serviceId, rating) values('$msg', $id, $rating);";
  
                            if(validateReview($rating, $msg)) {
                                dbQuery($sql);
                                echo '
                                <script>
                                    alert("submitted");
                                </script>
                                ';
                            } else {
                                // stop query
                                echo "please review under condition";
                            }
                        } 
                    ?> 
                </form>
                
                <!-- reviews  -->
                <div class="overflow-y-scroll text-center flex flex-col m-auto w-full h-[250px] gap-4">

                    <?php 
                        $idx = 0;
                        foreach($reviews as $review) { 
                            $idx++;
                            echo '<p class="bg-gray-100 rounded-md p-1 border border-black border-opacity-25 bg-slate-100">';
                                echo '✔'.$review['msg'];
                            echo '</p>';
                        }

                        if(!$idx) {
                            echo "No reviews";
                        }
                    ?>
                                     
                </div>
                </div>
            </div>
        </div>
    </main> 
    
   
 
    <?php include ("./components/footer.php"); ?>
    <?php include ("./footerLinks.php"); ?>
    <script>
        document.getElementById('bookNowBtn').addEventListener('click', function() {
            document.getElementById('bookingForm').classList.toggle('hidden');            
        });
    </script>
</body>
</html>
