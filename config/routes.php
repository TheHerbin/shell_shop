<?php
function getPage($db){
    //var_dump($_GET);
   


 $lesPages['accueil'] = "accueilControleur;0";
 $lesPages['contact'] = "contactControleur;0";
 $lesPages['creerUtilisateur'] = "creerUtilisateurControleur;0";
 $lesPages['maintenance'] = "maintenanceControleur;0";
 $lesPages['connexion'] = "connexionControleur;0";
 $lesPages['deconnexion'] = "deconnexionControleur;0";
 $lesPages['utilisateur'] = "utilisateurControleur;0";
 $lesPages['creerObus'] = "creerObusControleur;0";
 $lesPages['stock'] = "stockControleur;0";
 $lesPages['obus'] = "obusControleur;0";


 if($db!=null){

 if (isset($_GET['page'])){
    $page = $_GET['page'];
    }
    else{
    $page = 'accueil';
}
if (isset($lesPages[$page])){
$contenu = $lesPages[$page];
}
else{
    $contenu = $lesPages['maintenance'];
   }

return $contenu;
}
}
?>