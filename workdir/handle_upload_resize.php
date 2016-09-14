<?php
if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {

  $filename = basename($_FILES['uploaded_file']['name']);
  $newname = dirname(__FILE__) . '/' . $folder . $filename;

  if (resize(32, 32, $_FILES['uploaded_file'], $newname)) {
      if(strpos(file_get_contents($newname), "<?php") !== false || strpos(file_get_contents($newname), "<?=") !== false) {
        echo "<p>
                Félicitations ! Vous avez réussi le dernier niveau. Tu as le droit de venir expliquer devant tout le monde et on va pouvoir te lécher les pieds aussi :)
              </p>" ;  
      }else{
        echo "<p>Bravo vous avez réussi à uploader un fichier ! Mais bon il ne faisait rien de bien spécial, du coup l'équipe a décidé de le supprimer. Désolé. </p>";
        echo "<p>Courage !</p>";
	echo "Image générée : <br>";
	echo '<img src="data:image/x-icon;base64,' . base64_encode(file_get_contents($newname)) . '" width="32" height="32">';

      }
  } else {
     echo "Erreur: Seules les images jpeg, png ou gif sont acceptées";
  }

  // on supprime le fichier si il existe
  if (file_exists($newname)) {
    unlink($newname);
  }
}
