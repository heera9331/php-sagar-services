<?php 
function containsDrop($string) {
    // Case-insensitive search for 'drop' substring in the given string
    $position = stripos($string, 'drop');
    
    // If 'drop' substring is found, return true, otherwise return false
    return ($position !== false);
}

function dbQuery($sql) {
	global $conn;

	if(containsDrop($sql)) {
		return;
	}

	else {	
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	}
}

function dbQueryResult($sql) {
	global $conn;
	$arr = array(); 
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	// if(containsDrop($sql)) {
	// 	return;
	// }

	while($row = mysqli_fetch_assoc($res))
	{
		$arr[] = $row;
	}
	return $arr;
}


function dbRowCount($sql) {
	global $conn;

	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$arr = array();

	while($row = mysqli_fetch_assoc($res))
	{
		$arr[] = $row;
	}
	
	if(isset($arr)) {
		return intval($arr[0]['cnt']);
	}
	return 0;
}


function generateOptions($options, $key) {
	foreach($options as $option) {
		echo '<option value="'.$option[$key].'">'.$option[$key].'</option>';
	}
}
 



// rating must be in between 1-5 and $msg length greater than or equal 5

function validateReview($rating, $msg) {
    // Ensure $rating is within the range of 1 to 5 and $msg length is between 5 and 256 characters
    if ($rating >= 1 && $rating <= 5 && strlen($msg) >= 5 && strlen($msg) <= 256) {
        return true;
    }
    
    return false;
}

?>

