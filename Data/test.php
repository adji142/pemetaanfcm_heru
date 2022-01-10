<?php 
for($i = 0; $i < 15; $i++){
	restart:

	$temp1 = round(rand(8,0.9)/10,2);
	$temp2 = round(rand(1,((1-$temp1)*10)-1)/10,2);
	$temp3 = round((1-$temp1-$temp2),2);

	if ($temp1 == 0) {
		goto restart;
	}
	elseif ($temp2 == 0) {
		goto restart;
	}
	elseif ($temp3 == 0) {
		goto restart;
	}
	// $temp = array($temp1,$temp2,$temp3);
	// array_push($temp, $temp1,$temp2,$temp3);
	// echo $temp1."#".$temp2."#".$temp3."<br>";
	$keanggotaan[] = array(0=>$temp1,1=>$temp2,2=>$temp3);
	// var_dump($keanggotaan);
	echo "#" . $i . " " .$temp1 . " - " . $temp2 . " - " . $temp3 . "<br>";
}
?>