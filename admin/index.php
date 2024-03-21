<?php 
	include ("../database.php");
	include ("../protect.php");
	include ("../functions.php");
	include ("../components/service.php");
	 
	
	// fetching bookings
	
	$sql = "
	select bookings.id as id, name, bookings.contact as contact, bookings.address as address, status, bookings.createdAt as createdAt, services.title as service  
	from bookings
	join services on bookings.serviceId = services.id
	order by bookings.createdAt desc
	;
	";
	$bookings = dbQueryResult($sql);
	// print_r($bookings);
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
		<main class="min-h-[75vh] mt-[30px] px-4 my-10 max-w-[1440px] m-auto">
			<div>
				<h1 class="font-semibold text-2xl">Admin</h1>
				<div class="flex flex-col underline text-blue-800 py-2">
					<a href='/sagar-services/admin/add-service.php'>1. Add Service</a>
					<a href='/sagar-services/admin/add-category.php'>2. Add Category</a>
					<a href='/sagar-services/admin/add-provider.php'>3. Add Provider</a>
				</div>
				<div>
					<h2 class="text-xl font-semibold">Pending Bookings request</h2>
					<div class="flex gap-2">
						<div class="mt-4 border border-black border-opacity-25 rounded-sm flex items-center justify-center overflow-x-auto">
							<table
								class="w-full text-sm text-left rtl:text-right text-gray-8  00 dark:text-gray-400 table-auto overflow-x-auto rounded-md"
								>
								<thead class="text-sm text-white/80 uppercase bg-stone-800 dark:bg-gray-800 dark">
									<?php 
										if (isset($bookings) && count($bookings)) {
										echo '
										<tr>
										  <th scope="col" class="p-3">
										    S.No
										  </th>
										  <th scope="col" class="p-3">
										    Name
										  </th>
										  <th scope="col" class="p-3">
										    Service
										  </th>
										  <th scope="col" class="p-3">
										    Address
										  </th>
										  <th scope="col" class="p-3">
										    Status
										  </th>
										  <th scope="col" class="p-3">
										    Date
										  </th>
										  <th scope="col" class="p-3">
										    Action
										  </th>
										</tr>
										';
										  
										}
										?>
								</thead>
								<tbody class="text-gray-800 font-semibold">
									<?php
										$idx = 1;
										// "0 -> pending, 1->approved, -1 -> rejected/discarded";
										foreach ($bookings as $booking) {
										    echo '<tr class="' . ($idx % 2 == 0 ? 'bg-gray-200' : 'bg-gray-100') . '">';
										    echo '<td class="px-2 py-1">' . $idx . '</td>'; 
										    echo '<td class="px-2 py-1">' . $booking['name'] . '</td>';
										    echo '<td class="px-2 py-1">' . $booking['service'] . '</td>'; 
										    echo '<td class="px-2 py-1">' . $booking['contact'] . '</td>'; 
										    echo '<td class="px-2 py-1">'; 
										      if($booking['status']==0) {
										        echo 'pending';
										      }
										      if($booking['status']==1) {
										        echo 'done';
										      }
										      if($booking['status']==-1) {
										        echo 'reject';
										      }
										    echo '</td>'; // Corrected: 'status' column
										    echo '<td class="px-2 py-1">' . $booking['createdAt'] . '</td>'; 
										    echo '<td class="px-2 py-1">
										        <form method="post" action="./" class="flex items-center">';
										        echo '<input type="hidden" name="bookingId" value="'.$booking['id'].'">';
										        echo '
										        <div class="flex flex-col gap-2 m-1">  
										          <select name="action" id="action" class="py-1 px-2 rounded-sm">
										            <option value="">select</option>
										            <option value="1">Done</option>
										            <option value="0">Pending</option>
										            <option value="-1">Reject</option>
										          </select>
										        </div>
										        <div>
										          <button type="submit" name="action_save" class="bg-green-600 text-white rounded-sm px-2 py-1 font-semibold">
												  	Save
												  </button>
										        </div>
										        </form>
										    </td>';
										    echo '</tr>';
										    $idx++;
										}
										?>
									<?php 
										// updating status based on action
										if(isset($_POST['action_save'])) {
										  echo "status is ". $changedStatus = intval($_POST['action']);
										  echo "booking id ". $bookingId = intval($_POST['bookingId']);
										  
										  echo $sql = "
										  UPDATE bookings
										  set status=$changedStatus WHERE id = $bookingId;
										  ";
										  dbQuery($sql);
										  echo '
										    <script>
										        alert("success");
										        window.location.href = window.location.href;
										    </script>
										    ';
										}
										?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="py-2">
            <h2 class="text-xl font-semibold">Previous requests</h2>
          </div>
				</div>
			</div>
		</main>
		<?php include ("../components/footer.php"); ?>
		<?php include ("../footerLinks.php"); ?>
	</body>
</html>