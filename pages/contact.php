<?php
$serveur = "localhost";
$login = "root";
$pass = "";
$message="";
try {
    $connexion = new PDO("mysql:host=$serveur;dbname=gssi", $login, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'erreur :' . $e->getMessage();
}

function securiter($donnees) {
    $donnees = trim($donnees);
    $donnees = strip_tags($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

if (isset($_POST['envoyer'])) {
    $nom = isset($_POST['nom']) ? securiter($_POST['nom']) : '';
    $prenom = isset($_POST['prenom']) ? securiter($_POST['prenom']) : '';
    $mail = isset($_POST['mail']) ? securiter($_POST['mail']) : '';
    $numero = isset($_POST['numero']) ? securiter($_POST['numero']) : '';
    $msg = isset($_POST['msg']) ? securiter($_POST['msg']) : '';

    if (!empty($nom) && !empty($prenom) && !empty($mail) && !empty($numero) && !empty($msg)) {
        $insertion = $connexion->prepare("INSERT INTO parents (nom, prenom, mail, numero, msg)
                                          VALUES (:nom, :prenom, :mail, :numero, :msg)");
        $insertion->bindParam(':nom', $nom);
        $insertion->bindParam(':prenom', $prenom);
        $insertion->bindParam(':mail', $mail);
        $insertion->bindParam(':numero', $numero);
        $insertion->bindParam(':msg', $msg);

        if ($insertion->execute()) {
           header("location:inserer.php");
        } else {
            $message="Erreur lors de l'insertion des données";
        }
    } else {
        $message="Veuillez remplir tous les champs";
    }
}
?>

<!DOCTYPE html>
 <html>
    <head>
        <title>GSSI</title>
        <meta charset="utf-8">
        <meta name="viewport" content="widht=device-widht , initial-scale=1.0">
        <meta name="description" content="Ecole-GSSI- Israël-GS SAINT ISRAEL DE TAMBAYAH">
        <link rel="stylesheet" href="../css/contact">

    </head>
    <body>
        <header>
           
            <h2>REPUBLIQUE DE GUINEE</h2>
            <P class="travail">Travail-</P>
            <P class="justice">Justice-</P>
            <P class="solidarite">solidarite</P>

            <img class="logo" src="../images/logo.jpeg" alt="">
            <ul>
                <li class="pri-sec">
                    <a href="maternelle.php">Maternelle</a>
                    <a href="primaire.php">Primaire</a>
                </li>
            </ul>

        </header>
            <nav>
                <div class="menu">
                    <ul>
                         <li class="ind">
                             <a href="accueil.php">Accueil</a>
                         </li>
                         <li  class="ind">
                             <a href="presentation.php">Présentation</a>
                         </li>
                         <li  class="ind">
                              <a href="classe.php">Classes</a>
                        </li>
                         <li  class="ind">
                             <a  href="inscrpt.php">Inscription</a>
                         </li>

                        <li  class="ind">
                             <a href="contact.php">contacts</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <section class="sec1">
                <div class="menu1">
                     <h2>contactez-nous</h2>
                     <p>
                          Nous sommes à votre écoute pour répondre à toutes 
                          vos questions et vous fournir les informations dont vous avez besoin. 
                          N’hésitez pas à nous contacter par les moyens suivants :
                     </p>
                </div>

                <div class="adresse">
                    <strong>Adresse</strong><br>
                    Groupe Scolaire Saint Israël Tampayah<br>
                     Sous-préfecture de Wonkifong <br>
                        Préfecture de Coyah  <br>
                         Guinée-conakry
                </div>
                <div class="horaire">
                    <p>
                        <strong>Horaires d’Ouverture</strong> <br>
                        Du lundi au vendredi : 8h00 - 17h00 <br>
                        Samedi : 8h00 - 13h00 <br>
                        Dimanche : Fermé
                    </p>
                </div>
                <div class="mail">
                    <p>
                        <strong>contacts</strong> <br>
                        +224 622 93 21 72 /
                        +224 624 62 76 02 <br>
                        <img class="im1" src="../images/t2.jpeg" alt="">

                          gssi@gmail.com  <br>
                         <img class="im2" src="../images/mail2.png" alt="" >
                    </p>
                </div>
              
                     <form method="POST" action="">
                        <fieldset>
                            <legend> Laissez-nous un message </legend>
                                  <label for="nom">Nom</label> 
                                   <input type="text" name="nom" id="nom" placeholder="Nom du parent">  <br>
                                   </div>
                                   <label for="prenom">prenom</label> 
                                   <input type="text" name="prenom" id="prenom" placeholder="Prénom du parent"> <br>
                                   <label for="mail">Email</label> 
                                   <input type="email" name="mail" id="mail" placeholder="Mail du parent"> <br>
                                   <label for="numero">Telephone</label>
                                   <input type="text" id="numero" name="numero" placeholder="Numero de telephone du parent"> <br>
                                   <label for="msg">Message</label>
                                   <textarea id="msg" name="msg" placeholder="Votre message" > </textarea>

                                   <div class="message">
                                      <?php
                                         if(!empty($message)){
                                          echo  $message; 
                                         }
                                    
                                        ?>
                                    </div>
                                    
                                   <input class="bouton" type="reset" value="annuler" name="annuler"> 
                                   <input class="bouton" type="submit" value="Envoyer" name="envoyer">

                                  

                        </fieldset>
                       
                     </form>
                
                

            </section>
            

            <footer>

                <a class="pied1" href="accueil.php">Inscription en ligne</a> <br>
                <a class="pied1" href="maternelle.php">Maternelle</a>  <br>
                <a class="pied1" href="primaire.php">Primaire</a>   <br>
                <a class="pied1" href="modalite.php">Modalités de payement</a>  <br>
                <a class="pied2"  href="rejoindre.php">Nous rejoindre</a>  <br>
                <a class="pied2" href="equipe.php">Notre Equipe</a>  <br>
                <a class="pied2" href="contact.php">Nous contacter</a>  <br>
                <a class="whatsapt2" href="https://wa.me/624707618" title="contactez-nous sur whatsapt"> </a>
                <a class="facebook" href="https://www.facebook.com/groupe scolaire Saint Israël" title="Réjoignez-nous sur facebook"></a>
                
                
                <section class="sec-pied">
                 <p>copyright 2024 GS SAINT ISRAEL</p>
                </section>
            </footer>
    </body>
</html>