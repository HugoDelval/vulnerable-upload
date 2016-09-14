<?php
if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {

  $filename = basename($_FILES['uploaded_file']['name']);
  $newname = dirname(__FILE__) . '/' . $folder . $filename;
  $ext = substr($filename, strrpos($filename, '.') + 1);
  
  if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif") {  
    //Attempt to move the uploaded file to it's new place
    if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $newname))) {
      if(strpos(file_get_contents($newname), "<?php") !== false) {
        echo "<p>
                Félicitations ! Vous avez réussi le niveau 2. Voici l'adresse du prochain niveau :
                <a href='/?difficulte=VousAvezcoMprisLaBASE'>Challenge suivant</a>. <br><br>
                Attention cependant ! Rares sont les installations apache (serveur WEB) qui interprètent et exécutent un fichier XXXX.php.jpg (ou du même genre).<br>
                Dans la 'vraie vie' cet exploit ne suffit donc pas. Il vous faudra :<br>
                - soit trouver une LFI pour inclure le fichier uploadé (et donc inclure et exécuter le code que vous venez de déposer sur le serveur) cf : <a href='http://hackers2devnull.blogspot.fr/2013/10/lfi-vulnerability-image-upload-form-you.html'>un peu de lecture</a>,<br>
                - soit (plus simple) uploader un fichier .htaccess pour dire au serveur apache d'interpréter les fichiers 'XXXX.php.jpg' cf : <a href='http://nullcandy.com/php-image-upload-security-how-not-to-do-it/'>La page qui fait tout</a><br>
                L'upload de fichier est un sujet très sensible ! Même encore aujourd'hui.
              </p>" ;  
      }else{
        echo "<p>Bravo vous avez réussi à uploader un fichier ! Mais bon il ne faisait rien de bien spécial, du coup l'équipe a décidé de le supprimer. Désolé. </p>";
        echo "<p>Courage !</p>";
      }
    } else {
       echo "Erreur inconnue lors de l'upload.";
    }
  } else {
     echo "Erreur: Seules les images en .jpg .jpeg .png .gif sont acceptées";
  }

  // on supprime le fichier si il existe
  if (file_exists($newname)) {
    unlink($newname);
  }
}
