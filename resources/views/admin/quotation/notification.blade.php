<?php
$date = new DateTime();
$data12 = $date->format('d/m/Y');
foreach($data as $demo){
	$a = $demo->follow_up;
	if($a == $data12){
		echo ($demo['customer']->email);
	}
	else{
		echo "Not Match";
	}
	echo "</br>";
}
?>