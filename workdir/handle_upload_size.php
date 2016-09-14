<?php
if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {

  $filename = basename($_FILES['uploaded_file']['name']);
  $newname = dirname(__FILE__) . '/' . $folder . $filename;

  if (@getimagesize($_FILES["uploaded_file"]["tmp_name"]) !== false) {  
    //Attempt to move the uploaded file to it's new place
    if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $newname))) {
      if(strpos(file_get_contents($newname), "<?php") !== false) {
        echo "<p>
                Félicitations ! Vous avez réussi le niveau 4. Voici l'adresse du dernier niveau :
                <a href='/?difficulte=TucomMencesAGererLeDernierEstBeaucoupBeaucoupPlusDur'>Challenge suivant</a>.
              </p>" ;  
      }else{
        echo "<p>Bravo vous avez réussi à uploader un fichier ! Mais bon il ne faisait rien de bien spécial, du coup l'équipe a décidé de le supprimer. Désolé. </p>";
        echo "<p>Courage !</p>";
      }
    } else {
       echo "Erreur inconnue lors de l'upload.";
    }
  } else {
     echo "Erreur: Seules les images sont acceptées";
  }

  // on supprime le fichier si il existe
  if (file_exists($newname)) {
    unlink($newname);
  }
}
