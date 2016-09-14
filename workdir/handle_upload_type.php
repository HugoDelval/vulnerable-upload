<?php
if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {

  $filename = basename($_FILES['uploaded_file']['name']);
  $newname = dirname(__FILE__) . '/' . $folder . $filename;

  $valid_mime_types = array(
    "image/gif",
    "image/png",
    "image/jpeg",
    "image/pjpeg",
  );

  if (in_array($_FILES["uploaded_file"]["type"], $valid_mime_types)) {  
    //Attempt to move the uploaded file to it's new place
    if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $newname))) {
      if(strpos(file_get_contents($newname), "<?php") !== false) {
          $ext = substr($filename, strrpos($filename, '.') + 1);
  
	  if ($ext === "php") { 
		echo "<p>
                	Félicitations ! Vous avez réussi le niveau 3. Voici l'adresse du prochain niveau :
                	<a href='/?difficulte=NeJamaisfAireConfianCeAuxInputsUser'>Challenge suivant</a>.
              	</p>" ;
	} else{
	        echo "<p>Bravo vous avez réussi à uploader un fichier ! Mais bon il ne faisait rien de bien spécial.<p>";
        	echo "<p>Avec une extension php !</p>";
		echo "<p>Courage !</p>";
	}  
      }else{
        echo "<p>Bravo vous avez réussi à uploader un fichier ! Mais bon il ne faisait rien de bien spécial, du coup l'équipe a décidé de le supprimer. Désolé. </p>";
        echo "<p>Courage !</p>";
      }
    } else {
       echo "Erreur inconnue lors de l'upload.";
    }
  } else {
     echo "Erreur: Seules les images sont acceptées (gif, png, jpeg)";
  }

  // on supprime le fichier si il existe
  if (file_exists($newname)) {
    unlink($newname);
  }
}
