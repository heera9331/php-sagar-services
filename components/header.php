<?php 

session_start();

print_r($_SESSION);

echo '<nav class="border border-black border-opacity-25 bg-gray-100 fixed top-[0] w-full">';
echo '  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">';
echo '    <a href="/sagar-services/" class="flex items-center space-x-3 rtl:space-x-reverse">';
echo '        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />';
echo '        <span class="self-center text-2xl font-semibold whitespace-nowrap font-gray-800">Sagar-Services</span>';
echo '    </a>';
echo '    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">';
echo '        <span class="sr-only">Open main menu</span>';
echo '        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">';
echo '            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>';
echo '        </svg>';
echo '    </button>';
echo '    <div class="hidden w-full md:block md:w-auto" id="navbar-default">';
echo '      <ul class="font-medium flex flex-col p-4 md:p-0 max-md:mt-4 border-gray-100 rounded-sm bg-gray-50 md:flex-row md:space-x-2 rtl:space-x-reverse    ">';
echo '        <li>';
echo '          <a href="/sagar-services/" class="border border-black border-opacity-25 bg-white block py-1 px-2 hover:text-white hover:bg-blue-700 rounded-sm text-black " aria-current="page">Home</a>';
echo '        </li>';


if(isset($_SESSION['username']))  {
  echo '          <li>';
  echo '          <a href="/sagar-services/admin" class="border border-black border-opacity-25 bg-white block py-1 px-2 hover:text-white hover:bg-blue-700 rounded-sm text-black " aria-current="page">Admin</a>';
  echo '        </li>';

}
echo '        <li>';
echo '          <a href="/sagar-services/sitemap.php" class="border border-black border-opacity-25 bg-white block py-1 px-2 hover:text-white hover:bg-blue-700 rounded-sm text-black " aria-current="page">SiteMap</a>';
echo '        </li>';

if(isset($_SESSION['username'])) {
  echo '        <li>';
echo '          <a href="/sagar-services/logout.php" class="border border-black border-opacity-25 bg-white block py-1 px-2 hover:text-white hover:bg-blue-700 rounded-sm text-black " aria-current="page">Logout</a>';
echo '        </li>';
} else {
  echo '        <li>';
echo '          <a href="/sagar-services/admin/login.php" class="border border-black border-opacity-25 bg-white block py-1 px-2 hover:text-white hover:bg-blue-700 rounded-sm text-black " aria-current="page">Login</a>';
echo '        </li>';
}

echo '         ';
echo '      </ul>';
echo '    </div>';
echo '  </div>';
echo '</nav>';

 ?>
