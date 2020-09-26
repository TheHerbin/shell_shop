<?php


function accueilControleur($twig){
    echo $twig->render('accueil.html.twig', array());
}

function contactControleur($twig){
    echo $twig->render('contact.html.twig', array());
   }

   function maintenanceControleur($twig){
    echo $twig->render('maintenance.html.twig', array());
   }
   



   function creerUtilisateurControleur($twig,$db){
    $form = array(); 
    if (isset($_POST['envoyer'])){
        $email = $_POST['email'];
        $motdepasse = $_POST['motdepasse']; 
        $nom =$_POST['nom']; 
        $prenom = $_POST['prenom'];
        $tel = $_POST['tel'];
        $idrole = $_POST['idrole'];
        $form['valide'] = true;
        $form['email'] = $email;
        $form['role'] = $idrole;
        $Utilisateur = new Utilisateur($db);
            $exec = $Utilisateur->insert($nom, $prenom, $email, password_hash($motdepasse,PASSWORD_DEFAULT), $tel, $idrole);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
        }
        $form['email'] = $email;
        $form['idrole'] = $idrole;
      }
    echo $twig->render('creerUtilisateur.html.twig', array('form'=>$form));
   }

   function connexionControleur($twig, $db){
    $form = array();
   
    if (isset($_POST['valider'])){
    $form['valide'] = true;
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $utilisateur = new Utilisateur($db);
    $unUtilisateur = $utilisateur->connect($email);
    if ($unUtilisateur!=null){
    $mdpH = password_hash($mdp,PASSWORD_DEFAULT);
    if(!password_verify($mdp,$unUtilisateur['motdepasse'])){
        $form['valide'] = false;
 $form['message'] = 'Login ou mot de passe incorrect';
 }
 else{
    $_SESSION['login'] = $email;
    $_SESSION['role'] = $unUtilisateur['idrole'];
 header("Location:index.php");
 }
 }
 else{
 $form['valide'] = false;
 $form['message'] = 'Login ou mot de passe incorrect';

 }
 }
 echo $twig->render('connexion.html.twig', array('form'=>$form));
}

   

function deconnexionControleur($twig, $db){
    session_unset();
 session_destroy();
 header("Location:index.php");
}

function utilisateurControleur($twig, $db){
    $form = array();
    $utilisateur = new Utilisateur($db);
    $liste = $utilisateur->select();
    echo $twig->render('utilisateur.html.twig', array('form'=>$form,'liste'=>$liste));
}

function creerObusControleur($twig,$db){
    $form = array(); 
    if (isset($_POST['valider'])){
        $nom = $_POST['nom'];
        $penetration = $_POST['penetration']; 
        $description =$_POST['description']; 
        $form['valide'] = true;
        $Obus = new Obus($db);
            $exec = $Obus->insert($nom, $penetration, $description);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table obus';
        }
        $form['nom'] = $nom;
        

      }
    echo $twig->render('creerObus.html.twig', array('form'=>$form));
   }







?>