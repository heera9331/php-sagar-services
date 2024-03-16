
<?php 

    function service($service) {
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
                <div>
                  <a href="service.php?id='.$service['id'].'" class="bg-blue-700 text-white py-1 px-2 rounded-sm">
                    view
                  </a>
                </div>
              </div>
        ';
    }
?>