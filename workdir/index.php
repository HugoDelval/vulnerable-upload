<?php

include_once('utils.php');
include_once('header.php');

session_start();

$folder = 'uploads/' . getUniqueFolder();

if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

include_once('body.php');

if(isset($_GET['difficulte'])){
	switch ($_GET['difficulte']){
	    case "UneChainepluOUMoinSRandom":
	        include_once('handle_upload_extension.php');
	        echo "<p><i>Difficulté : </i> 2/5 </p>";
	        break;
	    case "VousAvezcoMprisLaBASE":
	        include_once('handle_upload_type.php');
	        echo "<p><i>Difficulté : </i> 3/5 </p>";
	    	break;
	    case "NeJamaisfAireConfianCeAuxInputsUser":
	    	include_once('handle_upload_size.php');
	        echo "<p><i>Difficulté : </i> 4/5 </p>";
	    	break;
	    case "TucomMencesAGererLeDernierEstBeaucoupBeaucoupPlusDur":
	    	include_once('handle_upload_resize.php');
	        echo "<p><i>Difficulté : </i> 5/5 </p>";
	    	break;
	    default:
	    	include_once('handle_upload_no_protection.php');
	        echo "<p>Étrange.. Vous voilà reparti en <i>difficulté : </i> 1/5 ?</p>";
	    	break;
	}
}else{
	include_once('handle_upload_no_protection.php');
	echo "<p><i>Difficulté : </i> 1/5 </p>";
}



include_once('footer.php');