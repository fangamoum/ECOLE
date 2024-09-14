<!doctype html>
<html>
    <head>
        <title>Prescolaire</title>
        <meta charset="utf-8">
        <meta name="viewport" content="widht=device-widht , initial-scale=1.0">
        <meta name="description" content="Ecole-GSSI- Israël-GS SAINT ISRAEL DE TAMBAYAH">
        <link rel="stylesheet" href="../css/inscription.css">

    </head>
    <body>
        <header>
           
            <h2 class="guinee">REPUBLIQUE DE GUINEE</h2>
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
              <h1> INCRIPTION OU REINSCRIPTION REUSSIE :</h1>
              <p>
                  vous avez bien été inscript pour l'année scolaire 2024-2025  <br>
                  <strong>au groupe scolaire saint israël de tambayah</strong> <br>
                  veuillez passer à l'etablissement pour finaliser tous les detaills <br>
                  concernant votre inscription.
              </p>


                <?php
                    $serveur = "localhost";
                    $login = "root";
                    $pass = "";
                    $message="";

                   try {
                           $connexion = new PDO("mysql:host=$serveur;dbname=gssi", $login, $pass);
                           $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                           $affichage = $connexion->prepare("SELECT * FROM inscription ORDER BY id asc");
                           $affichage->execute();
                           if(!$affichage){
                            echo "erreur lors de la recuperation";
                           }
                           else{
                            $nombre_eleve_inscript = $affichage->rowCount();
                           }
                           ?>
                           <h2>session: 2024-2025</h2>
                           <h2>Nombre d'élèves Inscripts :<?php echo $nombre_eleve_inscript ?></h2>
                           <h2>LISTE DE TOUS LES ELEVES INSCRIPTS</h2> <br>
                           <table>
                               <tr>
                                     <th>N°</th>
                                     <th>Nom</th>
                                     <th>Prenom</th>
                                     <th>classes</th>
                                     <th>Inscription ou Reinscription</th>
                                     <th>genre</th>
                                     <th>date de naissance</th>
                                     <th>adresse</th>
                                     <th>Nom du tuteur</th>
                                     <th>Prenom du tuteur</th>
                                     <th>Numero de telephone</th>
                                </tr>
                             <?php
                               while($ligne = $affichage->fetch(PDO::FETCH_NUM)){
                                echo "<tr>";
                                foreach($ligne as $valeur){
                                    echo "<td>$valeur</td>";
                                }
                                echo"</tr>";
                               }
                               ?>

                             </table>
                             <?php
                             $affichage->closeCursor();


                   } 
            

                   catch (PDOException $e) {
                         echo "Erreur :" . $e->getMessage();
                    }


                ?>
                <br>

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