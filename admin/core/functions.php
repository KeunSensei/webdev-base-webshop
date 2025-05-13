<?php

function mes($val){ //gebruiken bij [INSERT | UPDATE] query bij alle input
	global $con;
	if(!is_array($val)){
		$val = mysqli_escape_string($con,trim($val));
		$val = str_replace(array("\\r","\\n"),array("\r","\n"),$val);
	}else{
		$val = array_map("mes",$val);	
	}
	return $val;
}

function strip($val){ //gebruiken bij [SELECT] query  bij alle (string) waarden
	$val = stripslashes(trim($val));
	$val = stripslashes(trim(str_replace('"','&quot;',$val)));
	return $val;
}

function stripHTML($val){ //gebruiken bij [SELECT] query  bij alle (string) waarden
	$val = stripslashes(trim($val));
	//$val = stripslashes(trim(str_replace('"','&quot;',$val)));
	return $val;
}

function doMes() {
	foreach($_POST as $key => $val) {
		$_POST[$key] = mes($val);
	}
}
function noticeRij($type,$url=false){
	$useurl = 'index.php';
	if($url){ $useurl = $url; }
	if($type == 'error'){
		echo "
			<div class=\"alert alert-block alert-danger fade in\">
				<h4 class=\"alert-heading m-b-n\">Er is een fout opgetreden tijdens de verwerking </h4><br>
				<meta http-equiv=\"refresh\" content=\"2; URL=$useurl\">
			</div>
		";	
	}elseif($type == 'dubbel'){
		echo "
		<div class=\"alert alert-block alert-danger fade in\">
			<h4 class=\"alert-heading m-b-n\">Er is een dubbel resultaat </h4><br>
			<meta http-equiv=\"refresh\" content=\"2; URL=$useurl\">
		</div>
	";	
	}elseif($type == 'delete'){
		echo "
		<div class=\"alert alert-block alert-danger fade in\">
			<h4 class=\"alert-heading m-b-n\">Item is verwijderd </h4><br>
			<meta http-equiv=\"refresh\" content=\"2; URL=$useurl\">
		</div>
	";	
	}else{
		echo "
			<div class=\"alert alert-block alert-success fade in\">
				<h4 class=\"alert-heading m-b-n\">Item is opgeslagen</h4><br>
				<meta http-equiv=\"refresh\" content=\"1; URL=$useurl\">
			</div>
		";
	}
}