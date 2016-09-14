<?php
if( !empty($_FILES["uploaded_file"]) && $_FILES['uploaded_file']['error'] == 0 ) {

  $filename = basename($_FILES['uploaded_file']['name']);
  $newname = dirname(__FILE__) . '/' . $folder . $filename;

  //Attempt to move the uploaded file to it's new place
  if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $newname))) {
    if(strpos(file_get_contents($newname), "<?php") !== false) {
      echo "<p>
              Félicitations ! Vous avez réussi le niveau 1. Et oui ça arrive parfois.. <br>
              Voici l'adresse du prochain niveau :
              <a href='/?difficulte=UneChainepluOUMoinSRandom'>Challenge suivant</a>.
            </p>" ;  
    }else{
      echo "<p>Bravo vous avez réussi à uploader un fichier ! Mais bon il ne faisait rien de bien spécial, du coup l'équipe a décidé de le supprimer. Désolé. </p>";
      echo "<p>Courage !</p>";
    }
  } else {
    echo "<p>Erreur inconnue lors de l'upload.</p>";
  }

  // on supprime le fichier si il existe
  if (file_exists($newname)) {
    unlink($newname);
  }
}
