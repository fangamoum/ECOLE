<?php
$serveur = "localhost";
$login = "root";
$pass = "";
$message="";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=gssi", $login, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur :" . $e->getMessage();
}

function securiser($donnees) {
    $donnees = trim($donnees);
    $donnees = strip_tags($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

if (isset($_POST["soumettre"])) {
    $nom_eleve = isset($_POST['nom_eleve']) ? securiser($_POST['nom_eleve']) : '';
    $prenom_eleve = isset($_POST['prenom_eleve']) ? securiser($_POST['prenom_eleve']) : '';
    $classe = isset($_POST['classe']) ? securiser($_POST['classe']) : '';
    $inscription_reinscription = isset($_POST['inscription_reincription']) ? securiser($_POST['inscription_reincription']) : '';
    $sexe = isset($_POST['sexe']) ? securiser($_POST['sexe']) : '';
    $date_naissance = isset($_POST['date_naissance']) ? securiser($_POST['date_naissance']) : '';
    $adresse = isset($_POST['adresse']) ? securiser($_POST['adresse']) : '';
    $nom_parent = isset($_POST['nom_parent']) ? securiser($_POST['nom_parent']) : '';
    $prenom_parent = isset($_POST['prenom_parent']) ? securiser($_POST['prenom_parent']) : '';
    $telephone = isset($_POST['telephone']) ? securiser($_POST['telephone']) : '';

    if (!empty($nom_eleve) && !empty($prenom_eleve) && !empty($classe) && !empty($inscription_reinscription) 
        && !empty($sexe) && !empty($date_naissance) && !empty($adresse) && !empty($nom_parent) 
        && !empty($prenom_parent) && !empty($telephone)) {
        $insertion = $connexion->prepare("INSERT INTO inscription (nom_eleve, prenom_eleve, classe, inscription_reincription, 
                                                      sexe, date_naissance, adresse, nom_parent, prenom_parent, telephone) 
                                        VALUES (:nom_eleve, :prenom_eleve, :classe, :inscription_reincription, :sexe, 
                                        :date_naissance, :adresse, :nom_parent, :prenom_parent, :telephone)");

        $insertion->bindParam(':nom_eleve', $nom_eleve);
        $insertion->bindParam(':prenom_eleve', $prenom_eleve);
        $insertion->bindParam(':classe', $classe);
        $insertion->bindParam(':inscription_reincription', $inscription_reinscription);
        $insertion->bindParam(':sexe', $sexe);
        $insertion->bindParam(':date_naissance', $date_naissance);
        $insertion->bindParam(':adresse', $adresse);
        $insertion->bindParam(':nom_parent', $nom_parent);
        $insertion->bindParam(':prenom_parent', $prenom_parent);
        $insertion->bindParam(':telephone', $telephone);

        if ($insertion->execute()) {
            header("location:incription.php");
        } else {
            $message = "Erreur lors de l'insertion";
        }
    } else {
        $message ="Veuillez remplir tous les champs";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>GSSI</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ecole-GSSI- Israël-GS SAINT ISRAEL DE TAMBAYAH">
    <link rel="stylesheet" href="../css/f_incript.css">
</head>
<body>
<header>
    <h2>REPUBLIQUE DE GUINEE</h2>
    <p class="travail">Travail-</p>
    <p class="justice">Justice-</p>
    <p class="solidarite">Solidarité</p>
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
            <li class="ind"><a href="accueil.php">Accueil</a></li>
            <li class="ind"><a href="presentation.php">Présentation</a></li>
            <li class="ind"><a href="classe.php">Classes</a></li>
            <li class="ind"><a href="inscrpt.php">Inscription</a></li>
            <li class="ind"><a href="contact.php">Contacts</a></li>
        </ul>
    </div>
</nav>
<section class="sec1">
    <form method="POST" action="">
        <fieldset>
            <legend>Inscription ou Réinscription des élèves</legend>
            <label for="nom_eleve">Nom de l'élève</label>
            <input type="text" id="nom_eleve" name="nom_eleve">

            <label for="prenom_eleve">Prénom de l'élève</label>
            <input type="text" id="prenom_eleve" name="prenom_eleve">

            <label for="classe">Classes</label>
            <select class="sect" name="classe" id="classe">
                <optgroup label="Maternelle">
                    <option value="Petite Section">Petite Section</option>
                    <option value="Moyenne Section">Moyenne Section</option>
                    <option value="Grande Section">Grande Section</option>
                </optgroup>
                <optgroup label="Primaire">
                    <option value="1ère Année">1ère Année (CP1)</option>
                    <option value="2ème Année">2ème Année (CP2)</option>
                    <option value="3ème Année">3ème Année (CE1)</option>
                    <option value="4ème Année">4ème Année (CE2)</option>
                    <option value="5ème Année">5ème Année (CM1)</option>
                    <option value="6ème Année">6ème Année (CM2)</option>
                </optgroup>
            </select>

            <label for="inscription_reincription">Inscription ou Réinscription</label>
            <select class="sect" name="inscription_reincription" id="inscription_reincription">
                <option value="Inscription">Inscription</option>
                <option value="Réinscription">Réinscription</option>
            </select>

            <label for="sexe">Sexe</label>
            <select class="sect" name="sexe" id="sexe">
                <option value="Masculin">Masculin</option>
                <option value="Feminin">Féminin</option>
            </select>

            <label for="date_naissance">Date de naissance</label>
            <input type="date" id="date_naissance" name="date_naissance">

            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" placeholder="ex: Wonkifong">

            <label for="nom_parent">Nom du parent</label>
            <input type="text" id="nom_parent" name="nom_parent">

            <label for="prenom_parent">Prénom du parent</label>
            <input type="text" id="prenom_parent" name="prenom_parent">

            <label for="telephone">Téléphone</label>
            <input type="tel" id="telephone" name="telephone" placeholder="ex: 624 70 76 18">

            <input class="bouton" type="submit" value="Soumettre" name="soumettre">
            <input class="bouton" type="reset" value="Annuler">
        </fieldset>
    </form>

    <div class="p-intro">
        <h2>Rejoignez le Groupe Scolaire Saint Israël - Tampayah</h2>
        <p>
            Bienvenue sur la page d'inscription du Groupe Scolaire Saint Israël<br>
            situé à Tampayah, sous-préfecture de Wonkifong, préfecture de Coyah.<br>
            Notre établissement privé, réputé pour son excellence éducative,<br>
            accueille les enfants de la maternelle au primaire. En inscrivant<br>
            votre enfant chez nous, vous lui offrez l'opportunité de bénéficier<br>
            d'une éducation de qualité, encadrée par des enseignants dévoués et<br>
            passionnés.<br>
            <a href="modalite.php">Modalités de paiement</a>
        </p>
    </div>
    <div class="div1">
        <img src="../images/v3.jpeg" alt="">
        <img src="../images/v6.jpeg" alt="">
        <img src="../images/v5.jpeg" alt="">
    </div>
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
       
