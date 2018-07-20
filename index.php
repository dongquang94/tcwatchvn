<?php
	$mod = "";
	if(isset($_GET["mod"])){
		$mod = $_GET["mod"];
		switch($mod){
			case "admin":
				header("Location: admin");
				break;
			default:
				header("Location: public");
				break;
		}
	}
	else {
		header("Location: public");
	}
?>